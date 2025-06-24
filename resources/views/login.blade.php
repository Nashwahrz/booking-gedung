@extends('template')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #2d7a8d, #1e2c3d);
        font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 2.5rem;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease-in-out;
    }
    .login-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .login-card .form-control:focus {
        border-color: #2d7a8d;
        box-shadow: 0 0 0 0.2rem rgba(45, 122, 141, 0.25);
    }

    .login-card .input-group-text {
        background-color: #f0f4f8;
        border-right: 0;
    }

    .btn-primary {
        background-color: #2d7a8d;
        border-color: #2d7a8d;
    }

    .btn-primary:hover {
        background-color: #25697a;
        border-color: #25697a;
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-card w-100" style="max-width: 420px;">
        <div class="text-center mb-4">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 50px;" class="mb-3">
            <h3 class="fw-bold text-dark">Login Pengguna</h3>
            <p class="text-muted small">Silakan masuk untuk mengakses sistem</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope text-primary"></i></span>
                    <input type="email" name="email" id="email"
                        class="form-control" value="{{ old('email') }}" required placeholder="email@example.com">
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label fw-semibold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock text-primary"></i></span>
                    <input type="password" name="password" id="password"
                        class="form-control" required placeholder="••••••••">
                </div>
            </div>

            <div class="d-grid mb-2">
                <button type="submit" class="btn btn-primary fw-semibold shadow-sm">
                    <i class="fas fa-sign-in-alt me-2"></i> Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
