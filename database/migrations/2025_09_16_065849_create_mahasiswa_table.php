<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->string('username')->unique();
            $table->string('password');
            $table->enum('role', ['admin','student']);
            $table->id(); // primary key
            $table->string('nim')->unique();
            $table->string('nama');
            $table->integer('umur')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};
