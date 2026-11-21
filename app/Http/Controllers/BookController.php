<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Publisher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(): View
    {
        $books = Book::with(['location', 'publisher', 'authors'])->paginate(15);

        return view('books.index', compact('books'));
    }

    public function create(): View
    {
        return view('books.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'isbn' => ['required', 'string', 'max:20', 'unique:books,isbn'],
            'published_year' => ['required', 'integer', 'between:1000,9999'],
            'publisher_name' => ['required', 'string', 'max:255'],
            'author_names' => ['nullable', 'array', 'max:20'],
            'author_names.*' => ['nullable', 'string', 'max:255', 'distinct:ignore_case'],
            'shelf' => ['nullable', 'required_with:aisle', 'string', 'max:255'],
            'aisle' => ['nullable', 'required_with:shelf', 'string', 'max:255'],
        ]);

        DB::transaction(function () use ($validated): void {
            $publisher = Publisher::firstOrCreate([
                'name' => trim($validated['publisher_name']),
            ]);

            $book = $publisher->books()->create([
                'title' => $validated['title'],
                'isbn' => $validated['isbn'],
                'published_year' => $validated['published_year'],
            ]);

            $authors = collect($validated['author_names'] ?? [])
                ->filter(fn ($name): bool => is_string($name) && trim($name) !== '')
                ->map(fn (string $name): string => trim($name))
                ->unique(fn (string $name): string => mb_strtolower($name))
                ->map(fn (string $name): int => Author::firstOrCreate(['name' => $name])->id)
                ->all();

            $book->authors()->sync($authors);

            if (filled($validated['shelf'] ?? null) && filled($validated['aisle'] ?? null)) {
                $book->location()->create([
                    'shelf' => trim($validated['shelf']),
                    'aisle' => trim($validated['aisle']),
                ]);
            }
        });

        return redirect()
            ->route('books.index')
            ->with('status', 'Book added to the catalog.');
    }
}
