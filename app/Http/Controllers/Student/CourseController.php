<?php

// PASTIKAN NAMESPACE-NYA ADALAH Student
namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

// PASTIKAN NAMA CLASS-NYA BENAR
class CourseController extends Controller
{
    // ... (Fungsi index() dan enroll() Anda ada di sini)
    public function index()
    {
        return "<h1>Ini Halaman Daftar Mata Kuliah untuk Mahasiswa</h1>";
    }

    public function enroll(Request $request, Course $course)
    {
        return "<h1>Proses pendaftaran ke mata kuliah: {$course->nama_matkul}</h1>";
    }
}