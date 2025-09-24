<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('admin.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_matkul' => 'required|unique:courses,kode_matkul|max:10',
            'nama_matkul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        Course::create($request->all());
        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil ditambahkan.');
    }
    
    // app/Http/Controllers/Admin/CourseController.php

// ... (method index, create, store biarkan saja)

public function show(Course $course)
{
    return view('admin.courses.show', compact('course'));
}

// ... (method edit, update, destroy biarkan saja)

    public function edit(Course $course)
    {
        return view('admin.courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'kode_matkul' => 'required|max:10|unique:courses,kode_matkul,' . $course->id,
            'nama_matkul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);
        $course->update($request->all());
        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil diperbarui.');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        return redirect()->route('admin.courses.index')->with('success', 'Mata kuliah berhasil dihapus.');
    }
}