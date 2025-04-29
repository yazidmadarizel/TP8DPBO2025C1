<?php
require_once 'config/connection.php';

class Course {
    private $conn;
    private $table = 'courses';
    
    
    public $id;
    public $course_code;
    public $course_name;
    public $credit_hours;
    public $description;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    
    public function getAll() {
        $query = "SELECT * FROM {$this->table}";
        $result = $this->conn->query($query);
        
        return $result;
    }
    
    
    public function getById($id) {
        $query = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            
            $this->id = $row['id'];
            $this->course_code = $row['course_code'];
            $this->course_name = $row['course_name'];
            $this->credit_hours = $row['credit_hours'];
            $this->description = $row['description'];
            
            return true;
        }
        
        return false;
    }
    
    
    public function create() {
        $query = "INSERT INTO {$this->table} (course_code, course_name, credit_hours, description) VALUES (?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssis", $this->course_code, $this->course_name, $this->credit_hours, $this->description);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    
    public function update() {
        $query = "UPDATE {$this->table} SET course_code = ?, course_name = ?, credit_hours = ?, description = ? WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssisi", $this->course_code, $this->course_name, $this->credit_hours, $this->description, $this->id);
        
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
}
?>