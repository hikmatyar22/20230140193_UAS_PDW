<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Auth.php';

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $role = $_POST['role'] ?? '';
            $nim = ($role === 'mahasiswa') ? ($_POST['nim'] ?? null) : null;
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if (empty($username) || empty($full_name) || empty($role) || empty($password) || empty($password_confirm)) {
                $_SESSION['error_message'] = "Semua kolom wajib diisi.";
            } elseif ($password !== $password_confirm) {
                $_SESSION['error_message'] = "Konfirmasi password tidak cocok.";
            } elseif ($this->userModel->findByUsername($username)) {
                $_SESSION['error_message'] = "Username sudah terdaftar.";
            } else {
                if ($this->userModel->register($username, $password, $full_name, $role, $nim)) {
                    $_SESSION['success_message'] = "Registrasi berhasil! Silakan login.";
                    header('Location: ' . BASE_URL . 'index.php?page=login');
                    exit();
                } else {
                    $_SESSION['error_message'] = "Registrasi gagal. Silakan coba lagi.";
                }
            }
            header('Location: ' . BASE_URL . 'index.php?page=register');
            exit();
        }
        // Perbaikan path include: dari app/controllers ke views
        include __DIR__ . '/../../views/auth/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->userModel->findByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                Auth::login($user['id'], $user['role'], $user['full_name']); // Tambahkan full_name
                $_SESSION['success_message'] = "Login berhasil! Selamat datang, " . $user['full_name'] . ".";
                header('Location: ' . BASE_URL . 'index.php?page=dashboard');
                exit();
            } else {
                $_SESSION['error_message'] = "Username atau password salah.";
                header('Location: ' . BASE_URL . 'index.php?page=login');
                exit();
            }
        }
        // Perbaikan path include: dari app/controllers ke views
        include __DIR__ . '/../../views/auth/login.php';
    }

    public function logout() {
        Auth::logout();
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit();
    }
}