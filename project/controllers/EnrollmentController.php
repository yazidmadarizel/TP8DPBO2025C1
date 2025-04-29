<?php
require_once 'models/Enrollment.php';
require_once 'models/Student.php';
require_once 'models/Course.php';
require_once 'views/enrollment.view.php';

class EnrollmentController {
    private $enrollment;
    private $student;
    private $course;
    private $view;
    
    public function __construct() {
        $this->enrollment = new Enrollment();
        $this->student = new Student();
        $this->course = new Course();
        $this->view = new EnrollmentView();
    }
    
    public function index() {
        $enrollments = $this->enrollment->getAllWithDetails();
        $this->view->renderIndex($enrollments);
    }
    
    public function create() {
        $students = $this->student->getAll();
        $courses = $this->course->getAll();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->enrollment->student_id = $_POST['student_id'];
            $this->enrollment->course_id = $_POST['course_id'];
            $this->enrollment->enrollment_date = $_POST['enrollment_date'];
            $this->enrollment->grade = $_POST['grade'] ?? null;
            
            
            if ($this->enrollment->enrollmentExists(
                $this->enrollment->student_id, 
                $this->enrollment->course_id
            )) {
                $_SESSION['error'] = 'This student is already enrolled in this course';
                $this->view->renderCreate($students, $courses);
                return;
            }
            
            if ($this->enrollment->create()) {
                $_SESSION['success'] = 'Enrollment created successfully';
                header('Location: index.php?controller=enrollment&action=index');
                return;
            }
            
            $_SESSION['error'] = 'Failed to create enrollment';
        }
        
        $this->view->renderCreate($students, $courses);
    }
    
    public function edit($id) {
        $students = $this->student->getAll();
        $courses = $this->course->getAll();
        
        if (!$this->enrollment->getById($id)) {
            $_SESSION['error'] = 'Enrollment not found';
            header('Location: index.php?controller=enrollment&action=index');
            return;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->enrollment->student_id = $_POST['student_id'];
            $this->enrollment->course_id = $_POST['course_id'];
            $this->enrollment->enrollment_date = $_POST['enrollment_date'];
            $this->enrollment->grade = $_POST['grade'] ?? null;
            
            if ($this->enrollment->update()) {
                $_SESSION['success'] = 'Enrollment updated successfully';
                header('Location: index.php?controller=enrollment&action=index');
                return;
            }
            
            $_SESSION['error'] = 'Failed to update enrollment';
        }
        
        $this->view->renderEdit($this->enrollment, $students, $courses);
    }
    
    public function delete($id) {
        if ($this->enrollment->getById($id)) {
            if ($this->enrollment->delete()) {
                $_SESSION['success'] = 'Enrollment deleted successfully';
            } else {
                $_SESSION['error'] = 'Failed to delete enrollment';
            }
        } else {
            $_SESSION['error'] = 'Enrollment not found';
        }
        
        header('Location: index.php?controller=enrollment&action=index');
    }
}
?>