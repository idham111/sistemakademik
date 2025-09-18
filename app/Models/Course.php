<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'kode_matkul',
        'nama_matkul',
        'deskripsi',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}