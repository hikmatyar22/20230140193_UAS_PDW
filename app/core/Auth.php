<?php
// app/core/Auth.php

class Auth {
    public static function startSession() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function login($user_id, $role, $full_name) { // Ditambahkan $full_name
        self::startSession();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_role'] = $role;
        $_SESSION['full_name'] = $full_name; // Simpan full_name
    }

    public static function logout() {
        self::startSession();
        session_unset();
        session_destroy();
    }

    public static function checkLogin() {
        self::startSession();
        return isset($_SESSION['user_id']);
    }

    public static function getUserRole() {
        self::startSession();
        return $_SESSION['user_role'] ?? null;
    }

    public static function getUserId() {
        self::startSession();
        return $_SESSION['user_id'] ?? null;
    }

    // Mendapatkan nama lengkap pengguna yang sedang login
    public static function getFullName() {
        self::startSession();
        return $_SESSION['full_name'] ?? null;
    }


    public static function requireLogin() {
        if (!self::checkLogin()) {
            $_SESSION['error_message'] = "Anda harus login untuk mengakses halaman ini.";
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit();
        }
    }

    public static function requireRole($required_role) {
        if (!self::checkLogin() || self::getUserRole() !== $required_role) {
            $_SESSION['error_message'] = "Anda tidak memiliki izin untuk mengakses halaman ini.";
            header('Location: ' . BASE_URL . 'index.php?page=unauthorized');
            exit();
        }
    }
}