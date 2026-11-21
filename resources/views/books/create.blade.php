@extends('layouts.app')

@section('title', 'Add book')
@section('breadcrumb', 'Add book')

@section('content')
    <div class="mx-auto max-w-6xl">
        <div class="mb-6">
            <a href="{{ route('books.index') }}" class="group inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition hover:text-slate-900">
                <span class="flex h-8 w-8 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-500 shadow-sm transition group-hover:border-slate-300 group-hover:text-slate-900">
                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M12.78 4.22a.75.75 0 0 1 0 1.06L8.06 10l4.72 4.72a.75.75 0 1 1-1.06 1.06l-5.25-5.25a.75.75 0 0 1 0-1.06l5.25-5.25a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd"/></svg>
                </span>
                Back to catalog
            </a>
        </div>

        <div class="mb-8 flex flex-col justify-between gap-5 sm:flex-row sm:items-end">
            <div class="flex items-start gap-4">
                <div class="hidden h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-600 text-white shadow-lg shadow-blue-900/15 sm:flex">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4.75A1.75 1.75 0 0 1 6.75 3H20v16H6.75A1.75 1.75 0 0 0 5 20.75m0-16v16m0-16H4v16h1m4-12h7m-7 4h7"/></svg>
                </div>
                <div>
                    <p class="mb-1 text-xs font-semibold uppercase tracking-[0.16em] text-blue-700">Library catalog</p>
                    <h1 class="text-3xl font-semibold tracking-tight text-slate-950">Add a new book</h1>
                    <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500">Create a complete catalog record. Add the title, contributors, and where readers can find it.</p>
                </div>
            </div>
            <p class="shrink-0 text-xs font-medium text-slate-500"><span class="text-red-600">*</span> Required fields</p>
        </div>

        @if ($errors->any())
            <div role="alert" class="mb-6 flex gap-3 rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800 shadow-sm">
                <svg class="mt-0.5 h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm0-11a.75.75 0 0 1 .75.75v3.5a.75.75 0 0 1-1.5 0v-3.5A.75.75 0 0 1 10 7Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd"/></svg>
                <div>
                    <p class="font-semibold">We couldn't save this book yet.</p>
                    <p class="mt-0.5 text-red-700">Review the highlighted fields and try again.</p>
                </div>
            </div>
        @endif

        <form method="POST" action="{{ route('books.store') }}" x-data="{ submitting: false }" @submit="if (!window.confirm('Save this book to the catalog?')) { $event.preventDefault(); return; } submitting = true" class="grid items-start gap-6 lg:grid-cols-[minmax(0,1fr)_18rem]">
            @csrf

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-slate-200">
                <section class="p-6 sm:p-8" aria-labelledby="book-details-heading">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-sm font-semibold text-blue-700 ring-1 ring-inset ring-blue-700/10">01</span>
                        <div>
                            <h2 id="book-details-heading" class="text-base font-semibold text-slate-900">Book details</h2>
                            <p class="mt-1 text-sm text-slate-500">Start with the book's identifying information.</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="title" class="mb-2 block text-sm font-medium text-slate-700">Book title <span class="text-red-600">*</span></label>
                            <input id="title" name="title" value="{{ old('title') }}" required maxlength="255" autocomplete="off" placeholder="e.g. The Midnight Library"
                                @class(['block h-11 w-full rounded-xl border bg-white px-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10', 'border-red-300 focus:border-red-500' => $errors->has('title'), 'border-slate-300 focus:border-blue-500' => ! $errors->has('title')])>
                            @error('title')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label for="isbn" class="mb-2 block text-sm font-medium text-slate-700">ISBN <span class="text-red-600">*</span></label>
                                <input id="isbn" name="isbn" value="{{ old('isbn') }}" required maxlength="20" autocomplete="off" placeholder="9781234567890"
                                    @class(['block h-11 w-full rounded-xl border bg-white px-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10', 'border-red-300 focus:border-red-500' => $errors->has('isbn'), 'border-slate-300 focus:border-blue-500' => ! $errors->has('isbn')])>
                                @error('isbn')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label for="published_year" class="mb-2 block text-sm font-medium text-slate-700">Published year <span class="text-red-600">*</span></label>
                                <input id="published_year" name="published_year" type="number" min="1000" max="9999" value="{{ old('published_year') }}" required placeholder="2024"
                                    @class(['block h-11 w-full rounded-xl border bg-white px-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10', 'border-red-300 focus:border-red-500' => $errors->has('published_year'), 'border-slate-300 focus:border-blue-500' => ! $errors->has('published_year')])>
                                @error('published_year')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                            </div>
                        </div>
                    </div>
                </section>

                <section class="border-t border-slate-200 p-6 sm:p-8" aria-labelledby="contributors-heading">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-sm font-semibold text-violet-700 ring-1 ring-inset ring-violet-700/10">02</span>
                        <div>
                            <h2 id="contributors-heading" class="text-base font-semibold text-slate-900">Publisher & authors</h2>
                            <p class="mt-1 text-sm text-slate-500">Contributors are matched by name or added to your catalog.</p>
                        </div>
                    </div>

                    <div class="space-y-5">
                        <div>
                            <label for="publisher_name" class="mb-2 block text-sm font-medium text-slate-700">Publisher name <span class="text-red-600">*</span></label>
                            <input id="publisher_name" name="publisher_name" value="{{ old('publisher_name') }}" required maxlength="255" autocomplete="organization" placeholder="e.g. Northstar Press"
                                @class(['block h-11 w-full rounded-xl border bg-white px-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10', 'border-red-300 focus:border-red-500' => $errors->has('publisher_name'), 'border-slate-300 focus:border-blue-500' => ! $errors->has('publisher_name')])>
                            @error('publisher_name')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>

                        <div x-data="{ authors: @js(old('author_names', [''])) }">
                            <div class="mb-2 flex items-center justify-between gap-3">
                                <label class="block text-sm font-medium text-slate-700">Authors <span class="font-normal text-slate-400">· optional</span></label>
                                <button type="button" @click="authors.push('')" class="inline-flex items-center gap-1 rounded-lg px-2.5 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-blue-500/30">
                                    <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 4a.75.75 0 0 1 .75.75v4.5h4.5a.75.75 0 0 1 0 1.5h-4.5v4.5a.75.75 0 0 1-1.5 0v-4.5h-4.5a.75.75 0 0 1 0-1.5h4.5v-4.5A.75.75 0 0 1 10 4Z"/></svg>
                                    Add author
                                </button>
                            </div>
                            <div class="space-y-3">
                                <template x-for="(author, index) in authors" :key="index">
                                    <div class="flex items-center gap-2">
                                        <div class="relative min-w-0 flex-1">
                                            <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-slate-400">
                                                <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 10a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM3.5 17a6.5 6.5 0 1 1 13 0v.5h-13V17Z"/></svg>
                                            </span>
                                            <input :name="`author_names[${index}]`" x-model="authors[index]" maxlength="255" autocomplete="off" placeholder="Author full name"
                                                class="block h-11 w-full rounded-xl border border-slate-300 bg-white pl-9 pr-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-4 focus:ring-blue-500/10">
                                        </div>
                                        <button type="button" x-show="authors.length > 1" @click="authors.splice(index, 1)" class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg text-slate-400 transition hover:bg-red-50 hover:text-red-600" aria-label="Remove author">
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8.22 5.22a.75.75 0 0 1 1.06 0L10 5.94l.72-.72a.75.75 0 1 1 1.06 1.06l-.72.72.72.72a.75.75 0 1 1-1.06 1.06L10 8.06l-.72.72a.75.75 0 0 1-1.06-1.06l.72-.72-.72-.72a.75.75 0 0 1 0-1.06ZM5.25 3A2.25 2.25 0 0 0 3 5.25v9.5A2.25 2.25 0 0 0 5.25 17h9.5A2.25 2.25 0 0 0 17 14.75v-9.5A2.25 2.25 0 0 0 14.75 3h-9.5Z" clip-rule="evenodd"/></svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            @error('author_names.*')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                            <p class="mt-2 text-xs text-slate-500">Add each contributor separately for co-authored books.</p>
                        </div>
                    </div>
                </section>

                <section class="border-t border-slate-200 p-6 sm:p-8" aria-labelledby="location-heading">
                    <div class="mb-6 flex items-start gap-3">
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-sm font-semibold text-amber-700 ring-1 ring-inset ring-amber-700/10">03</span>
                        <div>
                            <h2 id="location-heading" class="text-base font-semibold text-slate-900">Shelf location <span class="font-normal text-slate-400">· optional</span></h2>
                            <p class="mt-1 text-sm text-slate-500">Enter both fields to save a physical location for this book.</p>
                        </div>
                    </div>
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="aisle" class="mb-2 block text-sm font-medium text-slate-700">Aisle</label>
                            <input id="aisle" name="aisle" value="{{ old('aisle') }}" maxlength="255" placeholder="e.g. 3"
                                @class(['block h-11 w-full rounded-xl border bg-white px-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10', 'border-red-300 focus:border-red-500' => $errors->has('aisle'), 'border-slate-300 focus:border-blue-500' => ! $errors->has('aisle')])>
                            @error('aisle')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label for="shelf" class="mb-2 block text-sm font-medium text-slate-700">Shelf</label>
                            <input id="shelf" name="shelf" value="{{ old('shelf') }}" maxlength="255" placeholder="e.g. B-14"
                                @class(['block h-11 w-full rounded-xl border bg-white px-3.5 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10', 'border-red-300 focus:border-red-500' => $errors->has('shelf'), 'border-slate-300 focus:border-blue-500' => ! $errors->has('shelf')])>
                            @error('shelf')<p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </section>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50/80 px-6 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-8">
                    <p class="text-xs text-slate-500">Your changes are saved to the library catalog.</p>
                    <div class="flex flex-col-reverse gap-3 sm:flex-row">
                        <a href="{{ route('books.index') }}" class="inline-flex h-11 items-center justify-center rounded-xl border border-slate-300 bg-white px-4 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-400/30">Cancel</a>
                        <button type="submit" :disabled="submitting" class="inline-flex h-11 items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 text-sm font-semibold text-white shadow-sm shadow-blue-900/15 transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60 focus:outline-none focus:ring-4 focus:ring-blue-500/25">
                            <svg class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10 4a.75.75 0 0 1 .75.75v4.5h4.5a.75.75 0 0 1 0 1.5h-4.5v4.5a.75.75 0 0 1-1.5 0v-4.5h-4.5a.75.75 0 0 1 0-1.5h4.5v-4.5A.75.75 0 0 1 10 4Z"/></svg>
                            Save to catalog
                        </button>
                    </div>
                </div>
            </div>

            <aside class="space-y-4 lg:sticky lg:top-24">
                <div class="overflow-hidden rounded-2xl bg-slate-900 p-5 text-white shadow-sm">
                    <div class="mb-4 flex h-10 w-10 items-center justify-center rounded-xl bg-white/10 text-blue-200 ring-1 ring-inset ring-white/10">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8.5 21h7a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2h-7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z"/></svg>
                    </div>
                    <h2 class="text-sm font-semibold">A complete record makes discovery easier</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-300">Add accurate publication details and contributors so your collection stays organized and searchable.</p>
                    <div class="mt-5 space-y-3 border-t border-white/10 pt-4 text-xs text-slate-300">
                        <p class="flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-400/15 text-emerald-300">✓</span> ISBN must be unique</p>
                        <p class="flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-400/15 text-emerald-300">✓</span> Add multiple co-authors</p>
                        <p class="flex items-center gap-2"><span class="flex h-5 w-5 items-center justify-center rounded-full bg-emerald-400/15 text-emerald-300">✓</span> Shelf location is optional</p>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-center gap-2 text-sm font-semibold text-slate-800">
                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8.75-3a.75.75 0 0 1 1.5 0v.25a.75.75 0 0 1-1.5 0V7Zm0 3a.75.75 0 0 1 1.5 0v3a.75.75 0 0 1-1.5 0v-3Z" clip-rule="evenodd"/></svg>
                        Good to know
                    </div>
                    <p class="mt-2 text-sm leading-6 text-slate-500">Existing publishers and authors with the same name are reused automatically.</p>
                </div>
            </aside>
        </form>
    </div>
@endsection
