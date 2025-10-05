<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Admin - Sistem Penduduk RT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="width: 400px;">
        <h4 class="mb-3 text-center">Daftar Admin RT</h4>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                @error('username') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
                @error('foto') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <hr>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="rt_rw" class="form-label">RT/RW</label>
                    <input type="text" name="rt_rw" class="form-control" value="{{ old('rt_rw') }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="kelurahan" class="form-label">Kelurahan</label>
                    <input type="text" name="kelurahan" class="form-control" value="{{ old('kelurahan') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="kecamatan" class="form-label">Kecamatan</label>
                <input type="text" name="kecamatan" class="form-control" value="{{ old('kecamatan') }}">
            </div>

            <div class="mb-3">
                <label for="kota" class="form-label">Kota</label>
                <input type="text" name="kota" class="form-control" value="{{ old('kota') }}">
            </div>

            <button class="btn btn-success w-100" type="submit">Daftar</button>

            <p class="text-center mt-3 mb-0">
                Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a>
            </p>
        </form>
    </div>
</body>
</html>
