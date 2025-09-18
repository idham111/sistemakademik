<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Akademik')</title>
    {{-- (Biarkan bagian <style> tidak berubah) --}}
    <style>
        body { font-family: sans-serif; display: flex; margin: 0; background-color: #f8f9fa; }
        .sidebar { width: 240px; background-color: #343a40; color: white; min-height: 100vh; padding: 20px; }
        .sidebar h3 { text-align: center; }
        .sidebar a { display: block; padding: 12px 15px; text-decoration: none; color: #adb5bd; border-radius: 5px; margin-bottom: 5px; }
        .sidebar a:hover, .sidebar a.active { background-color: #495057; color: white; }
        .sidebar .logout-btn { background: none; border: none; color: #adb5bd; padding: 12px 15px; text-align: left; width: 100%; cursor: pointer; font-size: 1em; font-family: sans-serif; }
        .sidebar .logout-btn:hover { background-color: #495057; color: white; }
        .content { flex-grow: 1; padding: 30px; }
        table { width: 100%; border-collapse: collapse; background-color: white; }
        th, td { border: 1px solid #ddd; padding: 12px; }
        th { background-color: #f2f2f2; }
        .success-message { padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        a { color: #007bff; }
    </style>
</head>
<body>
    <div class="sidebar">
        <h3>Sistem Akademik</h3>
        <hr style="border-color: #495057;">
        
        {{-- === BAGIAN YANG DIPERBAIKI === --}}
        @if (Auth::check())
            @if (Auth::user()->role == 'admin')
                {{-- Menu Admin --}}
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <a href="{{ route('admin.courses.index') }}">Kelola Mata Kuliah</a>
                <a href="{{ route('admin.students.index') }}">Kelola Mahasiswa</a>
            @elseif (Auth::user()->role == 'student')
                {{-- Menu Mahasiswa --}}
                <a href="{{ route('student.dashboard') }}">Dashboard</a>
                <a href="{{ route('student.courses.index') }}">Lihat Mata Kuliah</a>
            @endif
        @endif
        {{-- ============================= --}}
        
        <hr style="border-color: #495057;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <div class="content">
        @yield('content')
    </div>
</body>
</html>