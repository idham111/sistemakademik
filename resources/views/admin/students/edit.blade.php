@extends('layouts.admin')

@section('title', 'Edit Mahasiswa')

@section('content')
    <h1>Form Edit Mahasiswa</h1>

    <a href="{{ route('admin.students.index') }}"><< Kembali ke Daftar Mahasiswa</a>
    <br><br>

    <form action="{{ route('admin.students.update', $student->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div>
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username', $student->username) }}" required>
            @error('username')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <div>
            <label for="password">Password Baru (Opsional):</label><br>
            <input type="password" id="password" name="password">
            <small>Kosongkan jika tidak ingin mengubah password.</small>
            @error('password')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>
        <br>
        <button type="submit">Update Data</button>
    </form>
@endsection