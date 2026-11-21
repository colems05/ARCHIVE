<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Library') · Archive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body class="min-h-screen bg-slate-100 text-slate-900 antialiased">
    <div x-data="{ sidebarOpen: false }" class="min-h-screen">
        <div x-cloak x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-slate-950/60 lg:hidden" aria-hidden="true"></div>

        <aside x-cloak :class="{ '-translate-x-full': ! sidebarOpen, 'translate-x-0': sidebarOpen }"
            class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col bg-slate-900 text-white transition-transform duration-200 ease-in-out lg:translate-x-0">
            <div class="flex h-16 items-center gap-3 border-b border-white/10 px-6">
                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-500 text-sm font-bold tracking-wide">A</div>
                <div>
                    <p class="text-sm font-semibold tracking-wide">Archive</p>
                    <p class="text-xs text-slate-400">Library workspace</p>
                </div>
                <button type="button" @click="sidebarOpen = false" class="ml-auto rounded-md p-1 text-slate-400 hover:bg-white/10 hover:text-white lg:hidden" aria-label="Close navigation">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="m6 6 12 12M18 6 6 18"/></svg>
                </button>
            </div>

            <nav class="flex-1 space-y-1 px-3 py-6" aria-label="Main navigation">
                <p class="px-3 pb-2 text-[11px] font-semibold uppercase tracking-[0.16em] text-slate-500">Workspace</p>
                <a href="{{ route('books.index') }}" @click="sidebarOpen = false"
                    @class([
                        'flex items-center gap-3 rounded-lg px-3 py-2.5 text-sm font-medium transition',
                        'bg-blue-600 text-white shadow-sm shadow-blue-950/20' => request()->routeIs('books.*'),
                        'text-slate-300 hover:bg-white/5 hover:text-white' => ! request()->routeIs('books.*'),
                    ])>
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4.75A1.75 1.75 0 0 1 6.75 3H20v16H6.75A1.75 1.75 0 0 0 5 20.75m0-16v16m0-16H4v16h1"/></svg>
                    <span>Books</span>
                </a>
            </nav>

            <div class="border-t border-white/10 p-4">
                <div class="flex items-center gap-3 rounded-lg px-2 py-2">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-700 text-sm font-semibold text-slate-200">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <div class="min-w-0 flex-1">
                        <p class="truncate text-sm font-medium text-white">{{ auth()->user()->name }}</p>
                        <p class="truncate text-xs text-slate-400">{{ auth()->user()->email }}</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="rounded-md p-2 text-slate-400 hover:bg-white/10 hover:text-white" aria-label="Log out">
                            <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M10 17l5-5-5-5m5 5H3m12-9h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <div class="min-h-screen lg:pl-72">
            <header class="sticky top-0 z-30 border-b border-slate-200 bg-white">
                <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex min-w-0 items-center gap-3">
                        <button type="button" @click="sidebarOpen = true" class="rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 lg:hidden" aria-label="Open navigation">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                        <nav class="flex min-w-0 items-center gap-2 text-sm" aria-label="Breadcrumb">
                            <a href="{{ route('books.index') }}" class="hidden text-slate-500 hover:text-slate-700 sm:inline">Workspace</a>
                            <svg class="hidden h-4 w-4 shrink-0 text-slate-400 sm:block" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 0 1 .02-1.06L10.94 10 7.23 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1-1.08 0Z" clip-rule="evenodd"/></svg>
                            <span class="truncate font-medium text-slate-900">@yield('breadcrumb', 'Books')</span>
                        </nav>
                    </div>
                    <div class="flex items-center gap-2 text-xs font-medium text-slate-500">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        <span class="hidden sm:inline">Workspace active</span>
                    </div>
                </div>
            </header>

            <main class="px-4 py-8 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-7xl">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
</body>
</html>
