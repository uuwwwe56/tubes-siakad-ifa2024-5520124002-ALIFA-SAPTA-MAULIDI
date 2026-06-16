<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TugasSubmission extends Model
{
    use HasFactory;
    protected $table = 'tugas_submissions';
    protected $fillable = [
        'tugas_id',
        'npm',
        'file_jawaban',
        'catatan_mahasiswa',
        'nilai',
        'catatan_dosen',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'npm', 'npm');
    }
}
