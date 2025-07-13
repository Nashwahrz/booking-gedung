<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Gedung</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Font Awesome --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    {{-- Custom Global Style --}}
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f7;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            display: flex;
            align-items: center;
            color: white;
        }

        .navbar-brand img {
            height: 40px;
            margin-right: 12px;
        }

        .nav-link {
            color: white !important;
            position: relative;
            padding: 8px 15px;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 50%;
            width: 0;
            height: 2px;
            background-color: #ccecee;
            transition: 0.3s;
            transform: translateX(-50%);
        }

        .nav-link:hover::after {
            width: 70%;
        }

        .nav-link:hover {
            color: #ccecee !important;
        }

        .btn-light {
            background-color: #ffffff;
            color: #2d7a8d;
            border: none;
            padding: 6px 15px;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background-color: #2d7a8d;
            color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-outline-light {
            border-color: white;
            color: white;
            border-radius: 6px;
            padding: 6px 15px;
        }

        .btn-outline-light:hover {
            background-color: white;
            color: #2d7a8d;
        }

        footer {
            background-color: #1e2c3d;
            color: #ccc;
            padding: 20px 0;
            font-size: 14px;
        }

        footer a {
            color: #ccecee;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            margin: 0 8px;
            color: #ccecee;
            font-size: 18px;
        }

        .social-icons a:hover {
            color: #ffffff;
        }

        @media (max-width: 576px) {
    .navbar-brand img {
        height: 32px;
    }

    .navbar .nav-link {
        padding: 6px 10px;
        font-size: 14px;
    }

    footer {
        font-size: 12px;
    }
}

    </style>

</head>

<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand">
                <img src="{{ asset('img/logo.png') }}" alt="Logo"> Booking Gedung
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                {{-- Kiri --}}
                <ul class="navbar-nav">
                    @auth
                         @if (in_array(auth()->user()->role, ['admin', 'superadmin']))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/') }}">Home</a>
                            </li>
                             <li class="nav-item">
                                <a class="nav-link" href="{{ route('pemesanan.form') }}">Cek Pemesanan</a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gedung.index') }}">Data Gedung</a>
                        </li>

                         @if (in_array(auth()->user()->role, ['admin', 'superadmin']))

                        @endif
                    @endauth

                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pemesanan.form') }}">Cek Pemesanan</a>
                        </li>
                        <li class="nav-item">
                           <a href="#contact" class="nav-link">Kontak</a>
                        </li>
                    @endguest
                </ul>

                {{-- Kanan --}}
                @auth




                    <ul class="navbar-nav align-items-center">
                        <li class="nav-item me-2 text-white">
    <i class="bi bi-person-circle me-1"></i> {{ auth()->user()->name }}
</li>

                        <li class="nav-item me-2">
                            <a class="nav-link btn px-3 py-1" href="{{ route('pemesanan.index') }}">
                                Kelola Pemesanan
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" onsubmit="return confirm('Yakin mau logout?')" class="d-inline">
                                @csrf
                                <button class="btn btn-outline-light px-3 py-1" type="submit">Logout</button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </nav>

    {{-- KONTEN UTAMA --}}
    @yield('content')

    {{-- FOOTER --}}
     <footer class="mt-5">
        <div class="container text-center">
            <div class="mb-2">
                <strong>Nashwa Harzathi</strong> &bull; Developer & UI Designer
            </div>
            <div class="social-icons">
                <a href="https://instagram.com/nsshw.z" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://github.com/nashwahrz" target="_blank"><i class="fab fa-github"></i></a>
               <a href="https://mail.google.com/mail/?view=cm&fs=1&to=nashwaharzathi05@gmail.com" target="_blank">
    <i class="fas fa-envelope"></i>
</a>

            </div>
            <div class="mt-2">
                &copy; {{ date('Y') }} Booking Gedung App &mdash; All rights reserved.
            </div>
        </div>
    </footer>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
