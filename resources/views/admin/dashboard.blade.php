@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Dashboard Admin</h1>
    <p>
        Selamat datang, <strong>{{ Auth::user()->username }}</strong>!
    </p>
    <p>
        Anda login sebagai admin. Gunakan menu di samping untuk mengelola data mahasiswa dan mata kuliah.
    </p>
@endsection