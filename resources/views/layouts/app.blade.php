<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Personal Expense Tracker')</title>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.17.2/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="border-b border-stone-200 bg-white">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('welcome') }}" class="text-base font-bold tracking-tight text-stone-900">Personal Expense Tracker</a>
            <ul class="flex items-center gap-1 sm:gap-2">
                <li>
                    <a href="{{ route('dashboard.index') }}" class="rounded-[10px] px-3 py-2 text-sm font-medium transition {{ request()->routeIs('dashboard.index') ? 'bg-emerald-50 text-emerald-700' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">Dashboard</a>
                </li>
                <li>
                    <a href="{{ route('transactions.index') }}" class="rounded-[10px] px-3 py-2 text-sm font-medium transition {{ request()->routeIs('transactions.*') ? 'bg-emerald-50 text-emerald-700' : 'text-stone-600 hover:bg-stone-100 hover:text-stone-900' }}">Transaksi</a>
                </li>
            </ul>
        </nav>
    </header>

    @if(session('success'))
        <div class="mx-auto max-w-7xl px-4 pt-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between gap-4 rounded-[10px] border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800" role="alert">
                <span>{{ session('success') }}</span>
                <button type="button" onclick="this.parentElement.remove()" aria-label="Tutup notifikasi" class="rounded-[10px] px-2 py-1 font-medium transition hover:bg-emerald-100">Tutup</button>
            </div>
        </div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-stone-200 bg-white">
        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <p class="text-sm text-stone-500">&copy; 2026 Personal Expense Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
