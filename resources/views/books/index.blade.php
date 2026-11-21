@extends('layouts.app')

@section('title', 'Books')
@section('breadcrumb', 'Books')

@section('content')
    <div class="mb-6 flex flex-col gap-1">
        <p class="text-sm font-medium text-blue-700">Catalog</p>
        <div class="flex flex-wrap items-end justify-between gap-3">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">Books</h1>
                <p class="mt-1 text-sm text-slate-500">Browse titles, contributors, publishers, and shelf locations.</p>
            </div>
            <div class="flex items-center gap-4">
                <p class="text-sm text-slate-500">
                    <span class="font-semibold text-slate-900">{{ $books->total() }}</span>
                    {{ \Illuminate\Support\Str::plural('title', $books->total()) }} in catalog
                </p>
                <a href="{{ route('books.create') }}" class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-600 focus:ring-offset-2">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 4a.75.75 0 0 1 .75.75v4.5h4.5a.75.75 0 0 1 0 1.5h-4.5v4.5a.75.75 0 0 1-1.5 0v-4.5h-4.5a.75.75 0 0 1 0-1.5h4.5v-4.5A.75.75 0 0 1 10 4Z"/></svg>
                    Add book
                </a>
            </div>
        </div>
    </div>

    @if (session('status'))
        <div role="status" class="mb-5 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
            {{ session('status') }}
        </div>
    @endif

    <section class="overflow-hidden rounded-xl bg-white shadow-sm ring-1 ring-slate-200" aria-labelledby="book-list-heading">
        <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 px-5 py-4 sm:px-6">
            <div>
                <h2 id="book-list-heading" class="text-sm font-semibold text-slate-900">Library catalog</h2>
                <p class="mt-1 text-xs text-slate-500">Showing {{ $books->firstItem() ?? 0 }}–{{ $books->lastItem() ?? 0 }} of {{ $books->total() }} titles</p>
            </div>
            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-medium text-emerald-700 ring-1 ring-inset ring-emerald-600/20">
                <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                Catalog up to date
            </span>
        </div>

        <div class="w-full overflow-x-auto">
            <table class="w-full min-w-[900px] table-auto text-left">
                <thead class="border-b border-slate-300 bg-slate-50">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 text-sm font-semibold text-slate-900">Title</th>
                        <th scope="col" class="px-6 py-3.5 text-sm font-semibold text-slate-900">Publisher</th>
                        <th scope="col" class="px-6 py-3.5 text-sm font-semibold text-slate-900">Authors</th>
                        <th scope="col" class="px-6 py-3.5 text-sm font-semibold text-slate-900">Location</th>
                        <th scope="col" class="px-6 py-3.5 text-sm font-semibold text-slate-900">Published</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse ($books as $book)
                        <tr class="transition-colors hover:bg-slate-50">
                            <td class="whitespace-nowrap px-6 py-4">
                                <div class="font-medium text-slate-900">{{ $book->title }}</div>
                                <div class="mt-1 text-xs text-slate-500">ISBN {{ $book->isbn }}</div>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                {{ $book->publisher?->name ?? 'Unknown publisher' }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($book->authors->isNotEmpty())
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($book->authors as $author)
                                            <span class="inline-flex items-center rounded-full bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 ring-1 ring-blue-700/10">
                                                {{ $author->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-sm text-slate-400">No authors listed</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">
                                @if ($book->location)
                                    <span class="font-medium text-slate-700">Aisle {{ $book->location->aisle }}</span>
                                    <span class="text-slate-400">·</span>
                                    Shelf {{ $book->location->shelf }}
                                @else
                                    <span class="text-slate-400">Not assigned</span>
                                @endif
                            </td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600">{{ $book->published_year }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                    <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4.75A1.75 1.75 0 0 1 6.75 3H20v16H6.75A1.75 1.75 0 0 0 5 20.75m0-16v16m0-16H4v16h1"/></svg>
                                </div>
                                <h3 class="mt-3 text-sm font-semibold text-slate-900">No books found</h3>
                                <p class="mt-1 text-sm text-slate-500">The catalog is empty. Add books to see them listed here.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($books->hasPages())
            <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                {{ $books->links() }}
            </div>
        @endif
    </section>
@endsection
