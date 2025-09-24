@extends('layouts.admin')

@section('title', 'Tambah Mata Kuliah Baru')

@section('content')
    <h1>Form Tambah Mata Kuliah</h1>

    <a href="{{ route('admin.courses.index') }}"><< Kembali ke Daftar Mata Kuliah</a>
    <br><br>

    {{-- Tampilkan error validasi dari server jika ada --}}
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

    {{-- Form diberi ID agar bisa ditarget oleh JavaScript --}}
    <form action="{{ route('admin.courses.store') }}" method="POST" id="createCourseForm">
        @csrf
        <div style="margin-bottom: 15px;">
            <label for="kode_matkul">Kode Mata Kuliah:</label><br>
            <input type="text" id="kode_matkul" name="kode_matkul" value="{{ old('kode_matkul') }}"  style="width: 300px; padding: 5px; border: 1px solid #ddd;">
            {{-- Elemen untuk pesan error, awalnya disembunyikan --}}
            <div id="kode-error" style="color: red; font-size: 0.9em; display: none; margin-top: 5px;">Kode mata kuliah tidak boleh kosong.</div>
        </div>
        
        <div style="margin-bottom: 15px;">
            <label for="nama_matkul">Nama Mata Kuliah:</label><br>
            <input type="text" id="nama_matkul" name="nama_matkul" value="{{ old('nama_matkul') }}"  style="width: 300px; padding: 5px; border: 1px solid #ddd;">
             {{-- Elemen untuk pesan error --}}
            <div id="nama-error" style="color: red; font-size: 0.9em; display: none; margin-top: 5px;">Nama mata kuliah tidak boleh kosong.</div>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="sks">Jumlah SKS:</label><br>
            <input type="number" id="sks" name="sks" value="{{ old('sks', 3) }}"  style="width: 300px; padding: 5px; border: 1px solid #ddd;">
             {{-- Elemen untuk pesan error --}}
            <div id="sks-error" style="color: red; font-size: 0.9em; display: none; margin-top: 5px;">Jumlah SKS harus diisi dan berupa angka.</div>
        </div>

        <div style="margin-bottom: 15px;">
            <label for="deskripsi">Deskripsi (Opsional):</label><br>
            <textarea id="deskripsi" name="deskripsi" rows="4" style="width: 300px; padding: 5px;">{{ old('deskripsi') }}</textarea>
        </div>
        
        <button type="submit" style="padding: 10px 20px;">Simpan</button>
    </form>
@endsection

@push('scripts')
<script>
    // Menambahkan event listener ke form saat akan di-submit
    document.getElementById('createCourseForm').addEventListener('submit', function(event) {
        // Hentikan perilaku default form (agar tidak langsung submit & refresh)
        event.preventDefault();
        
        let formIsValid = true;

        // Ambil semua elemen input dan error yang relevan
        const kodeInput = document.getElementById('kode_matkul');
        const namaInput = document.getElementById('nama_matkul');
        const sksInput = document.getElementById('sks');

        const kodeError = document.getElementById('kode-error');
        const namaError = document.getElementById('nama-error');
        const sksError = document.getElementById('sks-error');

        // --- Reset tampilan error ---
        kodeInput.style.borderColor = '#ddd';
        kodeError.style.display = 'none';
        namaInput.style.borderColor = '#ddd';
        namaError.style.display = 'none';
        sksInput.style.borderColor = '#ddd';
        sksError.style.display = 'none';

        // --- Lakukan Validasi ---

        // Validasi Kode Mata Kuliah
        if (kodeInput.value.trim() === '') {
            formIsValid = false;
            kodeInput.style.borderColor = 'red'; // Border merah
            kodeError.style.display = 'block';   // Tampilkan pesan error
        }

        // Validasi Nama Mata Kuliah
        if (namaInput.value.trim() === '') {
            formIsValid = false;
            namaInput.style.borderColor = 'red';
            namaError.style.display = 'block';
        }

        // Validasi SKS
        if (sksInput.value.trim() === '' || isNaN(sksInput.value)) {
            formIsValid = false;
            sksInput.style.borderColor = 'red';
            sksError.style.display = 'block';
        }

        // Jika semua validasi lolos, submit form secara manual
        if (formIsValid) {
            event.target.submit();
        }
    });
</script>
@endpush