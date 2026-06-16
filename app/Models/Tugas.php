<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugases';

    protected $fillable = [
        'pertemuan_id',
        'judul_tugas',
        'instruksi',
        'file_instruksi',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function submissions()
    {
        return $this->hasMany(TugasSubmission::class);
    }
}
