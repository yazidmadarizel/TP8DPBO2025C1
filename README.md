# TP8DPBO2025C1

Saya Yazid Madarizel dengan NIM 2305328 mengerjakan soal TP 8 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

---

## Desain Program

![image](https://github.com/user-attachments/assets/e2721eb2-56c3-478a-a0e4-84825076edb3)

### 1. Struktur Database
Program menggunakan tiga tabel utama:
- **students**: Menyimpan data mahasiswa (id, nama, NIM, telepon, email, tanggal bergabung)
- **courses**: Menyimpan data mata kuliah (id, kode, nama, SKS, deskripsi)
- **enrollments**: Menyimpan data pendaftaran mata kuliah oleh mahasiswa (id, student_id, course_id, tanggal pendaftaran, nilai)

### 2. Arsitektur Program

#### a. Model-View-Controller (MVC)
Program mengimplementasikan pola MVC:
- **Model**: Bertanggung jawab untuk logika bisnis dan interaksi database
- **View**: Menangani tampilan/UI yang dilihat pengguna
- **Controller**: Mengontrol alur aplikasi, menangani request, dan menghubungkan Model dan View

#### b. Front Controller Pattern
File `index.php` bertindak sebagai Front Controller yang menerima semua request. Ini memproses parameter URL (`controller`, `action`, dan `id`) untuk menentukan controller dan metode yang akan dipanggil.

### 3. Komponen Utama

#### a. Assets
Berisi file CSS dan JS dari framework Bootstrap dan jQuery untuk styling dan interaktivitas halaman.

#### b. Config
- `connection.php`: Berisi kelas Database untuk koneksi ke MySQL

#### c. Models
- `Student.php`: Model untuk operasi CRUD pada tabel students
- `Course.php`: Model untuk operasi CRUD pada tabel courses
- `Enrollment.php`: Model untuk operasi CRUD pada tabel enrollments

#### d. Controllers
- `StudentController.php`: Mengelola operasi terkait mahasiswa
- `CourseController.php`: Mengelola operasi terkait mata kuliah
- `EnrollmentController.php`: Mengelola operasi terkait pendaftaran mata kuliah

#### e. Views
- `student.view.php`, `course.view.php`, `enrollment.view.php`: Kelas view untuk rendering tampilan
- `template.class.php`: Implementasi simple template engine untuk memuat file HTML, mengganti placeholder dengan data dinamis, menghapus yang tidak terpakai, dan menghasilkan konten akhir.
- Folder `layouts`: Berisi header.php dan footer.php untuk layout konsisten

#### f. Templates
Folder berisi file HTML template untuk setiap entitas:
- `student/`: create.html, edit.html, index.html
- `course/`: create.html, edit.html, index.html
- `enrollment/`: create.html, edit.html, index.html

### 4. Fitur Program

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
   - Edit course (termasuk pemberian nilai)
   - Hapus course
  
# Alur Program Sistem Manajemen Mahasiswa

## Arsitektur Program

Program ini mengimplementasikan arsitektur **Model-View-Controller (MVC)** dengan tambahan beberapa pola desain seperti **Front Controller** dan **Template Engine** sederhana. Berikut penjelasan detail mengenai alur program berdasarkan kode yang telah disediakan.

## 1. Alur Request dan Pemrosesan

### Entry Point (index.php)
Semua request masuk melalui `index.php` yang bertindak sebagai Front Controller. Alur kerjanya:

1. **Menginisialisasi koneksi database** dengan memanggil `require_once 'config/connection.php'`
2. **Menentukan controller dan action** berdasarkan parameter URL:
   - `controller` (default: 'student')
   - `action` (default: 'index')
   - `id` (opsional)
3. **Memuat controller yang tepat** berdasarkan nilai parameter `controller`
4. **Memanggil method yang sesuai** pada controller berdasarkan nilai parameter `action`

### Contoh URL:
- `index.php?controller=student&action=index` (menampilkan daftar mahasiswa)
- `index.php?controller=course&action=create` (form untuk menambah mata kuliah baru)
- `index.php?controller=enrollment&action=edit&id=5` (edit data pendaftaran dengan ID 5)

## 2. Model

Model bertanggung jawab untuk logika bisnis dan interaksi dengan database.

### Class `Student` (models/Student.php)
- **Operasi CRUD** untuk entitas mahasiswa
- **Properties**: id, name, nim, phone, email, join_date
- **Methods**:
  - `getAll()`: Mengambil semua data mahasiswa
  - `getById($id)`: Mengambil data mahasiswa berdasarkan ID
  - `create()`: Menambah data mahasiswa baru
  - `update()`: Memperbarui data mahasiswa
  - `delete()`: Menghapus data mahasiswa

### Class `Course` (models/Course.php)
- **Operasi CRUD** untuk entitas mata kuliah
- **Properties**: id, course_code, course_name, credit_hours, description
- **Methods**: 
  - `getAll()`: Mengambil semua data mata kuliah
  - `getById($id)`: Mengambil data mata kuliah berdasarkan ID
  - `create()`: Menambah data mata kuliah baru
  - `update()`: Memperbarui data mata kuliah
  - `delete()`: Menghapus data mata kuliah

### Class `Enrollment` (models/Enrollment.php)
- **Operasi CRUD** untuk entitas pendaftaran mata kuliah
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

## 3. Controller

Controller mengelola alur aplikasi, memproses request, dan menghubungkan Model dengan View.

### `StudentController`
- **Menangani operasi terkait mahasiswa**
- **Methods**:
  - `index()`: Menampilkan daftar mahasiswa
  - `show($id)`: Menampilkan detail mahasiswa
  - `create()`: Menampilkan form dan memproses penambahan mahasiswa baru
  - `edit($id)`: Menampilkan form dan memproses edit data mahasiswa
  - `delete($id)`: Memproses penghapusan data mahasiswa

### `CourseController`
- **Menangani operasi terkait mata kuliah**
- **Methods**:
  - `index()`: Menampilkan daftar mata kuliah
  - `show($id)`: Menampilkan detail mata kuliah
  - `create()`: Menampilkan form dan memproses penambahan mata kuliah baru
  - `edit($id)`: Menampilkan form dan memproses edit data mata kuliah
  - `delete($id)`: Memproses penghapusan data mata kuliah

### `EnrollmentController`
- **Menangani operasi terkait pendaftaran mata kuliah**
- **Dependencies**: `Enrollment`, `Student`, `Course`
- **Methods**:
  - `index()`: Menampilkan daftar pendaftaran dengan detail mahasiswa dan mata kuliah
  - `create()`: Menampilkan form dan memproses penambahan pendaftaran baru
    - Validasi untuk mencegah duplikasi pendaftaran
  - `edit($id)`: Menampilkan form dan memproses edit data pendaftaran
  - `delete($id)`: Memproses penghapusan data pendaftaran

## 4. View

View bertanggung jawab untuk presentasi data ke pengguna. Implementasi sebenarnya menggunakan dua pendekatan berbeda:

### 1. Template Engine (untuk EnrollmentView)
- **Class `Template`** (`views/template.class.php`): Template engine sederhana
- **Methods**:
  - `__construct($filename)`: Memuat file template HTML
  - `clear()`: Menghapus placeholder yang tidak digunakan
  - `write()`: Menampilkan konten template
  - `getContent()`: Mengembalikan konten template
  - `replace($old, $new)`: Mengganti placeholder dengan data sebenarnya

### 2. Output Buffering (untuk StudentView dan CourseView)
Pendekatan ini menggunakan fungsi PHP native untuk output buffering (ob_start, ob_get_clean) dan include langsung file tampilan.

### View Classes Implementations:

#### StudentView (views/student.view.php)
- **Properties**:
  - `$controller`: Menyimpan nama controller (default: 'student')
  - `$student`: Data student untuk tampilan
- **Methods**:
  - `__construct($controller)`: Menginisialisasi view dengan nama controller
  - `renderHeader()`: Memuat header dengan output buffering
  - `renderFooter()`: Memuat footer dengan output buffering
  - `renderIndex($students)`: Menampilkan daftar mahasiswa
  - `renderCreate()`: Menampilkan form tambah mahasiswa
  - `renderEdit($student)`: Menampilkan form edit mahasiswa dengan data yang sudah diisi

#### CourseView (views/course.view.php)
- **Properties**:
  - `$controller`: Menyimpan nama controller (default: 'course')
- **Methods**:
  - `__construct($controller)`: Menginisialisasi view dengan nama controller
  - `renderHeader()`: Memuat header dengan output buffering
  - `renderIndex($courses)`: Menampilkan daftar mata kuliah
  - `renderCreate()`: Menampilkan form tambah mata kuliah
  - `renderEdit($course)`: Menampilkan form edit mata kuliah dengan data yang sudah diisi

#### EnrollmentView (views/enrollment.view.php)
- **Methods**:
  - `renderIndex($enrollments)`: Menampilkan daftar pendaftaran mata kuliah dengan menggunakan Template
  - `renderCreate($students, $courses)`: Menampilkan form tambah pendaftaran dengan dropdown mahasiswa dan mata kuliah
  - `renderEdit($enrollment, $students, $courses)`: Menampilkan form edit pendaftaran dengan data yang sudah diisi
  - `getNavbar($activeController)`: Method helper untuk menghasilkan HTML navbar dengan controller aktif

## 5. Perbedaan Pendekatan View

Program ini mengimplementasikan dua pendekatan berbeda untuk tampilan:

### StudentView dan CourseView:
- Menggunakan **Output Buffering** langsung dengan PHP
- Struktur HTML/PHP diletakkan langsung dalam metode render
- Menggunakan include untuk header dan footer (StudentView)
- Tidak memerlukan file template terpisah

### EnrollmentView:
- Menggunakan **Template Engine** (class Template)
- Memuat file HTML template terpisah (templates/enrollment/...)
- Memanipulasi template dengan placeholder dan replace
- Mencakup fungsi tambahan seperti getNavbar()

## 6. Siklus Request-Response

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

### Contoh Alur untuk Menambah Pendaftaran Baru:
1. User mengakses URL: `index.php?controller=enrollment&action=create`
2. `index.php` memuat `EnrollmentController` dan memanggil method `create()`
3. `EnrollmentController->create()`:
   - Jika request GET:
     - Mengambil data mahasiswa dan mata kuliah untuk dropdown
     - Menampilkan form tambah pendaftaran
   - Jika request POST:
     - Memvalidasi data (termasuk cek duplikasi)
     - Menambahkan data pendaftaran baru
     - Redirect ke halaman daftar pendaftaran
4. `EnrollmentView->renderCreate($students, $courses)`:
   - Membuat instance `Template` dengan file template "templates/enrollment/create.html"
   - Mengolah data mahasiswa dan mata kuliah untuk dropdown
   - Melakukan replace placeholder pada template
   - Memanggil `$tpl->write()` untuk menampilkan hasil ke browser

## 7. Keamanan & Validasi

### Keamanan Database
- Menggunakan **Prepared Statements** untuk mencegah SQL Injection
- Validasi input untuk mencegah duplikasi data

### Validasi Data
- Validasi sebelum penyimpanan data
- Penanganan kesalahan dengan session messages
- Pencegahan duplikasi pendaftaran (satu mahasiswa tidak boleh mendaftar di mata kuliah yang sama dua kali)

### Keamanan Output
- Penggunaan `htmlspecialchars()` untuk mencegah XSS pada StudentView dan CourseView

## 8. Diagram Alur

Berikut adalah gambaran alur program secara umum:

```
Request → index.php (Front Controller) → Controller → Model → Database
                                       ↓
           Response ← View ← Template/Output Buffering ← Controller ← Model ← Database
```

Untuk alur yang lebih spesifik dalam operasi CRUD:

1. **Create Operation**:
   - Request → Controller → Validasi → Model (create) → Database → Redirect
   
2. **Read Operation**:
   - Request → Controller → Model (getAll/getById) → Database → View → Response
   
3. **Update Operation**:
   - Request GET → Controller → Model (getById) → Database → View → Form
   - Request POST → Controller → Validasi → Model (update) → Database → Redirect
   
4. **Delete Operation**:
   - Request → Controller → Model (delete) → Database → Redirect

## 9. Integrasi Komponen

- **Database**: Semua model menggunakan kelas `Database` dari `config/connection.php`
- **Template Engine**: EnrollmentView menggunakan kelas `Template` untuk render halaman
- **Output Buffering**: StudentView dan CourseView menggunakan PHP native untuk output
- **Session**: Digunakan untuk menyimpan pesan kesalahan/sukses

Program menerapkan prinsip **Single Responsibility** di mana setiap komponen memiliki tanggung jawab tertentu, dan **Separation of Concerns** di mana logika bisnis, presentasi, dan alur program dipisahkan dengan jelas. Namun, terdapat inconsistency dalam pendekatan View antara EnrollmentView dan dua View lainnya, yang mengindikasikan kemungkinan evolusi bertahap dari sistem atau pengerjaan oleh developer yang berbeda.

## Dokumentasi

https://github.com/user-attachments/assets/af4e1aa9-a4c0-488c-96e5-3887f6a29d86

