<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    
    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'sks', 
        'deskripsi',
    ];

    public function students()
    {
        return $this->belongsToMany(User::class);
    }
}