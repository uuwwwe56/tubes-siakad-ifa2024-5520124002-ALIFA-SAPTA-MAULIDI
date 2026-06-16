<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Krs extends Model
{
    use HasFactory;

    // Menentukan nama tabel secara eksplisit
    protected $table = 'krs';

    // Mass assignment
    protected $fillable = [
        'npm',
        'kode_matakuliah',
        'status'
    ];

    // Relasi Kebalikan (BelongsTo) ke model Matakuliah
    public function matakuliah()
    {
        return $this->belongsTo(Matakuliah::class, 'kode_matakuliah', 'kode_matakuliah');
    }

    // Relasi Kebalikan (BelongsTo) ke model Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }
    
}
