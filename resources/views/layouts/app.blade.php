<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Sistem Penduduk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #212529;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar .logo {
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
        }

        .sidebar .logo img {
            width: 85px;
            height: 85px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #6c757d;
        }

        .sidebar .nav-link {
            color: #adb5bd;
            font-weight: 500;
            padding: 10px 20px;
            transition: all 0.2s ease-in-out;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
            color: #fff;
            border-radius: 8px;
        }

        .sidebar .logout {
            text-align: center;
            margin-bottom: 25px;
        }

        .content {
            margin-left: 250px;
            padding: 25px;
        }

        .sidebar small {
            color: #ced4da;
        }
    </style>
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <div>
            <div class="logo">
                {{-- Foto Admin --}}
                <img src="{{ asset('storage/' . ($user->foto ?? 'default.jpg')) }}" 
                     alt="Foto Admin">

                {{-- Nama & RT/RW --}}
                <h6 class="mt-2 mb-0 text-white">
                    {{ $user->username ?? 'Admin RT' }}
                </h6>
                <small>
                    RT {{ $user->rt_rw ?? '-' }}<br>
                    {{ $user->kelurahan ?? '-' }}, {{ $user->kecamatan ?? '-' }}<br>
                    {{ $user->kota ?? '-' }}
                </small>
            </div>

            {{-- Navigasi --}}
            <nav class="nav flex-column mt-4">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" 
                   href="{{ route('dashboard') }}">
                    🏠 Dashboard
                </a>

                <a class="nav-link {{ request()->is('penduduk*') ? 'active' : '' }}" 
                   href="{{ route('penduduk.index') }}">
                    👥 Penduduk
                </a>

                <a class="nav-link {{ request()->is('kk*') ? 'active' : '' }}" 
                   href="{{ route('kk.index') }}">
                    📄 Kartu Keluarga
                </a>

                <a class="nav-link {{ request()->is('mutasi*') ? 'active' : '' }}" 
                   href="{{ route('mutasi.index') }}">
                    🔄 Mutasi
                </a>

                <a class="nav-link {{ request()->is('surat*') ? 'active' : '' }}" 
                   href="{{ route('surat.index') }}">
                    📨 Surat
                </a>

                <a class="nav-link {{ request()->is('laporan*') ? 'active' : '' }}" 
                   href="{{ route('laporan.index') }}">
                    📊 Laporan
                </a>
            </nav>
        </div>

        {{-- Tombol Logout --}}
        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm w-75">Logout</button>
            </form>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="content">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
