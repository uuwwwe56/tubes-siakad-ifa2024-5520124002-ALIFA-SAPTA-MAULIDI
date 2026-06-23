🎓 SIAKAD SCHOLLINK
Sistem Informasi Akademik Berbasis Web
📖 Deskripsi Aplikasi
SIAKAD SCHOLLINK merupakan aplikasi Sistem Informasi Akademik berbasis web yang dibangun menggunakan Laravel 13,PHP 8.3,dan MySQL. Aplikasi ini dirancang untuk membantu pengelolaan aktivitas akademik di lingkungan perguruan tinggi secara terintegrasi, mulai dari pengelolaan data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, hingga proses pengisian dan persetujuan Kartu Rencana Studi (KRS).

Sistem menerapkan konsep "Role-Based Access Control (RBAC)" sehingga setiap pengguna hanya dapat mengakses fitur sesuai dengan peran dan hak akses yang dimiliki. Selain itu, seluruh data akademik saling terhubung melalui relasi database menggunakan "Eloquent ORM Larave", sehingga proses pengelolaan data menjadi lebih efisien, aman, dan terstruktur.

## ✨ Fitur Utama  
- Login multi role  
- Manajemen dosen, mahasiswa, mata kuliah, jadwal  
- Pengisian & persetujuan KRS  
- Classroom digital (materi, tugas, absensi)  
- Penilaian tugas  
- Export/import Excel  
- Export PDF (KRS & laporan)  
- Manajemen profil  

👥 Hak Akses Pengguna
Sistem memiliki 3 jenis pengguna utama:
1. Admin
2. Dosen
3. Mahasiswa
Setiap pengguna memiliki hak akses yang berbeda sesuai dengan kebutuhan akademik masing-masing.

---

## 👥 Role Pengguna  

### 👨‍💼 Admin  
- Dashboard ringkasan data  
- Kelola dosen, mahasiswa, mata kuliah, jadwal  
- Export/import Excel & PDF  
- Monitoring data akademik  

---

### 👨‍🏫 Dosen  
- Dashboard aktivitas mengajar  
- Persetujuan KRS  
- Classroom (materi, tugas, absensi)  
- Penilaian tugas  
- Kelola pertemuan  

---

### 🎓 Mahasiswa  
- Dashboard akademik & KRS  
- Pengisian & pengajuan KRS  
- Classroom (materi, absensi, tugas)  
- Detail mata kuliah & nilai  
- Cetak KRS (PDF)  

---

## 👤 Profil Pengguna  
- Update profil  
- Ubah password & foto  
- Keamanan akun  

---

## 🔒 Keamanan  
- Authentication Laravel  
- Middleware RBAC  
- CSRF Protection  
- Hash password (Bcrypt)  
- Validasi input & upload file  
- Session management  

---

## 🛠️ Teknologi  
- Backend: Laravel 13, PHP 8.3  
- Frontend: Blade, Tailwind CSS, JavaScript  
- Database: MySQL  
- Library: Eloquent ORM, DomPDF, Laravel Storage  

---

## 🔐 Test Login  

**Admin**  
- admin / admin123  

**Dosen**  
- 041001001 / dosen123  

**Mahasiswa**  
- 24534016 / mahasiswa123  
