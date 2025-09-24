@extends('layouts.admin')

@section('title', 'Kelola Mata Kuliah')

@section('content')
    <h1>Daftar Mata Kuliah</h1>

    @if (session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif
    
    <a href="{{ route('admin.courses.create') }}" style="display:inline-block; margin-bottom: 20px; padding: 10px; background-color: #007bff; color: white; text-decoration:none; border-radius:5px;">+ Tambah Mata Kuliah</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Matkul</th>
                <th>Nama Matkul</th>
                <th>SKS</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courses as $index => $course)
                <tr>
                    <td>{{ $courses->firstItem() + $index }}</td>
                    <td>{{ $course->kode_matkul }}</td>
                    <td>{{ $course->nama_matkul }}</td>
                    <td style="text-align: center;">{{ $course->sks ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('admin.courses.show', $course->id) }}" style="color: #17a2b8; text-decoration: none;">Detail</a> |
                        <a href="{{ route('admin.courses.edit', $course->id) }}" style="color: #ffc107; text-decoration: none;">Edit</a> |
                        
                        <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete(event, '{{ $course->nama_matkul }}', '{{ $course->sks ?? 0 }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="border:none; background:transparent; color:red; cursor:pointer; padding:0; font-family: sans-serif; font-size: 1em;">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">Tidak ada data mata kuliah.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <br>
    {{ $courses->links() }}
@endsection

@push('scripts')
<script>
    function confirmDelete(event, courseName, sks) {
        event.preventDefault(); 
        const message = `Apakah Anda yakin ingin menghapus mata kuliah:\n\n${courseName} (${sks} SKS)?\n\nAksi ini tidak dapat dibatalkan.`;
        if (confirm(message)) {
            event.target.submit(); 
        }
    }
</script>
@endpush