<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Gedung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    {{-- NAVBAR --}}
   <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ url('/') }}">Booking Gedung</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
            {{-- Kiri: Navigasi Umum --}}
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

            {{-- Kanan: Logout jika login --}}
            @auth
<ul class="navbar-nav align-items-center">
    <li class="nav-item me-2">
        <a class="nav-link btn btn-light  px-3 py-1" href="{{ route('pemesanan.index') }}">
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
    <div class="container mt-4">
        @yield('content')
    </div>

    {{-- FOOTER --}}
    <footer class="bg-light text-center mt-5 py-3 shadow-sm">
        <div class="container">
            <span class="text-muted">© {{ date('Y') }} Booking Gedung App</span>
        </div>
    </footer>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
