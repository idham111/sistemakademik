<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Mahasiswa</title>
    <style>body { font-family: sans-serif; margin: 2em; } .error { color: red; font-size: 0.9em; }</style>
</head>
<body>
    <h1>Form Edit Mahasiswa</h1>
    <a href="{{ route('admin.students.index') }}"><< Kembali</a>
    <br><br>
    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label>Username:</label><br>
            <input type="text" name="username" value="{{ old('username', $student->username) }}" required>
            @error('username') <div class="error">{{ $message }}</div> @enderror
        </div>
        <br>
        <div>
            <label>Password Baru (Opsional):</label><br>
            <input type="password" name="password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
            <small>Kosongkan jika tidak ingin mengubah password.</small>
        </div>
        <br>
        <button type="submit">Update</button>
    </form>
</body>
</html>