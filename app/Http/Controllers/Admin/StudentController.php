<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua user dengan role 'student' dan menggunakan pagination
        $students = User::where('role', 'student')->paginate(10); 
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Membuat user baru dengan role 'student'
        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        return redirect()->route('admin.students.index')
                         ->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $student)
    {
        // Menampilkan halaman detail untuk satu mahasiswa
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $student)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $student->id,
            'password' => 'nullable|string|min:8',
        ]);

        // Update username
        $student->username = $request->username;

        // Jika ada password baru, update passwordnya
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect()->route('admin.students.index')
                         ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $student)
    {
        $student->delete();

        return redirect()->route('admin.students.index')
                         ->with('success', 'Mahasiswa berhasil dihapus.');
    }
}