<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Student Management</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $controller == 'student' ? 'active' : ''; ?>" href="index.php?controller=student&action=index">Students</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $controller == 'course' ? 'active' : ''; ?>" href="index.php?controller=course&action=index">Courses</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $controller == 'enrollment' ? 'active' : ''; ?>" href="index.php?controller=enrollment&action=index">Enrollments</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">