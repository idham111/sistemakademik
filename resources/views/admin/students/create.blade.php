@extends('layouts.admin')

@section('title', 'Tambah Mahasiswa')

@section('content')
    <h1>Form Tambah Mahasiswa</h1>

    <a href="{{ route('admin.students.index') }}"><< Kembali ke Daftar Mahasiswa</a>
    <br><br>

    {{-- Tampilkan error validasi jika ada --}}
    @if ($errors->any())
        <div style="color: red; margin-bottom: 20px;">
            <strong>Whoops! Ada beberapa masalah dengan input Anda.</strong><br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- === BAGIAN YANG DIPERBAIKI === --}}
    <form action="{{ route('admin.students.store') }}" method="POST">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" value="{{ old('username') }}" required style="width: 300px; padding: 5px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required style="width: 300px; padding: 5px;">
        </div>
        
        <button type="submit" style="padding: 10px 20px;">Simpan</button>
    </form>
@endsection