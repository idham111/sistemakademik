<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            // Kolom-kolom Anda yang lain (contoh)
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role');

            // PASTIKAN BARIS INI ADA
            $table->timestamps(); 
        });
    }

    // ... (sisa kode)
};