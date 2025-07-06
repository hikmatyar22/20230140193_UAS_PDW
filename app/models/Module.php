<?php
// app/models/Module.php

class Module {
    private $conn;
    private $table_name = "modules";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function createModule($praktikum_id, $module_name, $material_file_path = null) {
        $query = "INSERT INTO " . $this->table_name . " (praktikum_id, module_name, material_file_path) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$praktikum_id, $module_name, $material_file_path]);
        } catch (PDOException $e) {
            // echo "Error creating module: " . $e->getMessage();
            return false;
        }
    }

    public function getAllModules() {
        $query = "SELECT m.*, p.name as praktikum_name FROM " . $this->table_name . " m JOIN praktikums p ON m.praktikum_id = p.id ORDER BY p.name, m.module_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getModulesByPraktikumId($praktikum_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE praktikum_id = ? ORDER BY module_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$praktikum_id]);
        return $stmt->fetchAll();
    }

    public function getModuleById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function updateModule($id, $module_name, $material_file_path = null) {
        $query = "UPDATE " . $this->table_name . " SET module_name = ?, material_file_path = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$module_name, $material_file_path, $id]);
        } catch (PDOException $e) {
            // echo "Error updating module: " . $e->getMessage();
            return false;
        }
    }

    public function deleteModule($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // Might fail due to foreign key constraints (e.g., related submissions exist)
            // echo "Error deleting module: " . $e->getMessage();
            return false;
        }
    }
}