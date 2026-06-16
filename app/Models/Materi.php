<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materis';
    protected $fillable = [
        'pertemuan_id',
        'judul_materi',
        'konten_teks',
        'file_path',
    ];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }
}
