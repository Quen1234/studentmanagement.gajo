<?php
use Gajo\StudentManagement\Core\Database;
use Gajo\StudentManagement\Model\StudentModel;

include 'vendor/autoload.php';

$db = new Database;
$student = new StudentModel;


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'create':
                $student->id = $_POST['id'];
                $student->name = $_POST['name'];
                $student->yearlevel = $_POST['yearlevel'];
                $student->course = $_POST['course'];
                $student->section = $_POST['section'];
                $student->create();
                
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();

                break;
            
        
    

            case 'update':
                $student->id = $_POST['id'];
                $student->name = $_POST['name'];
                $student->yearlevel = $_POST['yearlevel'];
                $student->course = $_POST['course'];
                $student->section = $_POST['section'];
                $student->update();
                break;
                
            case 'delete':
                $student->id = $_POST['id'];
                $student->delete();

                header("Location: " . $_SERVER['PHP_SELF']);
                exit();

                break;
        }
    }
}
$students = $student->read();
?>





























































<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .center-container {
            width: 100%;
            max-width: 800px;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h1, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 30px;
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <div class="center-container">
        <h1>Student Management System</h1>

        <form method="POST" action="index.php">
            <input type="text" name="id" placeholder="Enter student ID" required>
            <input type="text" name="name" placeholder="Enter student name" required>
            <input type="text" name="yearlevel" placeholder="Enter year level" required>
            <input type="text" name="course" placeholder="Enter course" required>
            <input type="text" name="section" placeholder="Enter section" required>

            <input type="submit" name="action" value="create">
            <input type="submit" name="action" value="read">
            <input type="submit" name="action" value="update">
        </form>

        <form method="POST" action="index.php">
            <input type="hidden" name="action" value="delete">
            <input type="text" name="id" placeholder="Enter student ID to delete" required>
            <input type="submit" value="Delete Student">
        </form>

        <div id="students">
            <?php if (isset($students) && count($students) > 0): ?>
                <h3>Student List</h3>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Year Level</th>
                            <th>Course</th>
                            <th>Section</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= htmlspecialchars($student['id']) ?></td>
                                <td><?= htmlspecialchars($student['name']) ?></td>
                                <td><?= htmlspecialchars($student['yearlevel']) ?></td>
                                <td><?= htmlspecialchars($student['course']) ?></td>
                                <td><?= htmlspecialchars($student['section']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p style="text-align: center;">No students found.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
