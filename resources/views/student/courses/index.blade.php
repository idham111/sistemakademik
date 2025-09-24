@extends('layouts.admin')

@section('title', 'Daftar Mata Kuliah')

@section('content')
    <h1>Pendaftaran Mata Kuliah</h1>
    <p>Pilih mata kuliah yang ingin Anda ambil semester ini.</p>

    {{-- Notifikasi sukses yang awalnya disembunyikan --}}
    <div id="enrollment-success" style="padding: 15px; margin-bottom: 20px; border-radius: 5px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; display:none;">
        Pendaftaran berhasil!
    </div>

    {{-- Form pendaftaran --}}
    <form id="enrollment-form">
        @csrf
        <table style="width: 100%; margin-bottom: 20px;">
            <thead>
                <tr>
                    <th style="width: 5%; text-align:center;">Pilih</th>
                    <th>Kode</th>
                    <th>Nama Mata Kuliah</th>
                    <th style="width: 10%; text-align:center;">SKS</th>
                </tr>
            </thead>
            <tbody id="course-list-body">
                {{-- Daftar mata kuliah akan di-render oleh JavaScript di sini --}}
                <tr><td colspan="4" style="text-align:center;">Memuat data...</td></tr>
            </tbody>
        </table>

        <hr>

        <div style="text-align: right; margin-top: 20px; display: flex; justify-content: flex-end; align-items: center;">
            <h3 style="margin-right: 20px;">Total SKS Dipilih: <span id="total-sks">0</span></h3>
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer;">Simpan Pilihan</button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 1. INISIALISASI DATA & ELEMEN
        // Mengambil data courses yang dikirim dari controller
        const courses = @json($coursesData);
        const courseListBody = document.getElementById('course-list-body');
        const totalSksElement = document.getElementById('total-sks');
        const enrollmentForm = document.getElementById('enrollment-form');
        const successMessage = document.getElementById('enrollment-success');
        
        // Menyimpan ID mata kuliah yang dipilih
        let selectedCourses = new Set();

        // 2. FUNGSI-FUNGSI UTAMA
        
        // Fungsi untuk me-render daftar mata kuliah ke dalam tabel
        function renderCourses() {
            courseListBody.innerHTML = ''; // Kosongkan tabel terlebih dahulu

            if (courses.length === 0) {
                courseListBody.innerHTML = '<tr><td colspan="4" style="text-align:center;">Belum ada mata kuliah yang tersedia.</td></tr>';
                return;
            }

            courses.forEach(course => {
                // Jika mata kuliah sudah diambil, tambahkan ke `selectedCourses`
                if (course.is_enrolled) {
                    selectedCourses.add(course.id);
                }

                const row = document.createElement('tr');
                row.innerHTML = `
                    <td style="text-align: center;">
                        <input type="checkbox" class="course-checkbox" value="${course.id}" data-sks="${course.sks}" ${course.is_enrolled ? 'checked' : ''}>
                    </td>
                    <td>${course.kode_matkul}</td>
                    <td>${course.nama_matkul}</td>
                    <td style="text-align: center;">${course.sks}</td>
                `;
                courseListBody.appendChild(row);
            });
            updateTotalSks(); // Update total SKS saat pertama kali render
        }

        // Fungsi untuk menghitung dan memperbarui total SKS
        function updateTotalSks() {
            let total = 0;
            const checkboxes = document.querySelectorAll('.course-checkbox:checked');
            checkboxes.forEach(checkbox => {
                total += parseInt(checkbox.dataset.sks);
            });
            totalSksElement.textContent = total;
        }

        // 3. EVENT LISTENERS

        // Event listener untuk setiap checkbox di tabel
        courseListBody.addEventListener('change', function(e) {
            if (e.target.classList.contains('course-checkbox')) {
                const courseId = parseInt(e.target.value);
                if (e.target.checked) {
                    selectedCourses.add(courseId);
                } else {
                    selectedCourses.delete(courseId);
                }
                updateTotalSks(); // Panggil fungsi update setiap ada perubahan
            }
        });

        // Event listener untuk form submit
        enrollmentForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Mencegah refresh halaman
            
            const enrolledIds = Array.from(selectedCourses);

            // Menggunakan Fetch API untuk mengirim data ke server secara asynchronous
            fetch("{{ route('student.courses.enroll') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                },
                body: JSON.stringify({ course_ids: enrolledIds })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                successMessage.textContent = data.message;
                successMessage.style.display = 'block';
                
                // Contoh Async: sembunyikan pesan setelah 3 detik
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 3000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
            });
        });

        // Panggil fungsi render untuk menampilkan data pertama kali
        renderCourses();
    });
</script>
@endpush