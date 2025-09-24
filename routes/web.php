<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;

// --- RUTE PUBLIK & OTENTIKASI ---
Route::get('/', fn() => view('welcome'));
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ===================================================================
// RUTE YANG TERPROTEKSI (WAJIB LOGIN)
// ===================================================================
Route::middleware(['auth'])->group(function () {
    
    // --- GRUP KHUSUS ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        
        // === BAGIAN YANG DIPERBAIKI ===
        Route::get('/dashboard', function () {
            // Arahkan ke view yang benar di dalam folder admin/students
            return view('admin.students.dashboard'); 
        })->name('dashboard');
        // =============================

        Route::resource('courses', AdminCourseController::class);
        Route::resource('students', AdminStudentController::class);
    });

    // --- GRUP KHUSUS MAHASISWA (STUDENT) ---
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('dashboard');
        
        Route::get('courses', [StudentCourseController::class, 'index'])->name('courses.index');
        Route::post('courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
    });
});