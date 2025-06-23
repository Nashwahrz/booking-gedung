@extends('template')

@section('content')
<style>
    body {
        background: #eaf4fc;
        font-family: 'Segoe UI', sans-serif;
    }
    .login-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        transition: 0.3s;
    }
    .login-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0, 0, 0, 0.08);
    }
</style>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="login-card" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">Login</h3>
            <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" id="email"
                        class="form-control" value="{{ old('email') }}" required placeholder="email@example.com">
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light"><i class="fas fa-lock"></i></span>
                    <input type="password" name="password" id="password"
                        class="form-control" required placeholder="••••••••">
                </div>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary fw-semibold">
                    <i class="fas fa-sign-in-alt me-1"></i> Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
