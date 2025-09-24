@extends('layouts.admin')

@section('title', 'Kelola Mahasiswa')

@section('content')
    <h1>Daftar Mahasiswa</h1>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.students.create') }}" style="display:inline-block; margin-bottom: 20px; padding: 10px; background-color: #007bff; color: white; text-decoration:none; border-radius:5px;">+ Tambah Mahasiswa</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Role</th>
                <th>Tanggal Dibuat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($students as $index => $student)
                <tr>
                    <td>{{ $students->firstItem() + $index }}</td>
                    <td>{{ $student->username }}</td>
                    <td>{{ $student->role }}</td>
                    <td>{{ $student->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('admin.students.show', $student->id) }}" style="color: #17a2b8; text-decoration: none;">Detail</a> |
                        <a href="{{ route('admin.students.edit', $student->id) }}" style="color: #ffc107; text-decoration: none;">Edit</a> |
                        <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')" style="border:none; background:transparent; color:red; cursor:pointer; padding:0; font-family: sans-serif; font-size: 1em;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center;">Tidak ada data mahasiswa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    {{ $students->links() }}
@endsection