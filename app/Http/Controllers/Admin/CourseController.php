<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(5);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        // PERUBAHAN: Menambahkan validasi untuk 'sks'
        $request->validate([
            'kode_matkul' => 'required|unique:courses,kode_matkul|max:10',
            'nama_matkul' => 'required|string|max:255',
            'sks'         => 'required|integer|min:1', // Pastikan SKS adalah angka
            'deskripsi'   => 'nullable|string',
        ]);

        Course::create($request->all());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Mata kuliah berhasil ditambahkan.');
    }

    public function show(Course $course)
    {
        return view('admin.courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        // PERUBAHAN: Menambahkan validasi untuk 'sks' saat update
        $request->validate([
            'kode_matkul' => 'required|max:10|unique:courses,kode_matkul,' . $course->id,
            'nama_matkul' => 'required|string|max:255',
            'sks'         => 'required|integer|min:1',
            'deskripsi'   => 'nullable|string',
        ]);

        $course->update($request->all());

        return redirect()->route('admin.courses.index')
            ->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('admin.courses.index')
            ->with('success', 'Mata kuliah berhasil dihapus.');
    }
}