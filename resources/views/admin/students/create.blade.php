<h1>Tambah Mahasiswa</h1>
<form action="{{ route('mahasiswa.store') }}" method="POST">
    @csrf
    NIM: <input type="text" name="nim"><br>
    Nama: <input type="text" name="nama"><br>
    Umur: <input type="number" name="umur"><br>
    <button type="submit">Simpan</button>
</form>
