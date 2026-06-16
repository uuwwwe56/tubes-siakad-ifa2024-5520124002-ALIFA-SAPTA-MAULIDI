<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensis';
    protected $fillable = [
        'pertemuan_id',
        'npm',
        'status',
    ];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }
}
