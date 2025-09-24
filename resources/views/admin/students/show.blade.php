@extends('layouts.admin')

@section('title', 'Detail Mahasiswa')

@section('content')
    <h1>Detail Mahasiswa</h1>

    <a href="{{ route('admin.students.index') }}"><< Kembali ke Daftar Mahasiswa</a>
    <br><br>

    {{-- Kode di bawah ini telah diperbaiki dari $course menjadi $student --}}
    <table style="width: 50%;">
        <tr>
            <th style="width: 30%; text-align: left;">ID Pengguna</th>
            <td>{{ $student->id }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Username</th>
            <td>{{ $student->username }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Role</th>
            <td>{{ $student->role }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Tanggal Terdaftar</th>
            <td>{{ $student->created_at->format('d M Y, H:i') }}</td>
        </tr>
        <tr>
            <th style="text-align: left;">Terakhir Diperbarui</th>
            <td>{{ $student->updated_at->format('d M Y, H:i') }}</td>
        </tr>
    </table>
@endsection9k