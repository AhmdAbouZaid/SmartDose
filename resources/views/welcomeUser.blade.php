<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDose | Smart Pill Dispenser</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-['Poppins']">

    <!-- Navbar -->
    <nav class="bg-blue-600">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="#" class="text-white text-xl font-bold">SmartDose</a>
                
                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="lg:hidden text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="#" class="text-white hover:text-blue-100 transition">Home</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">Shop</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">Consultations</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">About</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">Contact</a>
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white font-semibold hover:text-blue-100 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-100 transition">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-blue-100 transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden pb-4">
                <div class="flex flex-col space-y-3">
                    <a href="#" class="text-white hover:text-blue-100 transition">Home</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">Shop</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">Consultations</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">About</a>
                    <a href="#" class="text-white hover:text-blue-100 transition">Contact</a>
                    
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-white font-semibold hover:text-blue-100 transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:text-blue-100 transition">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-white hover:text-blue-100 transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-cyan-400 text-white py-24 text-center">
        <div class="container mx-auto px-4">
            <h1 class="text-5xl font-semibold mb-4">Smart Pill Dispenser for a Healthier You</h1>
            <p class="text-lg opacity-95 mb-6">Organize your medication easily and never miss a dose again.</p>
            <a href="#" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-medium hover:bg-blue-50 transition">
                Shop Now
            </a>
        </div>
    </section>

    <!-- Features -->
    <section class="py-16 container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold text-blue-600 mb-12">Why Choose SmartDose?</h2>
        
        <div class="grid md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <img src="https://cdn-icons-png.flaticon.com/512/4762/4762314.png" 
                     width="70" 
                     alt="Smart Alerts" 
                     class="mx-auto mb-4">
                <h5 class="text-lg font-semibold mb-3">Smart Alerts</h5>
                <p class="text-gray-600">Get timely reminders to take your medication at the right time.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <img src="https://cdn-icons-png.flaticon.com/512/2920/2920322.png" 
                     width="70" 
                     alt="Easy Refill" 
                     class="mx-auto mb-4">
                <h5 class="text-lg font-semibold mb-3">Easy Refill</h5>
                <p class="text-gray-600">Simple and fast way to manage your pill refills directly from the app.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white rounded-xl p-8 shadow-md hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                <img src="https://cdn-icons-png.flaticon.com/512/2966/2966487.png" 
                     width="70" 
                     alt="Medical Insights" 
                     class="mx-auto mb-4">
                <h5 class="text-lg font-semibold mb-3">Medical Insights</h5>
                <p class="text-gray-600">Track your dosage history and receive health insights instantly.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-blue-600 text-white text-center py-5 mt-12">
        <p>© 2025 SmartDose. All Rights Reserved.</p>
    </footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>