<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Personal Expense Tracker')</title>
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    <!-- <script src="https://unpkg.com/@tailwindcss/ui@0.7.2/dist/tailwindcss-ui.js"></script> -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header class="border-b bg-white">
        <nav class="mx-auto flex max-w-7xl justify-between px-4 sm:px-6 lg:px-8">
            <ul class="flex space-x-4">
                <li class="border-b-2 border-blue-500">
                    <a href="{{ route('welcome') }}" class="{{ request()->routeIs('welcome') ? 'text-blue-500' : 'text-gray-700 hover:text-blue-500' }}">Personal Expense Tracker</a>
                </li>
                <li class="">
                    <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'text-blue-500' : 'text-gray-700 hover:text-blue-500' }}">Dashboard</a>
                </li>
                <li class="">
                    <a href="{{ route('transactions.index') }}" class="{{ request()->routeIs('transactions.*') ? 'text-blue-500' : 'text-gray-700' }}">Transaksi</a>
                </li>
            </ul>
        </nav>
    </header>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span>{{ session('success') }}</span>
        <button onclick="this.parentElement.remove()" class="absolute top-0 right-0 mt-2 mr-2">✕</button>
</div>
    @endif

    <main>
        @yield('content')
    </main>

    <footer>
        <div class="">
            <p>&copy; 2026 Personal Expense Tracker. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
