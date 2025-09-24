# Sistem Akademik Sederhana (Mission 4)

Proyek ini merupakan sistem akademik sederhana yang dibangun dengan Laravel. Mission 4 menambahkan interaktivitas frontend menggunakan JavaScript vanilla untuk validasi, konfirmasi, dan pendaftaran mata kuliah tanpa refresh halaman.

## Fitur Unggulan

- **Manajemen Admin**:
  - CRUD (Create, Read, Update, Delete) untuk data mahasiswa dan mata kuliah.
  - Validasi form input di sisi klien (JavaScript) untuk mencegah input kosong.
  - Dialog konfirmasi dinamis sebelum menghapus data.
- **Panel Mahasiswa**:
  - Dashboard mahasiswa.
  - Halaman pendaftaran mata kuliah interaktif.
  - Pemilihan mata kuliah menggunakan *checklist*.
  - Perhitungan total SKS yang dipilih secara *real-time*.
  - Proses pendaftaran (enroll) berjalan di latar belakang (tanpa *refresh*).
- **UI/UX**:
  - Menu sidebar dengan penanda aktif sesuai halaman yang dibuka.
  - Notifikasi sukses yang muncul sementara.

## Teknologi yang Digunakan

- **Backend**: Laravel, PHP
- **Frontend**: HTML, JavaScript (Vanilla JS), CSS
- **Database**: SQLite (default, dapat diubah di `.env`)

## Screenshot Hasil Uji Coba

*(Anda bisa menambahkan screenshot di sini nanti)*

*Tampilan Halaman Kelola Mata Kuliah oleh Admin*

*Tampilan Halaman Pendaftaran Mata Kuliah untuk Mahasiswa*