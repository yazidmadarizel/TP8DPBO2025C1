<?php
require_once 'models/Student.php';
require_once 'views/student.view.php';

class StudentController {
    private $model;
    private $view;
    
    public function __construct() {
        $this->model = new Student();
        $this->view = new StudentView('student');
    }
    
    public function index() {
        $students = $this->model->getAll();
        
        $this->view->renderIndex($students);
    }
    
    public function show($id) {
        $student = $this->model->getById($id);
        if ($student) {
            
            
            header('Location: index.php?controller=student&action=index');
        } else {
            header('Location: index.php?controller=student&action=index');
        }
    }
    
    public function create() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $this->model->name = $_POST['name'];
            $this->model->nim = $_POST['nim'];
            $this->model->phone = $_POST['phone'];
            $this->model->email = $_POST['email'] ?? '';
            $this->model->join_date = $_POST['join_date'];
            
            
            if ($this->model->create()) {
                header('Location: index.php?controller=student&action=index');
                exit;
            }
        }
        
        
        $this->view->renderCreate();
    }
    
    public function edit($id) {
        
        $student = $this->model->getById($id);
        if (!$student) {
            header('Location: index.php?controller=student&action=index');
            exit;
        }
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $this->model->name = $_POST['name'];
            $this->model->nim = $_POST['nim'];
            $this->model->phone = $_POST['phone'];
            $this->model->email = $_POST['email'] ?? '';
            $this->model->join_date = $_POST['join_date'];
            
            
            if ($this->model->update()) {
                header('Location: index.php?controller=student&action=index');
                exit;
            }
        }
        
        
        $this->view->renderEdit($student);
    }
    
    public function delete($id) {
        
        if ($this->model->getById($id)) {
            
            if ($this->model->delete()) {
                header('Location: index.php?controller=student&action=index');
                exit;
            }
        }
        
        header('Location: index.php?controller=student&action=index');
    }
}
?>