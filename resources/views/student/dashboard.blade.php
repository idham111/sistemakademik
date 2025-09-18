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
    
    <br>
    
    {{-- Tombol untuk melihat daftar mata kuliah --}}
    <a href="{{ route('student.courses.index') }}" style="display:inline-block; padding: 10px 15px; background-color: #007bff; color: white; text-decoration:none; border-radius:5px;">
        Lihat Daftar Mata Kuliah
    </a>
@endsection