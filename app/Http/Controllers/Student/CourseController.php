<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * Menampilkan halaman daftar mata kuliah untuk mahasiswa.
     */
    public function index()
    {
        $student = Auth::user();
        $allCourses = Course::orderBy('nama_matkul')->get();
        $enrolledCourseIds = $student->courses()->pluck('courses.id')->toArray();

        // Mengubah data courses menjadi array of objects untuk dikirim ke JavaScript
        $coursesData = $allCourses->map(function ($course) use ($enrolledCourseIds) {
            return [
                'id' => $course->id,
                'nama_matkul' => $course->nama_matkul,
                'kode_matkul' => $course->kode_matkul,
                'sks' => $course->sks,
                'is_enrolled' => in_array($course->id, $enrolledCourseIds),
            ];
        });

        // Mengirim data ke view
        return view('student.courses.index', [
            'coursesData' => $coursesData,
        ]);
    }

    /**
     * Memproses pendaftaran mata kuliah.
     */
    public function enroll(Request $request)
    {
        $request->validate([
            'course_ids' => 'sometimes|array',
            'course_ids.*' => 'exists:courses,id',
        ]);

        $student = Auth::user();
        
        // Menggunakan sync() untuk menyinkronkan mata kuliah yang dipilih
        $student->courses()->sync($request->input('course_ids', []));

        return response()->json([
            'message' => 'Pilihan mata kuliah Anda berhasil disimpan!'
        ]);
    }
}