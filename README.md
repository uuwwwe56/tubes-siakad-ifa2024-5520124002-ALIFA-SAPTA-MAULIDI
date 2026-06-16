🎓 SIAKAD SCHOLLINK
Sistem Informasi Akademik Berbasis Web
📖 Deskripsi Aplikasi
SIAKAD SCHOLLINK merupakan aplikasi Sistem Informasi Akademik berbasis web yang dibangun menggunakan Laravel 13,PHP 8.3,dan MySQL. Aplikasi ini dirancang untuk membantu pengelolaan aktivitas akademik di lingkungan perguruan tinggi secara terintegrasi, mulai dari pengelolaan data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, hingga proses pengisian dan persetujuan Kartu Rencana Studi (KRS).

Sistem menerapkan konsep "Role-Based Access Control (RBAC)" sehingga setiap pengguna hanya dapat mengakses fitur sesuai dengan peran dan hak akses yang dimiliki. Selain itu, seluruh data akademik saling terhubung melalui relasi database menggunakan "Eloquent ORM Larave", sehingga proses pengelolaan data menjadi lebih efisien, aman, dan terstruktur.

✨ Fitur Utama Sistem
* Autentikasi Login Multi Role
* Manajemen Data Dosen
* Manajemen Data Mahasiswa
* Manajemen Mata Kuliah
* Manajemen Jadwal Perkuliahan
* Pengisian KRS Mahasiswa
* Persetujuan KRS oleh Dosen Wali
* Classroom Digital
* Manajemen Materi Perkuliahan
* Manajemen Tugas dan Pengumpulan Tugas
* Sistem Absensi Online
* Penilaian Tugas Mahasiswa
* Cetak KRS dalam Format PDF
* Manajemen Profil dan Keamanan Akun
* Export Data ke Excel
* Import Data dari Excel
* Export Laporan PDF

👥 Hak Akses Pengguna
Sistem memiliki 3 jenis pengguna utama:
1. Admin
2. Dosen
3. Mahasiswa
Setiap pengguna memiliki hak akses yang berbeda sesuai dengan kebutuhan akademik masing-masing.

👨‍💼 Role Admin
Admin bertanggung jawab dalam mengelola seluruh data akademik yang terdapat di dalam sistem.

- Dashboard Admin
Halaman utama yang menampilkan informasi dan ringkasan data akademik secara keseluruhan.
Fungsi:
* Melihat jumlah dosen.
* Melihat jumlah mahasiswa.
* Melihat jumlah mata kuliah.
* Melihat jumlah jadwal perkuliahan.
* Monitoring aktivitas akademik secara umum.

- Kelola Data Dosen
Halaman untuk mengelola seluruh data dosen yang terdaftar pada sistem.
Fitur:
* Menambah data dosen.
* Melihat daftar dosen.
* Mengubah data dosen.
* Menghapus data dosen.
* Membuat akun login dosen.

- Kelola Data Mahasiswa
Halaman untuk mengelola seluruh data mahasiswa.
Fitur:
* Menambah data mahasiswa.
* Mengubah data mahasiswa.
* Menghapus data mahasiswa.
* Melihat daftar mahasiswa.
* Reset password mahasiswa secara otomatis.

- Kelola Mata Kuliah
Halaman untuk mengelola informasi mata kuliah yang tersedia.
Fitur:
* Menambah mata kuliah.
* Mengubah data mata kuliah.
* Menghapus mata kuliah.
* Melihat daftar mata kuliah.

- Kelola Jadwal Perkuliahan
Halaman untuk mengatur jadwal perkuliahan yang akan digunakan dalam proses belajar mengajar.
Fitur:
* Menambah jadwal.
* Mengubah jadwal.
* Menghapus jadwal.
* Menentukan dosen pengampu.
* Menentukan kelas perkuliahan.
* Menentukan hari dan jam perkuliahan.
* Export, Import, dan Cetak Data

Untuk mempermudah pengelolaan data akademik, Admin dilengkapi dengan fitur Export Excel, Import Excel, dan Export PDF pada setiap modul utama seperti Data Dosen, Data Mahasiswa, Mata Kuliah, dan Jadwal Perkuliahan.

Fitur:

* Export data ke format Excel (.xlsx).
* Import data dari file Excel secara massal.
* Export laporan ke format PDF yang siap cetak.
* Download template Excel untuk memudahkan proses import data.
* Validasi otomatis saat import untuk mencegah data kosong, tidak valid, atau duplikat.
* Menampilkan informasi jumlah data yang berhasil dan gagal diproses saat import.
* Mendukung pengelolaan data dalam jumlah besar dengan lebih cepat dan efisien.

Modul yang mendukung fitur ini:

* Data Dosen
* Data Mahasiswa
* Mata Kuliah
* Jadwal Perkuliahan

👨‍🏫 Role Dosen
Dosen berperan sebagai pengajar sekaligus dosen wali yang bertugas melakukan pembimbingan akademik mahasiswa.

- Dashboard Dosen
Halaman utama dosen setelah berhasil login.
Fungsi:
* Melihat ringkasan aktivitas mengajar.
* Melihat jumlah kelas yang diampu.
* Melihat jumlah mahasiswa bimbingan.
* Melihat jumlah pengajuan KRS yang menunggu verifikasi.

- Persetujuan KRS
Halaman yang digunakan dosen wali untuk memverifikasi pengajuan KRS mahasiswa.
Fitur:
* Melihat daftar mahasiswa bimbingan.
* Melihat mata kuliah yang dipilih mahasiswa.
* Menyetujui KRS.
* Menolak KRS.

- Classroom Dosen
Classroom merupakan pusat aktivitas pembelajaran yang digunakan dosen untuk mengelola perkuliahan.
 Fitur:
* Melihat daftar kelas yang diampu.
* Membuat pertemuan kuliah.
* Mengunggah materi pembelajaran.
* Membuat tugas.
* Membuka dan menutup absensi.
* Melihat pengumpulan tugas mahasiswa.
* Memberikan nilai tugas.

- Kelola Pertemuan
Digunakan untuk membuat sesi pembelajaran pada setiap pertemuan kuliah.
Fitur:
* Menambahkan pertemuan baru.
* Menentukan topik pembelajaran.
* Mengaktifkan absensi mahasiswa.
* Menonaktifkan absensi mahasiswa.

- Kelola Materi
Digunakan untuk membagikan bahan pembelajaran kepada mahasiswa.
Fitur:
* Upload materi kuliah.
* Menambahkan deskripsi materi.
* Membagikan file pembelajaran.

- Kelola Tugas
Digunakan untuk memberikan tugas kepada mahasiswa.
 Fitur:
* Membuat tugas baru.
* Menentukan deadline pengumpulan.
* Menambahkan instruksi tugas.
* Memantau pengumpulan tugas.

- Penilaian Tugas
Digunakan untuk memberikan nilai terhadap tugas yang telah dikumpulkan mahasiswa.
 Fitur:
* Melihat daftar submission.
* Memberikan nilai.
* Menambahkan catatan atau komentar.
* Menyimpan hasil penilaian.

🎓 Role Mahasiswa
Mahasiswa berperan sebagai pengguna utama yang melakukan aktivitas akademik dan pembelajaran.

- Dashboard Mahasiswa
Halaman utama mahasiswa setelah login.
Fungsi:
* Melihat informasi akademik.
* Melihat status KRS.
* Melihat jumlah SKS yang diambil.
* Melihat aktivitas pembelajaran yang sedang berlangsung.

- Pengisian KRS
Halaman yang digunakan mahasiswa untuk menyusun rencana studi pada semester aktif.
Fitur:
* Mengambil mata kuliah.
* Membatalkan mata kuliah yang dipilih.
* Melihat total SKS yang diambil.
* Mengajukan KRS kepada dosen wali.

- Cetak KRS
Digunakan untuk menghasilkan dokumen KRS dalam format PDF.
Informasi yang ditampilkan:
* Data Mahasiswa
* Informasi Akademik
* Daftar Mata Kuliah
* Total SKS
* Status Persetujuan KRS
* Tanda Tangan Mahasiswa
* Tanda Tangan Dosen Wali

- Classroom Mahasiswa
Halaman pembelajaran digital yang digunakan mahasiswa untuk mengikuti kegiatan perkuliahan.
Fitur:
* Melihat daftar kelas yang diikuti.
* Mengakses materi kuliah.
* Mengisi absensi online.
* Melihat tugas yang diberikan dosen.
* Mengunggah tugas.
* Mengubah tugas sebelum batas waktu berakhir.
* Menghapus tugas yang telah dikirim.

- Detail Mata Kuliah
Menampilkan seluruh aktivitas pembelajaran dalam suatu mata kuliah.
 Fitur:
* Melihat daftar pertemuan.
* Mengakses materi pembelajaran.
* Melakukan absensi.
* Mengumpulkan tugas.
* Melihat nilai tugas.

 👤 Manajemen Profil
Halaman profil dapat diakses oleh seluruh pengguna sistem.
 Fitur:
* Melihat informasi akun.
* Mengubah nama profil.
* Mengubah foto profil.
* Mengubah password akun.
* Menjaga keamanan akun secara mandiri.

🔒 Keamanan Sistem
Untuk menjaga keamanan data akademik, sistem dilengkapi dengan beberapa mekanisme keamanan:
* Laravel Authentication
* Middleware Multi Role
* CSRF Protection
* Password Hashing (Bcrypt)
* Validasi Form Input
* Session Management
* Upload File Validation
* Authorization berbasis Role

 🛠️ Teknologi yang Digunakan

Backend
* PHP 8.3
* Laravel 13

 Frontend
* Blade Template
* Tailwind CSS
* JavaScript

Database
* MySQL

Library Pendukung
* Laravel Eloquent ORM
* Laravel Storage
* DomPDF

==========================
percobaan login 

role admin 
username : admin
password : admin123

role dosen 
username : 041001001
password : dosen123

role mahasiswa
username : 24534016
password : mahasiswa123

