<?php
// app/models/User.php

class User {
    private $conn;
    private $table_name = "users";

    public function __construct() {
        $database = Database::getInstance();
        $this->conn = $database->getConnection();
    }

    public function register($username, $password, $full_name, $role, $nim = null) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table_name . " (username, password, full_name, role, nim) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        try {
            return $stmt->execute([$username, $hashed_password, $full_name, $role, $nim]);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findByUsername($username) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function findById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAllUsers() {
        $query = "SELECT id, username, full_name, role, nim FROM " . $this->table_name . " ORDER BY role, full_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUsersByRole($role) {
        $query = "SELECT id, username, full_name, role, nim FROM " . $this->table_name . " WHERE role = ? ORDER BY full_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$role]);
        return $stmt->fetchAll();
    }

    public function updateUser($id, $username, $full_name, $role, $nim = null, $password = null) {
        $query = "UPDATE " . $this->table_name . " SET username = ?, full_name = ?, role = ?";
        $params = [$username, $full_name, $role];

        if ($role === 'mahasiswa') {
            $query .= ", nim = ?";
            $params[] = $nim;
        } else {
            $query .= ", nim = NULL";
        }

        if ($password !== null && $password !== '') {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $query .= ", password = ?";
            $params[] = $hashed_password;
        }

        $query .= " WHERE id = ?";
        $params[] = $id;

        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteUser($id) {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        try {
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            return false;
        }
    }
}