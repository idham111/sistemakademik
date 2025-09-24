@extends('layouts.admin')

@section('title', 'Detail Mata Kuliah')

@section('content')
    <h1>Detail Mata Kuliah</h1>

    <a href="{{ route('admin.courses.index') }}"><< Kembali ke Daftar Mata Kuliah</a>
    <br><br>

    {{-- Kode di bawah ini telah diperbaiki dari $student menjadi $course --}}
    <table style="width: 50%;">
        <tr>
            <th style="width: 30%; text-align: left;">Kode Mata Kuliah</th>
            <td>{{ $course->kode_matkul }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Nama Mata Kuliah</th>
            <td>{{ $course->nama_matkul }}</td>
        </tr>
        <tr>
            <th style="text-align: left; vertical-align: top;">Deskripsi</th>
            <td>{{ $course->deskripsi ?? 'Tidak ada deskripsi.' }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Dibuat Pada</th>
            <td>{{ $course->created_at->format('d M Y, H:i') }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Diperbarui Pada</th>
            <td>{{ $course->updated_at->format('d M Y, H:i') }}</td>
        </tr>
    </table>
@endsection