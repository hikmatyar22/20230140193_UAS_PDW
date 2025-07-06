<?php
// app/models/Submission.php

class Submission {
    private $conn;
    private $table_name = "submissions";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function createSubmission($user_id, $module_id, $file_path) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, module_id, file_path) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$user_id, $module_id, $file_path]);
        } catch (PDOException $e) {
            // echo "Error creating submission: " . $e->getMessage();
            return false;
        }
    }

    public function updateSubmissionFile($submission_id, $new_file_path) {
        // Ketika file diperbarui, reset grade dan feedback ke NULL dan status ke 'submitted'
        $query = "UPDATE " . $this->table_name . " SET file_path = ?, status = 'submitted', grade = NULL, feedback = NULL WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$new_file_path, $submission_id]);
        } catch (PDOException $e) {
            // echo "Error updating submission file: " . $e->getMessage();
            return false;
        }
    }

    public function getSubmissionById($id) {
        $query = "SELECT s.*, u.full_name as student_name, u.nim, m.module_name, p.name as praktikum_name FROM " . $this->table_name . " s JOIN users u ON s.user_id = u.id JOIN modules m ON s.module_id = m.id JOIN praktikums p ON m.praktikum_id = p.id WHERE s.id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getSubmissionsByUserIdAndPraktikumId($user_id, $praktikum_id) {
        $query = "SELECT s.*, m.module_name FROM " . $this->table_name . " s JOIN modules m ON s.module_id = m.id WHERE s.user_id = ? AND m.praktikum_id = ? ORDER BY m.module_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $praktikum_id]);
        return $stmt->fetchAll();
    }

    public function getSubmissionByUserIdAndModuleId($user_id, $module_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = ? AND module_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$user_id, $module_id]);
        return $stmt->fetch();
    }

    public function getFilteredSubmissions($module_id = null, $user_id = null, $status = null) {
        $query = "SELECT s.*, u.full_name as student_name, u.nim, m.module_name, p.name as praktikum_name, p.id as praktikum_id
                  FROM " . $this->table_name . " s
                  JOIN users u ON s.user_id = u.id
                  JOIN modules m ON s.module_id = m.id
                  JOIN praktikums p ON m.praktikum_id = p.id
                  WHERE 1=1";
        $params = [];

        if ($module_id) {
            $query .= " AND m.id = ?";
            $params[] = $module_id;
        }
        if ($user_id) {
            $query .= " AND u.id = ?";
            $params[] = $user_id;
        }
        if ($status) {
            $query .= " AND s.status = ?";
            $params[] = $status;
        }

        $query .= " ORDER BY s.submission_date DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    public function gradeSubmission($submission_id, $grade, $feedback) {
        $query = "UPDATE " . $this->table_name . " SET grade = ?, feedback = ?, status = 'graded' WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$grade, $feedback, $submission_id]);
        } catch (PDOException $e) {
            // echo "Error grading submission: " . $e->getMessage();
            return false;
        }
    }
}