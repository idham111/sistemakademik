<h1>Detail Mahasiswa</h1>
<p>NIM: {{ $mahasiswa->nim }}</p>
<p>Nama: {{ $mahasiswa->nama }}</p>
<p>Umur: {{ $mahasiswa->umur }}</p>
<a href="{{ route('mahasiswa.index') }}">Kembali</a>
