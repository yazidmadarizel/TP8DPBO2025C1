<?php
class CourseView
{
    private $controller;
    
    public function __construct($controller = 'course') {
        $this->controller = $controller;
    }
    
    private function renderHeader() {
        $controller = $this->controller;
        ob_start();
        include 'views/layouts/header.php';
        return ob_get_clean();
    }

    public function renderIndex($courses)
    {
        $dataTabel = '';
        while ($row = $courses->fetch_assoc()) {
            $dataTabel .= "<tr>
                <td>{$row['id']}</td>
                <td>{$row['course_code']}</td>
                <td>{$row['course_name']}</td>
                <td>{$row['credit_hours']}</td>
                <td>" . (isset($row['description']) ? $row['description'] : '-') . "</td>
                <td>
                    <a href='index.php?controller=course&action=edit&id={$row['id']}' class='btn btn-sm btn-success'>Edit</a>
                    <a href='index.php?controller=course&action=delete&id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this course?\");'>Delete</a>
                </td>
            </tr>";
        }

        $header = $this->renderHeader();
        
        echo $header;
        ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Courses</h1>
            <a href="index.php?controller=course&action=create" class="btn btn-primary">Add New Course</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Course Code</th>
                    <th>Course Name</th>
                    <th>Credit Hours</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $dataTabel; ?>
            </tbody>
        </table>
        
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }

    public function renderCreate()
    {
        $header = $this->renderHeader();
        
        echo $header;
        ?>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Create Course</h4>
            </div>
            <div class="card-body">
                <form action="index.php?controller=course&action=create" method="post">
                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input type="text" name="course_code" id="course_code" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" name="course_name" id="course_name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="credit_hours" class="form-label">Credit Hours</label>
                        <input type="number" name="credit_hours" id="credit_hours" class="form-control" min="1" max="6" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="index.php?controller=course&action=index" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }

    public function renderEdit($course)
    {
        $header = $this->renderHeader();
        
        echo $header;
        ?>
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Edit Course</h4>
            </div>
            <div class="card-body">
                <form action="index.php?controller=course&action=edit&id=<?php echo $course->id; ?>" method="post">
                    <div class="mb-3">
                        <label for="course_code" class="form-label">Course Code</label>
                        <input type="text" name="course_code" id="course_code" class="form-control" 
                               value="<?php echo htmlspecialchars($course->course_code); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="course_name" class="form-label">Course Name</label>
                        <input type="text" name="course_name" id="course_name" class="form-control" 
                               value="<?php echo htmlspecialchars($course->course_name); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="credit_hours" class="form-label">Credit Hours</label>
                        <input type="number" name="credit_hours" id="credit_hours" class="form-control" min="1" max="6" 
                               value="<?php echo htmlspecialchars($course->credit_hours); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3"><?php 
                            echo htmlspecialchars($course->description); 
                        ?></textarea>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="index.php?controller=course&action=index" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        </body>
        </html>
        <?php
    }
}