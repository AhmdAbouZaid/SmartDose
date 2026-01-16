<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SmartDose') }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-['Poppins'] antialiased">
    <div class="min-h-screen bg-gray-50 flex flex-col">
        @include('layouts.navigation')
        
        {{-- Page Heading --}}
        @isset($header)
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset
        
        {{-- Page Content --}}
        <main class="flex-grow">
            {{ $slot }}
        </main>

        {{-- Footer --}}
        <footer class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white py-10 mt-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
                    
                    {{-- Brand --}}
                    <div>
                        <h3 class="text-xl font-bold">SmartDose</h3>
                        <p class="text-sm mt-2 opacity-90">
                            Smart medication management for a healthier life.
                        </p>
                    </div>

                    {{-- Links --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-3">Quick Links</h4>
                        <ul class="space-y-2 text-sm">
                            <li>
                                <a href="{{ route('about') }}" class="hover:underline opacity-90 hover:opacity-100">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact') }}" class="hover:underline opacity-90 hover:opacity-100">
                                    Contact Us
                                </a>
                            </li>
                        </ul>
                    </div>

                    {{-- Contact --}}
                    <div>
                        <h4 class="text-lg font-semibold mb-3">Contact</h4>
                        <p class="text-sm opacity-90">Email: support@smartdose.com</p>
                        <p class="text-sm opacity-90 mt-1">Phone: +20 100 000 0000</p>
                    </div>
                </div>

                <div class="border-t border-white/30 mt-8 pt-6 text-center text-sm opacity-90">
                    © {{ now()->year }} SmartDose. All rights reserved.
                    <span class="block mt-1">Made by Arywan</span>
                </div>
            </div>
        </footer>
    </div>
</body>
</html>
