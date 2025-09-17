<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::where('role', 'student')->latest()->paginate(10);
        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:5',
        ]);

        User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'student',
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    public function edit(User $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:users,username,' . $student->id,
            'password' => 'nullable|string|min:5',
        ]);

        $data = $request->only('username');
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $student->update($data);
        return redirect()->route('admin.students.index')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    public function destroy(User $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}