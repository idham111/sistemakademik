@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
    <h1>Dashboard Admin</h1>
    <p>
        Selamat datang, <strong>{{ Auth::user()->username }}</strong>!
    </p>
    <p>
        Anda memiliki akses penuh untuk mengelola data mata kuliah dan mahasiswa.
    </p>
@endsection