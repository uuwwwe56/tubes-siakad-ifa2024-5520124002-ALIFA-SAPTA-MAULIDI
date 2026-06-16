<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pertemuan extends Model
{
    use HasFactory;
    protected $table = 'pertemuans';
    protected $fillable = [
        'jadwal_id',
        'pertemuan_ke',
        'judul_topik',
        'deskripsi',
    ];

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function materis()
    {
        return $this->hasMany(Materi::class);
    }

    public function tugases()
    {
        return $this->hasMany(Tugas::class);
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }
}
