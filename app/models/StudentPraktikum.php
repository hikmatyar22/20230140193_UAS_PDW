<?php
// app/models/StudentPraktikum.php

class StudentPraktikum {
    private $conn;
    private $table_name = "student_praktikums";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function registerStudentToPraktikum($user_id, $praktikum_id) {
        if ($this->isAlreadyRegistered($user_id, $praktikum_id)) {
            return false; // Already registered
        }
        $query = "INSERT INTO " . $this->table_name . " (user_id, praktikum_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$user_id, $praktikum_id]);
        } catch (PDOException $e) {
            // echo "Error registering student to praktikum: " . $e->getMessage();
            return false;
        }
    }

    public function isAlreadyRegistered($user_id, $praktikum_id) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE user_id = ? AND praktikum_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $praktikum_id]);
        return $stmt->fetchColumn() > 0;
    }

    public function getPraktikumsByUserId($user_id) {
        $query = "SELECT sp.*, p.name as praktikum_name, p.description FROM " . $this->table_name . " sp JOIN praktikums p ON sp.praktikum_id = p.id WHERE sp.user_id = ? ORDER BY p.name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function isStudentRegisteredToPraktikum($user_id, $praktikum_id) {
        $query = "SELECT COUNT(*) FROM " . $this->table_name . " WHERE user_id = ? AND praktikum_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $praktikum_id]);
        return $stmt->fetchColumn() > 0;
    }
}