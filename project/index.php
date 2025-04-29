<?php



require_once 'config/connection.php';


$controller = isset($_GET['controller']) ? $_GET['controller'] : 'student';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;


switch ($controller) {
    case 'student':
        require_once 'controllers/StudentController.php';
        $controller = new StudentController();
        break;
    
    case 'course':
        require_once 'controllers/CourseController.php';
        $controller = new CourseController();
        break;
    
    case 'enrollment':
        require_once 'controllers/EnrollmentController.php';
        $controller = new EnrollmentController();
        break;
    
    default:
        require_once 'controllers/StudentController.php';
        $controller = new StudentController();
        $action = 'index';
}


switch ($action) {
    case 'index':
        $controller->index();
        break;
    
    case 'show':
        if ($id !== null) {
            $controller->show($id);
        } else {
            $controller->index();
        }
        break;
    
    case 'create':
        $controller->create();
        break;
    
    case 'edit':
        if ($id !== null) {
            $controller->edit($id);
        } else {
            $controller->index();
        }
        break;
    
    case 'delete':
        if ($id !== null) {
            $controller->delete($id);
        } else {
            $controller->index();
        }
        break;
    
    default:
        $controller->index();
}
?>