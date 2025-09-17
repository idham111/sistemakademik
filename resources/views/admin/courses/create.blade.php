<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tambah Mahasiswa</title>
    <style>body { font-family: sans-serif; margin: 2em; } .error { color: red; font-size: 0.9em; }</style>
</head>
<body>
    <h1>Form Tambah Mahasiswa</h1>
    <a href="{{ route('admin.students.index') }}"><< Kembali</a>
    <br><br>
    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        <div>
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username') }}" required>
            @error('username') <div class="error">{{ $message }}</div> @enderror
        </div>
        <br>
        <div>
            <label>Password:</label><br>
            <input type="password" name="password" required>
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>