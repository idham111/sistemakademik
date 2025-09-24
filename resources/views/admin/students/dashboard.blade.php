@extends('layouts.admin')

@section('title', 'Dashboard Mahasiswa')

@section('content')
    <h1>Dashboard Mahasiswa</h1>
    <p>
        Selamat datang, <strong>{{ Auth::user()->username }}</strong>!
    </p>
    <p>
        Ini adalah halaman dashboard Anda. Dari sini Anda bisa melihat dan mendaftar ke mata kuliah yang tersedia.
    </p>
    
    {{-- Nanti di sini kita akan tambahkan link ke halaman daftar mata kuliah --}}
    {{-- <a href="{{ route('student.courses.index') }}">Lihat Mata Kuliah</a> --}}
@endsection