<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel - Welcome</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            background: url('/images/triaje1.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .bg-glass {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 1rem;
            padding: 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .btn-custom {
            min-width: 120px;
        }
    </style>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="#">Edgar Camacho Mercado</a>
        @if (Route::has('login'))
            <div class="d-flex gap-2">
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-custom">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-custom">Login</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-success btn-custom">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</nav>

<!-- Main Content -->
<main class="flex-grow-1 d-flex align-items-center justify-content-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="bg-glass text-center">
                    <h1 class="mb-4 fw-bold">Bienvenidos al Sistema de Triaje </h1>
                    <p class="lead text-muted mb-4">Hospital de Warnes</p>
                    <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="text-center text-white-50 py-3">
    © {{ date('Y') }} Laravel. All rights reserved.
</footer>

<!-- Bootstrap 5 Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
