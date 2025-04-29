<?php
require_once 'config/connection.php';

class Student {
    private $conn;
    private $table = 'students';
    
    
    public $id;
    public $name;
    public $nim;
    public $phone;
    public $email;
    public $join_date;
    
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
            $this->name = $row['name'];
            $this->nim = $row['nim'];
            $this->phone = $row['phone'];
            $this->email = $row['email'] ?? "";
            $this->join_date = $row['join_date'];
            
            return true;
        }
        
        return false;
    }
    
    
    public function create() {
        $query = "INSERT INTO {$this->table} (name, nim, phone, email, join_date) VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $this->name, $this->nim, $this->phone, $this->email, $this->join_date);
        
        if ($stmt->execute()) {
            return true;
        }
        
        return false;
    }
    
    
    public function update() {
        $query = "UPDATE {$this->table} SET name = ?, nim = ?, phone = ?, email = ?, join_date = ? WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->name, $this->nim, $this->phone, $this->email, $this->join_date, $this->id);
        
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