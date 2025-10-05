<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Penduduk RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 1rem;
        }
        .card h4 {
            font-weight: 600;
        }
        .form-label {
            font-weight: 500;
        }
        .links {
            font-size: 0.9rem;
        }
        .links a {
            text-decoration: none;
        }
        .alert {
            font-size: 0.9rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 360px;">
        <h4 class="mb-4 text-center">Login RT</h4>

        @if(session('error'))
            <div class="alert alert-danger text-center">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required autofocus>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button class="btn btn-primary w-100 mb-3" type="submit">Login</button>

            <div class="d-flex justify-content-between links">
                <span>Belum punya akun? <a href="{{ route('register') }}">Daftar</a></span>
                <span><a href="{{ route('forgot.password') }}">Lupa Password?</a></span>
            </div>
        </form>
    </div>
</body>
</html>
