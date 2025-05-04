# TP8DPBO2025C1

Saya Yazid Madarizel dengan NIM 2305328 mengerjakan soal TP 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Sistem Manajemen Mahasiswa dan Mata Kuliah

![image](https://github.com/user-attachments/assets/88cdd5dd-874d-4797-ab96-61dcc80b6f40)

## Tabel-Tabel Utama

### Tabel Students (Mahasiswa)
- Menyimpan data lengkap mahasiswa (id, nama, nim, telepon, email, tanggal bergabung)
- Berfungsi sebagai entitas utama untuk pengelolaan data akademik mahasiswa
- Terhubung ke enrollments untuk melacak partisipasi dalam mata kuliah
- Primary key `id` yang auto-increment menjadi pengenal unik

### Tabel Courses (Mata Kuliah)
- Berisi informasi mata kuliah (id, kode, nama, SKS, deskripsi)
- Menyimpan konten pendidikan yang dikelola dalam sistem
- Terhubung ke enrollments untuk melacak mahasiswa yang mengambil setiap mata kuliah
- Primary key `id` dengan informasi tambahan `course_code` sebagai identifikasi mata kuliah

### Tabel Enrollments (Pendaftaran) - Tabel Penghubung
- Menciptakan hubungan many-to-many antara mahasiswa dan mata kuliah
- Melacak mahasiswa mana yang terdaftar di mata kuliah mana
- Mencakup tanggal pendaftaran dan informasi nilai (grade)
- Menggunakan foreign key ke tabel students dan courses dengan mekanisme cascade delete

## Arsitektur Sistem

### Pola MVC (Model-View-Controller)
- **Model**: Menangani logika bisnis dan interaksi database untuk students, courses, dan enrollments
- **View**: Menghasilkan tampilan UI dengan template engine sederhana dan output buffering
- **Controller**: Mengontrol alur aplikasi dan menghubungkan Model dan View

### Front Controller Pattern
- File index.php menerima semua request dan mengarahkan ke controller yang tepat
- Memproses parameter URL untuk menentukan controller dan action yang diperlukan

## Fitur Utama

### Manajemen Data
- CRUD lengkap untuk mahasiswa (lihat, tambah, edit, hapus)
- CRUD lengkap untuk mata kuliah (lihat, tambah, edit, hapus)
- CRUD lengkap untuk pendaftaran mata kuliah (lihat, tambah, edit, hapus)

### Keamanan & Validasi
- Menggunakan prepared statements untuk mencegah SQL Injection
- Validasi input untuk mencegah duplikasi data
- Pencegahan duplikasi pendaftaran (satu mahasiswa tidak bisa mendaftar mata kuliah yang sama dua kali)

## Cara Penggunaan

Saat pengguna mengakses sistem, mereka dapat:
- Mengelola data mahasiswa melalui interface yang intuitif
- Mengelola mata kuliah dengan informasi lengkap
- Membuat pendaftaran yang menghubungkan mahasiswa dengan mata kuliah
- Melakukan navigasi melalui URL dengan format sederhana (index.php?controller=X&action=Y)

Sistem ini memberikan solusi manajemen akademik komprehensif dengan implementasi yang mengikuti prinsip desain software modern dan praktik keamanan yang baik.

## Dokumentasi



https://github.com/user-attachments/assets/ed4a9220-709b-44e7-a49a-94b8bb1d0e38



