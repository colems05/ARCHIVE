<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Sign in · Archive</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes archive-rise {
            from { opacity: 0; transform: translateY(14px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .archive-rise { animation: archive-rise .7s cubic-bezier(.22, 1, .36, 1) both; }
        .archive-rise-delay { animation-delay: .12s; }
        .archive-grid {
            background-image:
                linear-gradient(rgba(255,255,255,.055) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.055) 1px, transparent 1px);
            background-size: 52px 52px;
            mask-image: linear-gradient(to bottom, black 10%, transparent 92%);
        }
        .archive-glow {
            background:
                radial-gradient(circle at 18% 18%, rgba(96,165,250,.18), transparent 26rem),
                radial-gradient(circle at 78% 78%, rgba(251,191,36,.09), transparent 22rem);
        }
    </style>
</head>
<body class="min-h-screen overflow-x-hidden bg-[#f4f1ea] text-slate-950 antialiased">
    <main class="grid min-h-screen lg:grid-cols-[minmax(24rem,1.12fr)_minmax(29rem,.88fr)]">
        <section class="archive-glow relative hidden overflow-hidden bg-[#111827] px-12 py-10 text-white lg:flex lg:flex-col lg:justify-between">
            <div class="archive-grid absolute inset-0"></div>
            <div class="absolute -bottom-40 -left-24 h-96 w-96 rounded-full border border-white/10"></div>
            <div class="absolute -bottom-24 -left-8 h-64 w-64 rounded-full border border-white/10"></div>
            <div class="absolute right-12 top-36 h-20 w-20 rounded-full border border-amber-200/20"></div>

            <header class="archive-rise relative flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-xl border border-white/15 bg-white/10 shadow-lg shadow-black/10 backdrop-blur">
                    <svg class="h-6 w-6 text-amber-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 5.25A2.25 2.25 0 0 1 6.75 3H20v16.5H6.75a2.25 2.25 0 0 0 0 4.5H20M4.5 5.25v18.75"/>
                    </svg>
                </div>
                <div>
                    <p class="text-[15px] font-semibold tracking-[0.12em]">ARCHIVE</p>
                    <p class="mt-0.5 text-xs text-slate-400">Library intelligence</p>
                </div>
            </header>

            <div class="archive-rise archive-rise-delay relative max-w-[37rem] pb-8">
                <div class="mb-7 flex items-center gap-3">
                    <span class="h-px w-10 bg-amber-300"></span>
                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-amber-200">Knowledge, carefully kept</p>
                </div>
                <h1 class="max-w-[34rem] text-5xl font-semibold leading-[1.04] tracking-[-0.04em] xl:text-6xl">
                    Every story has<br>
                    <span class="font-serif italic text-amber-200">a place.</span>
                </h1>
                <p class="mt-7 max-w-lg text-base leading-7 text-slate-300">
                    A considered workspace for books, contributors, publishers, and the shelves that bring them together.
                </p>
                <div class="mt-10 grid max-w-xl grid-cols-3 gap-px overflow-hidden rounded-2xl border border-white/10 bg-white/10">
                    <div class="bg-[#111827]/80 px-5 py-4">
                        <p class="text-lg font-semibold">Catalog</p>
                        <p class="mt-1 text-xs text-slate-400">Organized records</p>
                    </div>
                    <div class="bg-[#111827]/80 px-5 py-4">
                        <p class="text-lg font-semibold">People</p>
                        <p class="mt-1 text-xs text-slate-400">Authors & publishers</p>
                    </div>
                    <div class="bg-[#111827]/80 px-5 py-4">
                        <p class="text-lg font-semibold">Space</p>
                        <p class="mt-1 text-xs text-slate-400">Precise locations</p>
                    </div>
                </div>
            </div>

            <footer class="archive-rise relative flex items-center justify-between text-xs text-slate-500">
                <p>Archive Library System</p>
                <p class="flex items-center gap-2"><span class="h-1.5 w-1.5 rounded-full bg-emerald-400"></span> System operational</p>
            </footer>
        </section>

        <section class="relative flex min-h-screen items-center justify-center px-6 py-12 sm:px-12">
            <div class="absolute right-8 top-8 hidden items-center gap-2 text-xs text-slate-500 sm:flex">
                <span class="h-px w-8 bg-slate-300"></span>
                Secure access
            </div>

            <div class="archive-rise w-full max-w-md">
                <div class="mb-10 flex items-center gap-3 lg:hidden">
                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-[#111827] text-amber-200">
                        <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4.5A1.5 1.5 0 0 1 6.5 3H20v15H6.5A1.5 1.5 0 0 0 5 19.5v-15ZM5 19.5V21h15"/></svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold tracking-[0.12em]">ARCHIVE</p>
                        <p class="text-xs text-slate-500">Library workspace</p>
                    </div>
                </div>

                <p class="mb-3 text-xs font-semibold uppercase tracking-[0.18em] text-blue-700">Member access</p>
                <h2 class="text-4xl font-semibold tracking-[-0.035em] text-slate-950">Welcome back.</h2>
                <p class="mt-3 text-sm leading-6 text-slate-500">Sign in to continue to your library workspace.</p>

                @if ($errors->any())
                    <div role="alert" class="mt-6 rounded-xl border border-red-200 bg-red-50/80 px-4 py-3 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login.submit') }}" x-data="{ submitting: false, showPassword: false }" @submit="submitting = true" class="mt-9 space-y-5">
                    @csrf
                    <div>
                        <label for="email" class="mb-2.5 block text-xs font-semibold uppercase tracking-[0.12em] text-slate-600">Email address</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus autocomplete="email"
                            placeholder="name@library.com"
                            class="block h-14 w-full rounded-xl border border-slate-300/90 bg-white px-4 text-[15px] text-slate-950 shadow-sm outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10">
                    </div>
                    <div>
                        <label for="password" class="mb-2.5 block text-xs font-semibold uppercase tracking-[0.12em] text-slate-600">Password</label>
                        <div class="relative">
                            <input id="password" name="password" :type="showPassword ? 'text' : 'password'" required autocomplete="current-password"
                                placeholder="Enter your password"
                                class="block h-14 w-full rounded-xl border border-slate-300/90 bg-white px-4 pr-12 text-[15px] text-slate-950 shadow-sm outline-none transition placeholder:text-slate-400 hover:border-slate-400 focus:border-blue-600 focus:ring-4 focus:ring-blue-600/10">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 flex w-12 items-center justify-center text-slate-400 transition hover:text-slate-700" :aria-label="showPassword ? 'Hide password' : 'Show password'">
                                <svg x-show="!showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12s3.5-6 9.75-6 9.75 6 9.75 6-3.5 6-9.75 6-9.75-6-9.75-6Z"/><circle cx="12" cy="12" r="2.75"/></svg>
                                <svg x-cloak x-show="showPassword" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" d="M3 3l18 18M10.6 10.6A2 2 0 0 0 12 14a2 2 0 0 0 1.4-.6M9.9 5.2A10.8 10.8 0 0 1 12 5c6.25 0 9.75 7 9.75 7a16 16 0 0 1-2.4 3.2M6.2 6.8C3.7 8.7 2.25 12 2.25 12S5.75 19 12 19a10 10 0 0 0 3.1-.5"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2.5 text-sm text-slate-600">
                            <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-[#111827] focus:ring-slate-700">
                            Keep me signed in
                        </label>
                    </div>
                    <button type="submit" :disabled="submitting" class="group inline-flex h-14 w-full items-center justify-center gap-3 rounded-xl bg-[#111827] text-sm font-semibold text-white shadow-lg shadow-slate-900/10 transition duration-200 hover:-translate-y-0.5 hover:bg-blue-700 disabled:cursor-not-allowed disabled:opacity-60">
                        <span x-show="!submitting">Sign in</span>
                        <span x-cloak x-show="submitting">Signing in...</span>
                        <svg x-show="!submitting" class="h-4 w-4 transition-transform group-hover:translate-x-1" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M3.75 10a.75.75 0 0 1 .75-.75h9.69l-3.22-3.22a.75.75 0 1 1 1.06-1.06l4.5 4.5a.75.75 0 0 1 0 1.06l-4.5 4.5a.75.75 0 1 1-1.06-1.06l3.22-3.22H4.5A.75.75 0 0 1 3.75 10Z"/></svg>
                    </button>
                </form>

                <div class="mt-8 flex items-center gap-4">
                    <span class="h-px flex-1 bg-slate-200"></span>
                    <span class="text-xs text-slate-400">New to Archive?</span>
                    <span class="h-px flex-1 bg-slate-200"></span>
                </div>
                <a href="{{ route('register') }}" class="mt-5 flex h-12 items-center justify-center rounded-xl border border-slate-300 bg-white text-sm font-semibold text-slate-800 transition hover:border-slate-400 hover:bg-slate-50">
                    Create an account
                </a>
            </div>
        </section>
    </main>
</body>
</html>
