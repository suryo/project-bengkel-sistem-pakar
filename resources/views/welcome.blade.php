<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Bengkel Sistem Pakar') }}</title>
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS (via CDN for Landing Page to ensure standalone look or reuse app.css) -->
    <!-- Using the same Vite build as the app for consistency -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    
    <style>
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1619642751034-765dfdf7c58e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .service-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #0d6efd;
        }
        .feature-box {
            transition: transform 0.3s;
        }
        .feature-box:hover {
            transform: translateY(-5px);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Bengkel Pakar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    @if (Route::has('login'))
                        @auth
                            <li class="nav-item"><a class="nav-link btn btn-primary text-white ms-2" href="{{ url('/dashboard') }}">Dashboard</a></li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                            @if (Route::has('register'))
                                <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <header id="home" class="hero-section text-center">
        <div class="container">
            <h1 class="display-3 fw-bold mb-4">Solusi Cerdas Perawatan Kendaraan Anda</h1>
            <p class="lead mb-4">Layanan bengkel profesional untuk Mobil, Motor, dan Sepeda dengan dukungan Sistem Pakar.</p>
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Mulai Konsultasi / Booking</a>
        </div>
    </header>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Layanan Kami</h2>
                <p class="text-muted">Apapun kendaraan Anda, kami siap melayani.</p>
            </div>
            <div class="row g-4">
                <!-- Car Service -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-box">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-car-front service-icon">🚗</i>
                            <h4 class="card-title">Bengkel Mobil</h4>
                            <p class="card-text">Service berkala, ganti oli, tune up, dan perbaikan mesin mobil dengan mekanik berpengalaman.</p>
                        </div>
                    </div>
                </div>
                <!-- Motorcycle Service -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-box">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-bicycle service-icon">🏍️</i>
                            <h4 class="card-title">Bengkel Motor</h4>
                            <p class="card-text">Perawatan motor matic, bebek, hingga sport. Pengecekan menyeluruh untuk performa maksimal.</p>
                        </div>
                    </div>
                </div>
                <!-- Bicycle Service -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm feature-box">
                        <div class="card-body text-center p-5">
                            <i class="bi bi-bicycle service-icon">🚲</i>
                            <h4 class="card-title">Bengkel Sepeda</h4>
                            <p class="card-text">Service sepeda gunung (MTB), balap (Road Bike), dan sepeda lipat. Setting gear dan rem presisi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Expert System Feature -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1581092160562-40aa08e78837?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Diagnostic" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6 ps-md-5 mt-4 mt-md-0">
                    <h2 class="fw-bold">Didukung Sistem Pakar</h2>
                    <p class="lead">Tidak yakin apa yang salah dengan kendaraan Anda?</p>
                    <p>Sistem kami menggunakan basis pengetahuan cerdas untuk membantu mendiagnosa masalah kendaraan Anda berdasarkan gejala yang muncul. Dapatkan estimasi kerusakan dan biaya sebelum perbaikan.</p>
                    <ul class="list-unstyled">
                        <li class="mb-2">✅ Diagnosa Cepat & Akurat</li>
                        <li class="mb-2">✅ Estimasi Biaya Transparan</li>
                        <li class="mb-2">✅ Riwayat Service Terintegrasi</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Bengkel Sistem Pakar. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
