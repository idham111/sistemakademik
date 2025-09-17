<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Controller yang digunakan
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// RUTE PUBLIK (Bisa diakses tanpa login)
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ===================================================================
// RUTE YANG WAJIB LOGIN (TERPROTEKSI)
// ===================================================================
Route::middleware(['auth'])->group(function () {
    
    // Rute Dashboard Dinamis (cek role setelah login)
    Route::get('/dashboard', function () {
        if (Auth::user()->role == 'admin') {
            return view('admin.dashboard');
        } elseif (Auth::user()->role == 'student') {
            return view('student.dashboard');
        }
        return redirect('/');
    })->name('dashboard');

    // --- GRUP KHUSUS ADMIN ---
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('courses', AdminCourseController::class);
        Route::resource('students', AdminStudentController::class);
    });

    // --- GRUP KHUSUS MAHASISWA (FITUR BARU) ---
    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        // Rute untuk menampilkan semua mata kuliah yang bisa diambil
        Route::get('courses', [StudentCourseController::class, 'index'])->name('courses.index');
        
        // Rute untuk proses mendaftar (enroll) ke sebuah mata kuliah
        Route::post('courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
    });
});