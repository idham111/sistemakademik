@extends('layouts.admin')

@section('title', 'Edit Mata Kuliah')

@section('content')
    <h1>Form Edit Mata Kuliah</h1>

    <a href="{{ route('admin.courses.index') }}"><< Kembali ke Daftar Mata Kuliah</a>
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
    <form action="{{ route('admin.courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label for="kode_matkul">Kode Mata Kuliah:</label><br>
            <input type="text" id="kode_matkul" name="kode_matkul" value="{{ old('kode_matkul', $course->kode_matkul) }}" required style="width: 300px; padding: 5px;">
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="nama_matkul">Nama Mata Kuliah:</label><br>
            <input type="text" id="nama_matkul" name="nama_matkul" value="{{ old('nama_matkul', $course->nama_matkul) }}" required style="width: 300px; padding: 5px;">
        </div>

        <div style="margin-bottom