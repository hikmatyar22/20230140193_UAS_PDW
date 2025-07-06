<?php
// app/models/Praktikum.php

class Praktikum {
    private $conn;
    private $table_name = "praktikums";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function createPraktikum($name, $description) {
        $query = "INSERT INTO " . $this->table_name . " (name, description) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$name, $description]);
        } catch (PDOException $e) {
            // Error handling, e.g., duplicate name
            // echo "Error creating praktikum: " . $e->getMessage();
            return false;
        }
    }

    public function getAllPraktikums() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPraktikumById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updatePraktikum($id, $name, $description) {
        $query = "UPDATE " . $this->table_name . " SET name = ?, description = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$name, $description, $id]);
        } catch (PDOException $e) {
            // echo "Error updating praktikum: " . $e->getMessage();
            return false;
        }
    }

    public function deletePraktikum($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // Might fail due to foreign key constraints (e.g., related modules or student_praktikums exist)
            // echo "Error deleting praktikum: " . $e->getMessage();
            return false;
        }
    }
}