# TP8DPBO2025C1

Saya Yazid Madarizel dengan NIM 2305328 mengerjakan soal TP 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Sistem Manajemen Mahasiswa dan Mata Kuliah

![image](https://github.com/user-attachments/assets/e2721eb2-56c3-478a-a0e4-84825076edb3)

## Overview

Program ini adalah sistem manajemen mahasiswa, mata kuliah, dan pendaftaran mata kuliah yang mengimplementasikan arsitektur **Model-View-Controller (MVC)** dengan tambahan pola desain **Front Controller** dan **Template Engine** sederhana. Sistem ini memungkinkan pengelolaan data mahasiswa, mata kuliah, dan proses pendaftaran mata kuliah.

## Struktur Database

Program menggunakan tiga tabel utama:
- **students**: Menyimpan data mahasiswa (id, nama, NIM, telepon, email, tanggal bergabung)
- **courses**: Menyimpan data mata kuliah (id, kode, nama, SKS, deskripsi)
- **enrollments**: Menyimpan data pendaftaran mata kuliah oleh mahasiswa (id, student_id, course_id, tanggal pendaftaran, nilai)

## Arsitektur Program

### Model-View-Controller (MVC)
- **Model**: Bertanggung jawab untuk logika bisnis dan interaksi database
- **View**: Menangani tampilan/UI yang dilihat pengguna
- **Controller**: Mengontrol alur aplikasi, menangani request, dan menghubungkan Model dan View

### Front Controller Pattern
File `index.php` bertindak sebagai Front Controller yang menerima semua request. Ini memproses parameter URL (`controller`, `action`, dan `id`) untuk menentukan controller dan metode yang akan dipanggil.

## Struktur Proyek

### Assets
Berisi file CSS dan JS dari framework Bootstrap dan jQuery untuk styling dan interaktivitas halaman.

### Config
- `connection.php`: Berisi kelas Database untuk koneksi ke MySQL

### Models
- `Student.php`: Model untuk operasi CRUD pada tabel students
- `Course.php`: Model untuk operasi CRUD pada tabel courses
- `Enrollment.php`: Model untuk operasi CRUD pada tabel enrollments

### Controllers
- `StudentController.php`: Mengelola operasi terkait mahasiswa
- `CourseController.php`: Mengelola operasi terkait mata kuliah
- `EnrollmentController.php`: Mengelola operasi terkait pendaftaran mata kuliah

### Views
- `student.view.php`, `course.view.php`, `enrollment.view.php`: Kelas view untuk rendering tampilan
- `template.class.php`: Implementasi simple template engine
- Folder `layouts`: Berisi header.php dan footer.php untuk layout konsisten

### Templates
Folder berisi file HTML template untuk setiap entitas:
- `student/`: create.html, edit.html, index.html
- `course/`: create.html, edit.html, index.html
- `enrollment/`: create.html, edit.html, index.html

## Fitur Program

1. **Manajemen Student**
   - Lihat daftar student
   - Tambah student baru
   - Edit data student
   - Hapus student

2. **Manajemen Course**
   - Lihat daftar course
   - Tambah course baru
   - Edit course
   - Hapus course

3. **Manajemen Enrollment**
   - Lihat daftar enrollment
   - Tambah enrollment baru (menghubungkan student dengan course)
   - Edit enrollment (termasuk pemberian nilai)
   - Hapus enrollment

## Alur Program

### Entry Point (index.php)
Semua request masuk melalui `index.php` yang bertindak sebagai Front Controller dengan alur:

1. **Menginisialisasi koneksi database**
2. **Menentukan controller dan action** berdasarkan parameter URL
3. **Memuat controller yang tepat**
4. **Memanggil method yang sesuai** pada controller

### Contoh URL:
- `index.php?controller=student&action=index` (menampilkan daftar mahasiswa)
- `index.php?controller=course&action=create` (form untuk menambah mata kuliah baru)
- `index.php?controller=enrollment&action=edit&id=5` (edit data pendaftaran dengan ID 5)

## Implementasi Model

### Class `Student` (models/Student.php)
- **Properties**: id, name, nim, phone, email, join_date
- **Methods**:
  - `getAll()`: Mengambil semua data mahasiswa
  - `getById($id)`: Mengambil data mahasiswa berdasarkan ID
  - `create()`: Menambah data mahasiswa baru
  - `update()`: Memperbarui data mahasiswa
  - `delete()`: Menghapus data mahasiswa

### Class `Course` (models/Course.php)
- **Properties**: id, course_code, course_name, credit_hours, description
- **Methods**: 
  - `getAll()`: Mengambil semua data mata kuliah
  - `getById($id)`: Mengambil data mata kuliah berdasarkan ID
  - `create()`: Menambah data mata kuliah baru
  - `update()`: Memperbarui data mata kuliah
  - `delete()`: Menghapus data mata kuliah

### Class `Enrollment` (models/Enrollment.php)
- **Properties**:
  - **Dasar**: id, student_id, course_id, enrollment_date, grade
  - **Tambahan**: student_name, student_nim, course_name, course_code (untuk tampilan)
- **Methods**:
  - `getAllWithDetails()`: Mengambil semua data pendaftaran dengan JOIN tabel students dan courses
  - `getById($id)`: Mengambil data pendaftaran berdasarkan ID dengan JOIN tabel terkait
  - `create()`: Menambah data pendaftaran baru
  - `update()`: Memperbarui data pendaftaran
  - `delete()`: Menghapus data pendaftaran
  - `enrollmentExists($student_id, $course_id)`: Memeriksa apakah mahasiswa sudah terdaftar di mata kuliah tertentu

## Implementasi Controller

### `StudentController`
- **Methods**:
  - `index()`: Menampilkan daftar mahasiswa
  - `show($id)`: Menampilkan detail mahasiswa
  - `create()`: Menampilkan form dan memproses penambahan mahasiswa baru
  - `edit($id)`: Menampilkan form dan memproses edit data mahasiswa
  - `delete($id)`: Memproses penghapusan data mahasiswa

### `CourseController`
- **Methods**:
  - `index()`: Menampilkan daftar mata kuliah
  - `show($id)`: Menampilkan detail mata kuliah
  - `create()`: Menampilkan form dan memproses penambahan mata kuliah baru
  - `edit($id)`: Menampilkan form dan memproses edit data mata kuliah
  - `delete($id)`: Memproses penghapusan data mata kuliah

### `EnrollmentController`
- **Dependencies**: `Enrollment`, `Student`, `Course`
- **Methods**:
  - `index()`: Menampilkan daftar pendaftaran dengan detail mahasiswa dan mata kuliah
  - `create()`: Menampilkan form dan memproses penambahan pendaftaran baru
  - `edit($id)`: Menampilkan form dan memproses edit data pendaftaran
  - `delete($id)`: Memproses penghapusan data pendaftaran

## Implementasi View

Program mengimplementasikan dua pendekatan berbeda untuk view:

### 1. Template Engine (untuk EnrollmentView)
- **Class `Template`** (`views/template.class.php`): Template engine sederhana dengan kemampuan:
  - Memuat file template HTML
  - Mengganti placeholder dengan data sebenarnya
  - Menghapus placeholder yang tidak digunakan
  - Menampilkan konten template final

### 2. Output Buffering (untuk StudentView dan CourseView)
Pendekatan ini menggunakan fungsi PHP native untuk output buffering (ob_start, ob_get_clean) dan include langsung file tampilan.

## Siklus Request-Response

### Contoh Alur untuk Menampilkan Daftar Mahasiswa:
1. User mengakses URL: `index.php?controller=student&action=index`
2. `index.php` memuat `StudentController` dan memanggil method `index()`
3. `StudentController->index()`:
   - Membuat instance `Student` model
   - Memanggil `$this->student->getAll()` untuk mendapatkan data dari database
   - Membuat instance `StudentView`
   - Memanggil `$this->view->renderIndex($students)` untuk render halaman
4. `StudentView->renderIndex($students)`:
   - Memuat header dengan `renderHeader()`
   - Mengolah data untuk tampilan tabel
   - Menghasilkan HTML untuk browser
   - Memuat footer dengan `renderFooter()`

## Keamanan & Validasi

- Penggunaan **Prepared Statements** untuk mencegah SQL Injection
- Validasi input untuk mencegah duplikasi data
- Penanganan kesalahan dengan session messages
- Pencegahan duplikasi pendaftaran (satu mahasiswa tidak boleh mendaftar di mata kuliah yang sama dua kali)
- Penggunaan `htmlspecialchars()` untuk mencegah XSS

## Alur CRUD

Untuk alur operasi CRUD:

1. **Create Operation**:
   - Request → Controller → Validasi → Model (create) → Database → Redirect
   
2. **Read Operation**:
   - Request → Controller → Model (getAll/getById) → Database → View → Response
   
3. **Update Operation**:
   - Request GET → Controller → Model (getById) → Database → View → Form
   - Request POST → Controller → Validasi → Model (update) → Database → Redirect
   
4. **Delete Operation**:
   - Request → Controller → Model (delete) → Database → Redirect

## Dokumentasi



https://github.com/user-attachments/assets/ed4a9220-709b-44e7-a49a-94b8bb1d0e38



