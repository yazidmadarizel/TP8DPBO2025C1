<?php
class StudentView
{
    private $controller;
    public $student;
    
    public function __construct($controller = 'student') {
        $this->controller = $controller;
    }
    
    private function renderHeader() {
        $controller = $this->controller;
        ob_start();
        include 'views/layouts/header.php';
        return ob_get_clean();
    }

    private function renderFooter() {
        ob_start();
        include 'views/layouts/footer.php';
        return ob_get_clean();
    }

    public function renderIndex($students)
    {
        $dataTabel = '';
        while ($row = $students->fetch_assoc()) {
            $dataTabel .= "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['nim']}</td>
                <td>{$row['phone']}</td>
                <td>" . (isset($row['email']) && !empty($row['email']) ? $row['email'] : '-') . "</td>
                <td>{$row['join_date']}</td>
                <td>
                    <a href='index.php?controller=student&action=edit&id={$row['id']}' class='btn btn-sm btn-success'>Edit</a>
                    <a href='index.php?controller=student&action=delete&id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this student?\");'>Delete</a>
                </td>
            </tr>";
        }

        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        
        echo $header;
        ?>
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Students</h1>
            <a href="index.php?controller=student&action=create" class="btn btn-primary">Add New Student</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>NIM</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Join Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php echo $dataTabel; ?>
            </tbody>
        </table>
        <?php
        echo $footer;
    }

    public function renderCreate()
    {
        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        
        echo $header;
        ?>
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Create Student</h4>
            </div>
            <div class="card-body">
                <form action="index.php?controller=student&action=create" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Join Date</label>
                        <input type="date" name="join_date" id="join_date" class="form-control" required>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Submit</button>
                        <a href="index.php?controller=student&action=index" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
        echo $footer;
    }

    public function renderEdit($student)
    {
        $this->student = $student;
        $header = $this->renderHeader();
        $footer = $this->renderFooter();
        
        echo $header;
        ?>
        <div class="card">
            <div class="card-header bg-warning text-white">
                <h4 class="mb-0">Edit Student</h4>
            </div>
            <div class="card-body">
                <form action="index.php?controller=student&action=edit&id=<?php echo $student->id; ?>" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" class="form-control" 
                               value="<?php echo htmlspecialchars($student->name); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="nim" class="form-label">NIM</label>
                        <input type="text" name="nim" id="nim" class="form-control" 
                               value="<?php echo htmlspecialchars($student->nim); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" 
                               value="<?php echo htmlspecialchars($student->phone); ?>" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" 
                               value="<?php echo htmlspecialchars($student->email); ?>">
                    </div>
                    
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Join Date</label>
                        <input type="date" name="join_date" id="join_date" class="form-control" 
                               value="<?php echo htmlspecialchars($student->join_date); ?>" required>
                    </div>
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="index.php?controller=student&action=index" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
        <?php
        echo $footer;
    }
}