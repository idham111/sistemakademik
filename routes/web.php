<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Student\CourseController as StudentCourseController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        // Rute dashboard khusus untuk admin.
        Route::get('/dashboard', function () {
            // Anda bisa mengganti ini untuk menampilkan view dashboard admin yang lebih spesifik.
            return view('admin.dashboard'); 
        })->name('dashboard');

        // Menggunakan Route::resource untuk CRUD (Create, Read, Update, Delete)
        Route::resource('courses', AdminCourseController::class);
        Route::resource('students', AdminStudentController::class);
    });

    Route::middleware('role:student')->prefix('student')->name('student.')->group(function () {
        // Rute dashboard khusus untuk mahasiswa.
        Route::get('/dashboard', function () {
            return view('student.dashboard');
        })->name('dashboard');
        
        // Rute untuk menampilkan semua mata kuliah yang bisa diambil
        Route::get('courses', [StudentCourseController::class, 'index'])->name('courses.index');
        
        // Rute untuk proses mendaftar (enroll) ke sebuah mata kuliah
        Route::post('courses/{course}/enroll', [StudentCourseController::class, 'enroll'])->name('courses.enroll');
    });
});