<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\PhysicalLocation;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_books_catalog_returns_a_successful_response(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->get('/books');

        $response->assertOk();
    }

    public function test_books_list_shows_their_relationship_data(): void
    {
        $this->actingAs(User::factory()->create());
        $publisher = Publisher::create(['name' => 'Northstar Press']);
        $author = Author::create(['name' => 'Avery Writer']);
        $book = Book::create([
            'publisher_id' => $publisher->id,
            'title' => 'The Quiet Archive',
            'isbn' => '9781234567890',
            'published_year' => 2024,
        ]);

        PhysicalLocation::create([
            'book_id' => $book->id,
            'shelf' => 'B-14',
            'aisle' => '3',
        ]);
        $book->authors()->attach($author);

        $this->get('/books')
            ->assertOk()
            ->assertSee('The Quiet Archive')
            ->assertSee('9781234567890')
            ->assertSee('Northstar Press')
            ->assertSee('Avery Writer')
            ->assertSee('B-14')
            ->assertSee('Aisle 3')
            ->assertSee('2024');
    }

    public function test_a_book_can_be_created_with_its_related_catalog_records(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/books/create')
            ->assertOk()
            ->assertSee('Add a new book');

        $response = $this->post('/books', [
            'title' => 'The Open Shelf',
            'isbn' => '9780987654321',
            'published_year' => 2025,
            'publisher_name' => 'Harbor House',
            'author_names' => ['Jordan Reader', 'Casey Writer', null],
            'aisle' => '4',
            'shelf' => 'C-8',
        ]);

        $response->assertRedirect(route('books.index'));
        $this->assertDatabaseHas('books', [
            'title' => 'The Open Shelf',
            'isbn' => '9780987654321',
        ]);
        $this->assertDatabaseHas('publishers', ['name' => 'Harbor House']);
        $this->assertDatabaseHas('authors', ['name' => 'Jordan Reader']);
        $this->assertDatabaseHas('authors', ['name' => 'Casey Writer']);
        $this->assertDatabaseHas('physical_locations', [
            'aisle' => '4',
            'shelf' => 'C-8',
        ]);
        $this->assertDatabaseCount('author_book', 2);
    }

    public function test_a_book_requires_a_unique_isbn(): void
    {
        $this->actingAs(User::factory()->create());

        $publisher = Publisher::create(['name' => 'Existing Press']);
        Book::create([
            'publisher_id' => $publisher->id,
            'title' => 'Existing Book',
            'isbn' => '9781111111111',
            'published_year' => 2020,
        ]);

        $this->from('/books/create')
            ->post('/books', [
                'title' => 'Duplicate ISBN',
                'isbn' => '9781111111111',
                'published_year' => 2024,
                'publisher_name' => 'Another Press',
            ])
            ->assertRedirect('/books/create')
            ->assertSessionHasErrors('isbn');

        $this->assertDatabaseMissing('books', ['title' => 'Duplicate ISBN']);
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get('/books')
            ->assertRedirect('/login');
    }

    public function test_a_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'New Librarian',
            'email' => 'librarian@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/books');
        $this->assertAuthenticated();
        $this->assertDatabaseHas('users', ['email' => 'librarian@example.com']);
    }

    public function test_a_registered_user_can_login_and_logout(): void
    {
        $user = User::factory()->create([
            'email' => 'library@example.com',
            'password' => 'password123',
        ]);

        $this->post('/login', [
            'email' => 'library@example.com',
            'password' => 'password123',
        ])->assertRedirect('/books');

        $this->assertAuthenticatedAs($user);

        $this->post('/logout')
            ->assertRedirect('/login');
        $this->assertGuest();
    }
}
