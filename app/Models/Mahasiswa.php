<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'npm';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['npm', 'nidn', 'nama', 'angkatan', 'semester_aktif', 'kelas', 'user_id'];

    // Mahasiswa memiliki satu Dosen Wali
    public function dosenWali()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nidn', 'nidn');
    }
    // Hubungan ke akun User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi Many-to-Many ke Mata Kuliah via KRS (Poin b.2.e)
    public function krsMatakuliah()
    {
        return $this->belongsToMany(Matakuliah::class, 'krs', 'npm', 'kode_matakuliah');
    }
    public function krs()
    {
        return $this->hasMany(Krs::class, 'npm', 'npm');
    }
    public function tugasSubmissions()
    {
        return $this->hasMany(TugasSubmission::class, 'npm', 'npm');
    }

    public function absensis()
    {
        return $this->hasMany(Absensi::class, 'npm', 'npm');
    }
}