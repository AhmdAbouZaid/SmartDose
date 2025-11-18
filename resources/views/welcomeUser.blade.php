<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartDose | Smart Pill Dispenser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fafc;
            font-family: 'Poppins', sans-serif;
        }

        .navbar {
            background-color: #007bff;
        }

        .navbar-brand,
        .nav-link {
            color: #fff !important;
        }

        .hero {
            background: linear-gradient(to right, #007bff, #00c4cc);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 600;
        }

        .hero p {
            font-size: 1.2rem;
            margin-top: 15px;
        }

        .btn-custom {
            background-color: #fff;
            color: #007bff;
            border-radius: 30px;
            padding: 10px 25px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background-color: #e3f2fd;
        }

        .features {
            padding: 60px 0;
        }

        .feature-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
        }

        .feature-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .footer {
            background-color: #007bff;
            color: white;
            padding: 20px 0;
            text-align: center;
            margin-top: 50px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">SmartDose</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon bg-light"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Shop</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Consultations</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
                </ul>

                {{-- 🔹 هنا جزء الـ Login / Register --}}
                @if (Route::has('login'))
                    <ul class="navbar-nav ms-3">
                        @auth
                            <li class="nav-item">
                                <a href="{{ url('/dashboard') }}" class="nav-link fw-semibold text-white">
                                    Dashboard
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a href="{{ route('login') }}" class="nav-link fw-normal text-white">
                                    Log in
                                </a>

                            </li>

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a href="{{ route('register') }}" class="nav-link fw-normal text-white">
                                        Register
                                    </a>

                                </li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container">
            <h1>Smart Pill Dispenser for a Healthier You</h1>
            <p>Organize your medication easily and never miss a dose again.</p>
            <a href="#" class="btn btn-custom mt-3">Shop Now</a>
        </div>
    </section>

    <!-- Features -->
    <section class="features container text-center">
        <h2 class="mb-5 fw-bold text-primary">Why Choose SmartDose?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/4762/4762314.png" width="70"
                        alt="Smart Alerts">
                    <h5 class="mt-3">Smart Alerts</h5>
                    <p>Get timely reminders to take your medication at the right time.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/2920/2920322.png" width="70" alt="Easy Refill">
                    <h5 class="mt-3">Easy Refill</h5>
                    <p>Simple and fast way to manage your pill refills directly from the app.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box">
                    <img src="https://cdn-icons-png.flaticon.com/512/2966/2966487.png" width="70"
                        alt="Medical Insights">
                    <h5 class="mt-3">Medical Insights</h5>
                    <p>Track your dosage history and receive health insights instantly.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <p>© 2025 SmartDose. All Rights Reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
