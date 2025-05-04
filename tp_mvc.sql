
-- Buat tabel students
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`)
);

-- Buat tabel courses
CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credit_hours` int(1) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);

-- Buat tabel enrollments
CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enrollment_date` date NOT NULL,
  `grade` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`course_id`) REFERENCES `courses`(`id`) ON DELETE CASCADE
);

-- Tambahkan data ke tabel students
INSERT INTO `students` (`name`, `nim`, `phone`, `email`, `join_date`) 
VALUES 
('Iqbal Rahmat', '2303820', '081234567890', 'iqbalrahmat@gmail.com', '2023-08-01'),
('Hafiz Minhaj', '2204999', '082345678901', 'hafizminhaj@gmail.com', '2023-08-02'),
('Edy Suparman', '2404854', '083456789012', 'edysuparman@gmail.com', '2023-08-03');

-- Tambahkan data ke tabel courses (dalam Bahasa Indonesia)
INSERT INTO `courses` (`course_code`, `course_name`, `credit_hours`, `description`)
VALUES
('CS101', 'Pengantar Pemrograman', 3, 'Mata kuliah ini memperkenalkan konsep dasar pemrograman menggunakan bahasa pemrograman tingkat tinggi, dengan fokus pada pemecahan masalah, algoritma, dan desain perangkat lunak.'),
('CS102', 'Struktur Data dan Algoritma', 3, 'Mata kuliah ini membahas struktur data dasar (array, linked list, tree, graph) dan algoritma untuk pencarian, pengurutan, dan optimasi.'),
('CS201', 'Sistem Basis Data', 3, 'Pengantar sistem basis data relasional, SQL, desain basis data, normalisasi, dan manajemen transaksi. Mahasiswa juga akan mempelajari basis data NoSQL.'),
('CS202', 'Sistem Operasi', 3, 'Membahas dasar-dasar sistem operasi, termasuk manajemen proses, manajemen memori, sistem berkas, dan keamanan sistem.');

-- Tambahkan data ke tabel enrollments
INSERT INTO `enrollments` (`student_id`, `course_id`, `enrollment_date`, `grade`)
VALUES
(1, 1, '2023-08-05', 'A'),
(1, 2, '2023-08-05', 'B'),
(2, 3, '2023-08-06', 'A'),
(2, 4, '2023-08-06', 'B'),
(3, 1, '2023-08-07', 'A'),
(3, 3, '2023-08-07', 'A');
