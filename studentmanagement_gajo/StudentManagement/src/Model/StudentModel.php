<?php
namespace Gajo\StudentManagement\Model;

use Gajo\StudentManagement\Core\Crud;
use Gajo\StudentManagement\Core\Database;

class StudentModel extends Database implements Crud {

    public $id;
    public $name;
    public $yearlevel;
    public $course;
    public $section;

    public function __construct() {
        parent::__construct();
        $this->id = "";
        $this->name = "";
        $this->yearlevel = "";
        $this->course = "";
        $this->section = "";
    }

    public function create() {
        try {
            $sql = "INSERT INTO students (id, name, yearlevel, course, section)
             VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("sssss", $this->id, $this->name, $this->yearlevel, $this->course, $this->section);
            $stmt->execute();
        } catch (\Exception $e) {
            echo "Create Error: " . $e->getMessage();
        }
    }

    public function read() {
        try {

            $sql = "SELECT * FROM students";
            $result = $this->conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        } catch (\Exception $e) {
            echo "Read Error: " . $e->getMessage();
            return [];
        }
    }

    public function update() {
        try {
            $sql = "UPDATE students SET name = ?, yearlevel = ?, course = ?, section = ? WHERE id = ?";
            $stmt = $this->conn->prepare($sql);

            $stmt->bind_param("sssss",$this->name, $this->yearlevel, $this->course, $this->section, $this->id);
            $stmt->execute();
        } catch (\Exception $e) {
            echo "Update Error: " . $e->getMessage();
        }
    }
 
    public function delete() {
        try {

            $sql = "DELETE FROM students WHERE id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $this->id);
            $stmt->execute();
        
        } catch (\Exception $e) {
            echo "Delete Error: " . $e->getMessage();
        }
    }
}
