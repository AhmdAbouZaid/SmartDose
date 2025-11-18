<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SmartDose') }} - @yield('title', 'Authentication')</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="font-['Poppins'] antialiased bg-gray-50 min-h-screen flex items-center justify-center p-5">
    
    <!-- Back to Home Button -->
    <div class="fixed top-5 left-5 z-50">
        <a href="{{ url('/') }}" 
           class="inline-flex items-center px-5 py-2.5 bg-white text-blue-600 rounded-lg font-medium shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
            ← Back to Home
        </a>
    </div>

    <!-- Auth Card Container -->
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            {{ $slot }}
        </div>
    </div>

    @stack('scripts')
</body>
</html>