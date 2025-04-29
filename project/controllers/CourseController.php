<?php
require_once 'models/Course.php';
require_once 'views/course.view.php';

class CourseController {
    private $course;
    private $view;
    
    public function __construct() {
        $this->course = new Course();
        $this->view = new CourseView();
    }
    
    public function index() {
        $courses = $this->course->getAll();
        $this->view->renderIndex($courses);
    }
    
    public function show($id) {
        if ($this->course->getById($id)) {
            
            
            header('Location: index.php?controller=course&action=index');
        } else {
            header('Location: index.php?controller=course&action=index');
        }
    }
    
    public function create() {
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $this->course->course_code = $_POST['course_code'];
            $this->course->course_name = $_POST['course_name'];
            $this->course->credit_hours = $_POST['credit_hours'];
            $this->course->description = $_POST['description'] ?? '';
            
            
            if ($this->course->create()) {
                header('Location: index.php?controller=course&action=index');
                return;
            }
        }
        
        $this->view->renderCreate();
    }
    
    public function edit($id) {
        
        if (!$this->course->getById($id)) {
            header('Location: index.php?controller=course&action=index');
            return;
        }
        
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $this->course->course_code = $_POST['course_code'];
            $this->course->course_name = $_POST['course_name'];
            $this->course->credit_hours = $_POST['credit_hours'];
            $this->course->description = $_POST['description'] ?? '';
            
            
            if ($this->course->update()) {
                header('Location: index.php?controller=course&action=index');
                return;
            }
        }
        
        $this->view->renderEdit($this->course);
    }
    
    public function delete($id) {
        
        if ($this->course->getById($id)) {
            
            if ($this->course->delete()) {
                header('Location: index.php?controller=course&action=index');
            }
        } else {
            header('Location: index.php?controller=course&action=index');
        }
    }
}
?>