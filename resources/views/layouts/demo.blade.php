<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Event Reminder Demo') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900">

    <header class="bg-white border-b border-gray-100 shadow-sm">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 h-14 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-lg font-bold text-indigo-600 tracking-tight hover:text-indigo-800 transition-colors">TJR Events</a>
            <span class="text-xs text-gray-400">Demo App · TALL Stack</span>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

</body>
</html>
