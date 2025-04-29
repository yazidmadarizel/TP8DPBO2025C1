CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `join_date` date NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `credit_hours` int(1) NOT NULL,
  `description` text DEFAULT NULL,
  PRIMARY KEY (`id`)
);

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

INSERT INTO `students` (`name`, `nim`, `phone`, `email`, `join_date`) 
VALUES 
('Alice Johnson', '123456789', '081234567890', 'alice.johnson@example.com', '2023-08-01'),
('Bob Smith', '987654321', '082345678901', 'bob.smith@example.com', '2023-08-02'),
('Charlie Brown', '111223344', '083456789012', 'charlie.brown@example.com', '2023-08-03');

INSERT INTO `courses` (`course_code`, `course_name`, `credit_hours`, `description`)
VALUES
('CS101', 'Introduction to Programming', 3, 'This course introduces basic programming concepts using a high-level programming language, focusing on problem-solving, algorithms, and software design.'),
('CS102', 'Data Structures and Algorithms', 3, 'This course covers fundamental data structures (arrays, linked lists, trees, graphs) and algorithms for searching, sorting, and optimization.'),
('CS201', 'Database Systems', 3, 'Introduction to relational databases, SQL, database design, normalization, and transaction management. Students will also learn about NoSQL databases.'),
('CS202', 'Operating Systems', 3, 'Covers the fundamentals of operating systems, including process management, memory management, file systems, and system security.');

INSERT INTO `enrollments` (`student_id`, `course_id`, `enrollment_date`, `grade`)
VALUES
(1, 1, '2023-08-05', 'A'),
(1, 2, '2023-08-05', 'B'),
(2, 3, '2023-08-06', 'A'),
(2, 4, '2023-08-06', 'B'),
(3, 1, '2023-08-07', 'A'),
(3, 3, '2023-08-07', 'A');
