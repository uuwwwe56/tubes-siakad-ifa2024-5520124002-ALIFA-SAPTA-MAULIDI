# 🎓 SIAKAD SCHOOLINK

**Sistem Informasi Akademik Berbasis Web**

🌐 **Demo Aplikasi:** https://alif.ifalgorithm24.web.id/

---

## 📖 Deskripsi

**SIAKAD SCHOOLINK** merupakan aplikasi Sistem Informasi Akademik berbasis web yang dibangun menggunakan **Laravel 13**, **PHP 8.3**, dan **MySQL**. Aplikasi ini dirancang untuk membantu pengelolaan aktivitas akademik di lingkungan perguruan tinggi secara terintegrasi, mulai dari pengelolaan data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, hingga proses pengisian dan persetujuan **Kartu Rencana Studi (KRS)**.

Sistem menerapkan konsep **Role-Based Access Control (RBAC)** sehingga setiap pengguna hanya dapat mengakses fitur sesuai dengan peran dan hak akses yang dimiliki. Selain itu, seluruh data akademik saling terhubung melalui relasi database menggunakan **Eloquent ORM Laravel**, sehingga proses pengelolaan data menjadi lebih efisien, aman, dan terstruktur.

---

## 🚀 Demo

**Website:** https://alif.ifalgorithm24.web.id/

---

## ✨ Fitur Utama

* 🔐 Login Multi Role (Admin, Dosen, Mahasiswa)
* 👨‍💼 Manajemen Data Dosen
* 🎓 Manajemen Data Mahasiswa
* 📚 Manajemen Mata Kuliah
* 📅 Manajemen Jadwal Perkuliahan
* 📝 Pengisian dan Persetujuan KRS
* 🏫 Classroom Digital

  * Materi Perkuliahan
  * Tugas Mahasiswa
  * Absensi Perkuliahan
* 📊 Penilaian Tugas Mahasiswa
* 📥 Import Data Excel
* 📤 Export Data Excel
* 📄 Export PDF (KRS dan Laporan)
* 👤 Manajemen Profil Pengguna

---

## 👥 Hak Akses Pengguna

Sistem memiliki 3 jenis pengguna utama:

1. **Admin**
2. **Dosen**
3. **Mahasiswa**

Setiap pengguna memiliki hak akses yang berbeda sesuai dengan kebutuhan akademik masing-masing.

---

## 👨‍💼 Role Admin

### Fitur yang tersedia:

* Dashboard Ringkasan Data Akademik
* Kelola Data Dosen
* Kelola Data Mahasiswa
* Kelola Mata Kuliah
* Kelola Jadwal Perkuliahan
* Import Data Excel
* Export Excel
* Export PDF
* Monitoring Data Akademik

---

## 👨‍🏫 Role Dosen

### Fitur yang tersedia:

* Dashboard Aktivitas Mengajar
* Persetujuan KRS Mahasiswa
* Classroom Digital
* Upload Materi Perkuliahan
* Kelola Tugas Mahasiswa
* Kelola Absensi Perkuliahan
* Penilaian Tugas
* Kelola Pertemuan Perkuliahan

---

## 🎓 Role Mahasiswa

### Fitur yang tersedia:

* Dashboard Akademik
* Pengisian KRS
* Pengajuan KRS
* Melihat Status Persetujuan KRS
* Classroom Digital
* Download Materi
* Upload Tugas
* Absensi Perkuliahan
* Melihat Nilai Mata Kuliah
* Cetak KRS (PDF)

---

## 👤 Manajemen Profil

Setiap pengguna dapat:

* Mengubah Data Profil
* Mengubah Password
* Mengubah Foto Profil
* Mengelola Keamanan Akun

---

## 🔒 Keamanan Sistem

* Laravel Authentication
* Middleware Role-Based Access Control (RBAC)
* CSRF Protection
* Password Hashing (Bcrypt)
* Validasi Input Form
* Validasi Upload File
* Session Management
* Route Protection

---

## 🛠️ Teknologi yang Digunakan

### Backend

* Laravel 13
* PHP 8.3

### Frontend

* Blade Template Engine
* Tailwind CSS
* JavaScript

### Database

* MySQL

### Library & Package

* Eloquent ORM
* DomPDF
* Laravel Storage
* Laravel Validation
* Laravel Middleware

---

## 🗄️ Struktur Modul Sistem

### Modul Admin

* Data Dosen
* Data Mahasiswa
* Data Mata Kuliah
* Data Jadwal
* Laporan Akademik

### Modul Dosen

* Persetujuan KRS
* Classroom
* Materi
* Tugas
* Absensi
* Penilaian

### Modul Mahasiswa

* KRS
* Classroom
* Materi
* Tugas
* Absensi
* Nilai Akademik

---

## 🔐 Akun Demo

### Admin

**Username:** `admin`
**Password:** `admin123`

### Dosen

**Username:** `041001001`
**Password:** `dosen123`

### Mahasiswa

**Username:** `24534016`
**Password:** `mahasiswa123`

---

## 📌 Tujuan Pengembangan

SIAKAD SCHOOLINK dikembangkan sebagai implementasi Sistem Informasi Akademik modern yang mampu membantu proses administrasi dan pembelajaran secara digital, terintegrasi, serta mudah digunakan oleh Admin, Dosen, dan Mahasiswa dalam satu platform.

---

## 👨‍💻 Developer

**Alif Maulana**
Sistem Informasi Akademik (SIAKAD SCHOOLINK)

🌐 Demo: https://alif.ifalgorithm24.web.id/
