<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SmartDose</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-['Poppins']">

    <!-- Navbar -->
    <nav class="bg-blue-600">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ url('/') }}" class="text-white text-xl font-bold">SmartDose</a>
                
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ url('/') }}" class="text-white hover:text-blue-100 transition">Home</a>
                    <a href="{{ route('about') }}" class="text-white font-semibold">About</a>
                    <a href="{{ route('contact') }}" class="text-white hover:text-blue-100 transition">Contact</a>
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white hover:text-blue-100 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-100 transition">Log in</a>
                            <a href="{{ route('register') }}" class="text-white hover:text-blue-100 transition">Register</a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-4">About SmartDose</h1>
            <p class="text-xl opacity-90">Making Medication Management Simple & Safe</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-16 container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Our Story</h2>
            
            <div class="bg-white rounded-xl shadow-md p-8 mb-8">
                <p class="text-gray-700 leading-relaxed mb-4">
                    SmartDose was born from a simple observation: people forget to take their medications. 
                    This seemingly small problem has devastating consequences, leading to thousands of preventable 
                    deaths and hospitalizations every year.
                </p>
                <p class="text-gray-700 leading-relaxed mb-4">
                    Our team of healthcare innovators and engineers came together with a mission: to create 
                    a smart, automated solution that ensures no one misses their medication again.
                </p>
                <p class="text-gray-700 leading-relaxed">
                    The Smart Pill Dispenser is the result of years of research, development, and real-world 
                    testing. It's not just a product—it's a lifeline for millions of people who rely on 
                    daily medications to stay healthy.
                </p>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-12">The Problem We're Solving</h2>
            
            <div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <div class="text-center p-6 bg-red-50 rounded-xl">
                    <div class="text-5xl font-bold text-red-600 mb-2">125,000+</div>
                    <p class="text-gray-700 font-semibold">Deaths Annually</p>
                    <p class="text-sm text-gray-600 mt-2">Due to medication non-adherence globally</p>
                </div>
                
                <div class="text-center p-6 bg-orange-50 rounded-xl">
                    <div class="text-5xl font-bold text-orange-600 mb-2">50%</div>
                    <p class="text-gray-700 font-semibold">Don't Take Meds Correctly</p>
                    <p class="text-sm text-gray-600 mt-2">Of patients with chronic conditions</p>
                </div>
                
                <div class="text-center p-6 bg-yellow-50 rounded-xl">
                    <div class="text-5xl font-bold text-yellow-600 mb-2">$300B</div>
                    <p class="text-gray-700 font-semibold">Healthcare Costs</p>
                    <p class="text-sm text-gray-600 mt-2">Wasted annually due to medication errors</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Solution -->
    <section class="py-16 container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-12">How SmartDose Helps</h2>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Automated Reminders</h3>
                    <p class="text-gray-600">Never forget a dose with smart alerts and notifications</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Precise Dosing</h3>
                    <p class="text-gray-600">Accurate medication dispensing at the right time</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Family Monitoring</h3>
                    <p class="text-gray-600">Caregivers can track medication adherence remotely</p>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="w-12 h-12 bg-cyan-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Health Insights</h3>
                    <p class="text-gray-600">Track adherence and receive personalized recommendations</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center text-blue-600 mb-8">Made by Arywan</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto">
                Developed with passion and precision by Arywan, a dedicated team committed to 
                improving healthcare outcomes through innovative technology solutions.
            </p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white text-center py-6">
        <p>© 2025 SmartDose. All Rights Reserved.</p>
        <p class="text-sm text-gray-400 mt-2">Made by Arywan</p>
    </footer>

</body>
</html>