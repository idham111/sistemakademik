@extends('layouts.admin')

@section('title', 'Kelola Mata Kuliah')

@section('content')
    <h1>Daftar Mata Kuliah</h1>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('admin.courses.create') }}" style="display:inline-block; padding: 10px; background-color: #007bff; color: white; text-decoration:none; border-radius:5px;">+ Tambah Mata Kuliah</a>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Matkul</th>
                <th>Nama Matkul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courses as $index => $course)
                <tr>
                    <td>{{ $courses->firstItem() + $index }}</td>
                    <td>{{ $course->kode_matkul }}</td>
                    <td>{{ $course->nama_matkul }}</td>
                    <td>
                        <a href="{{ route('admin.courses.edit', $course->id) }}" style="color: #ffc107;">Edit</a>
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus mata kuliah ini?')" style="border:none; background:transparent; color:red; cursor:pointer;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Tidak ada data mata kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    {{ $courses->links() }}
@endsection