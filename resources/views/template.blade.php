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
        backdrop-filter: blur(6px);
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
        transition: color 0.3s ease;
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
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
        padding: 10px 0;
    }

    footer span {
        color: #d9f4f7;
    }
</style>

</head>
<body>

    {{-- NAVBAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm sticky-top" style="background-color: #1f6cc3;">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo"> Booking Gedung
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                {{-- Kiri --}}
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gedung.index') }}">Data Gedung</a>
                        </li>
                    @endauth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('pemesanan.form') }}">Cek Pemesanan</a>
                    </li>
                </ul>

                {{-- Kanan --}}
                @auth
                    <ul class="navbar-nav align-items-center">
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
    <footer class="bg-light text-center mt-5 py-3 shadow-sm">
        <div class="container">
            <span class="text-muted">© {{ date('Y') }} Booking Gedung App</span>
        </div>
    </footer>

    {{-- Bootstrap Bundle JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
