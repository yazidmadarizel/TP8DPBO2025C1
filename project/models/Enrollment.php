<?php
require_once 'config/connection.php';

class Enrollment {
    private $conn;
    private $table = 'enrollments';
    
    
    public $id;
    public $student_id;
    public $course_id;
    public $enrollment_date;
    public $grade;
    
    
    public $student_name;
    public $student_nim;
    public $course_name;
    public $course_code;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    
    public function getAllWithDetails() {
        $query = "SELECT e.*, 
                  s.name as student_name, 
                  s.nim as student_nim,
                  c.course_name, 
                  c.course_code 
                  FROM {$this->table} e
                  JOIN students s ON e.student_id = s.id
                  JOIN courses c ON e.course_id = c.id
                  ORDER BY e.id ASC"; 
                  
        $result = $this->conn->query($query);
        return $result;
    }
    
    
    
    public function getById($id) {
        $query = "SELECT e.*, 
                 s.name as student_name,
                 s.nim as student_nim,
                 c.course_name,
                 c.course_code
                 FROM {$this->table} e
                 JOIN students s ON e.student_id = s.id
                 JOIN courses c ON e.course_id = c.id
                 WHERE e.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $this->id = $row['id'];
            $this->student_id = $row['student_id'];
            $this->course_id = $row['course_id'];
            $this->enrollment_date = $row['enrollment_date'];
            $this->grade = $row['grade'];
            $this->student_name = $row['student_name'];
            $this->student_nim = $row['student_nim'];
            $this->course_name = $row['course_name'];
            $this->course_code = $row['course_code'];
            
            return true;
        }
        
        return false;
    }
    
    
    public function create() {
        $query = "INSERT INTO {$this->table} 
                 (student_id, course_id, enrollment_date, grade) 
                 VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $this->grade = $this->grade ?? null;
        $stmt->bind_param("iiss", 
            $this->student_id, 
            $this->course_id, 
            $this->enrollment_date, 
            $this->grade);
        
        if ($stmt->execute()) {
            $this->id = $this->conn->insert_id;
            return true;
        }
        
        return false;
    }
    
    
    public function update() {
        $query = "UPDATE {$this->table} 
                 SET student_id = ?, 
                     course_id = ?, 
                     enrollment_date = ?, 
                     grade = ? 
                 WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $this->grade = $this->grade ?? null;
        $stmt->bind_param("iissi", 
            $this->student_id, 
            $this->course_id, 
            $this->enrollment_date, 
            $this->grade, 
            $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    
    public function delete() {
        $query = "DELETE FROM {$this->table} WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    
    public function enrollmentExists($student_id, $course_id) {
        $query = "SELECT id FROM {$this->table} 
                 WHERE student_id = ? AND course_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ii", $student_id, $course_id);
        $stmt->execute();
        $stmt->store_result();
        
        return $stmt->num_rows > 0;
    }
}
?>