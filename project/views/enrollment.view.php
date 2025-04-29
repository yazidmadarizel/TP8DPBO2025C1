<?php
require_once  'views/template.class.php';

class EnrollmentView
{
    public function renderIndex($enrollments)
    {
        $dataTabel = '';
        while ($row = $enrollments->fetch_assoc()) {
            $dataTabel .= "<tr>
                <td>{$row['id']}</td>
                <td>{$row['student_name']} ({$row['student_nim']})</td>
                <td>{$row['course_name']} ({$row['course_code']})</td>
                <td>{$row['enrollment_date']}</td>
                <td>" . ($row['grade'] ?: '-') . "</td>
                <td>
                    <a href='index.php?controller=enrollment&action=edit&id={$row['id']}' class='btn btn-sm btn-success'>Edit</a>
                    <a href='index.php?controller=enrollment&action=delete&id={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirm(\"Are you sure you want to delete this enrollment?\");'>Delete</a>
                </td>
            </tr>";
        }

        $tpl = new Template("templates/enrollment/index.html");
        $tpl->replace("JUDUL", "Enrollments");
        $tpl->replace("NAVBAR", $this->getNavbar('enrollment'));
        $tpl->replace("DATA_TABEL", $dataTabel);
        $tpl->write();
    }

    public function renderCreate($students, $courses)
    {
        $studentOptions = '';
        while ($student = $students->fetch_assoc()) {
            $studentOptions .= "<option value='{$student['id']}'>{$student['name']} ({$student['nim']})</option>";
        }

        $courseOptions = '';
        while ($course = $courses->fetch_assoc()) {
            $courseOptions .= "<option value='{$course['id']}'>{$course['course_name']} ({$course['course_code']})</option>";
        }

        $tpl = new Template("templates/enrollment/create.html");
        $tpl->replace("JUDUL", "Create Enrollment");
        $tpl->replace("NAVBAR", $this->getNavbar('enrollment'));
        $tpl->replace("FORM_ACTION", "index.php?controller=enrollment&action=create");
        $tpl->replace("STUDENT_OPTIONS", $studentOptions);
        $tpl->replace("COURSE_OPTIONS", $courseOptions);
        $tpl->write();
    }

    public function renderEdit($enrollment, $students, $courses)
    {
        $studentOptions = '';
        while ($student = $students->fetch_assoc()) {
            $selected = $student['id'] == $enrollment->student_id ? 'selected' : '';
            $studentOptions .= "<option value='{$student['id']}' $selected>{$student['name']} ({$student['nim']})</option>";
        }

        $courseOptions = '';
        while ($course = $courses->fetch_assoc()) {
            $selected = $course['id'] == $enrollment->course_id ? 'selected' : '';
            $courseOptions .= "<option value='{$course['id']}' $selected>{$course['course_name']} ({$course['course_code']})</option>";
        }

        $gradeSelected = [
            'GRADE_SELECTED' => $enrollment->grade == '' ? 'selected' : '',
            'GRADE_A' => $enrollment->grade == 'A' ? 'selected' : '',
            'GRADE_B' => $enrollment->grade == 'B' ? 'selected' : '',
            'GRADE_C' => $enrollment->grade == 'C' ? 'selected' : '',
            'GRADE_D' => $enrollment->grade == 'D' ? 'selected' : '',
            'GRADE_E' => $enrollment->grade == 'E' ? 'selected' : '',
            'GRADE_F' => $enrollment->grade == 'F' ? 'selected' : '',
        ];

        $tpl = new Template("templates/enrollment/edit.html");
        $tpl->replace("JUDUL", "Edit Enrollment");
        $tpl->replace("NAVBAR", $this->getNavbar('enrollment'));
        $tpl->replace("FORM_ACTION", "index.php?controller=enrollment&action=edit&id={$enrollment->id}");
        $tpl->replace("STUDENT_OPTIONS", $studentOptions);
        $tpl->replace("COURSE_OPTIONS", $courseOptions);
        $tpl->replace("ENROLLMENT_DATE", $enrollment->enrollment_date);
        
        foreach ($gradeSelected as $key => $value) {
            $tpl->replace($key, $value);
        }
        
        $tpl->write();
    }

    private function getNavbar($activeController)
    {
        $navbar = '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">Student Management</a>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link ' . ($activeController == 'student' ? 'active' : '') . '" href="index.php?controller=student&action=index">Students</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ' . ($activeController == 'course' ? 'active' : '') . '" href="index.php?controller=course&action=index">Courses</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ' . ($activeController == 'enrollment' ? 'active' : '') . '" href="index.php?controller=enrollment&action=index">Enrollments</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>';

        return $navbar;
    }
}