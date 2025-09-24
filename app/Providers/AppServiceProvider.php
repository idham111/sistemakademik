<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Mengikat data ke layout 'layouts.admin' setiap kali dipanggil
        View::composer('layouts.admin', function ($view) {
            $students = User::where('role', 'student')->get();
            $view->with('all_students', $students);
        });
    }
}