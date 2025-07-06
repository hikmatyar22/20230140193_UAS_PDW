<?php
// public/index.php

session_start();

require_once __DIR__ . '/../app/config/database.php';
require_once __DIR__ . '/../app/core/Database.php';
require_once __DIR__ . '/../app/core/Auth.php';
require_once __DIR__ . '/../app/core/Helper.php';

// Muat semua model
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/models/Praktikum.php';
require_once __DIR__ . '/../app/models/Module.php';
require_once __DIR__ . '/../app/models/Submission.php';
require_once __DIR__ . '/../app/models/StudentPraktikum.php';

// Muat controllers
require_once __DIR__ . '/../app/controllers/AuthController.php';
require_once __DIR__ . '/../app/controllers/PraktikumController.php';

// Buat instance controllers
$authController = new AuthController();
$praktikumController = new PraktikumController();

$page = $_GET['page'] ?? 'home';

include __DIR__ . '/../views/layouts/header.php';

switch ($page) {
    case 'register':
        $authController->register();
        break;

    case 'login':
        $authController->login();
        break;

    case 'logout':
        $authController->logout();
        break;

    case 'dashboard':
        Auth::requireLogin();
        $role = Auth::getUserRole();
        if ($role === 'mahasiswa') {
            include __DIR__ . '/../views/mahasiswa/dashboard.php';
        } elseif ($role === 'asisten') {
            include __DIR__ . '/../views/asisten/dashboard.php';
        } else {
            header('Location: ' . BASE_URL . 'index.php?page=login');
            exit();
        }
        break;

    case 'praktikum_katalog':
        $praktikumController->showKatalog();
        break;

    case 'praktikum_daftar':
        $praktikumController->registerToPraktikum();
        break;

    case 'praktikum_saya':
        $praktikumController->showMyPraktikums();
        break;

    case 'praktikum_detail':
        $praktikumController->showPraktikumDetail();
        break;

    case 'upload_submission':
        $praktikumController->uploadSubmission();
        break;

    case 'asisten_praktikum_management':
        $praktikumController->managePraktikums();
        break;

    case 'asisten_module_management':
        $praktikumController->manageModules();
        break;

    case 'asisten_submission_list':
        $praktikumController->showSubmissionList();
        break;

    case 'asisten_grade_submission':
        $praktikumController->gradeSubmission();
        break;

    case 'asisten_user_management':
        $praktikumController->manageUsers();
        break;

    case 'unauthorized':
        echo "<div class='flex flex-col items-center justify-center min-h-[calc(100vh-16rem)] p-4 text-center'>"; // Added flex for centering
        echo "<h2 class='text-red-500 text-4xl font-extrabold mt-10 mb-4'>Akses Ditolak!</h2>"; // Adjusted text color and size
        echo "<p class='text-slate-300 text-lg mb-4'>Anda tidak memiliki izin untuk mengakses halaman ini.</p>"; // Adjusted text color and size
        echo "<p class='mt-2'><a href='" . BASE_URL . "index.php?page=dashboard' class='text-indigo-400 hover:text-indigo-300 font-semibold transition duration-300 ease-in-out hover:underline'>Kembali ke Dashboard</a></p>"; // Adjusted text color and hover
        echo "</div>";
        break;

    case 'home':
    default:
        if (Auth::checkLogin()) {
            header('Location: ' . BASE_URL . 'index.php?page=dashboard');
            exit();
        }
        echo "<div class='text-center py-20 flex flex-col items-center justify-center min-h-[calc(100vh-16rem)] p-4'>"; // Adjusted padding and added flex for centering
        echo "<h1 class='text-5xl lg:text-6xl font-extrabold text-white leading-tight drop-shadow-lg'>Selamat Datang di <span class='text-violet-400'>SIMPRAK!</span></h1>"; // Adjusted text color, size, and added drop-shadow
        echo "<p class='text-xl lg:text-2xl text-slate-300 mt-4 max-w-2xl mx-auto'>Sistem Informasi Manajemen Praktikum berbasis web.</p>"; // Adjusted text color and size
        echo "<div class='mt-10 flex space-x-4'>"; // Increased margin-top, added flex and space
        echo "<a href='" . BASE_URL . "index.php?page=login' class='px-8 py-3 bg-indigo-600 text-white rounded-full text-lg font-bold shadow-lg hover:bg-indigo-700 transition duration-300 ease-in-out transform hover:-translate-y-0.5 border border-indigo-500'>Login</a>"; // New button styles
        echo "<a href='" . BASE_URL . "index.php?page=register' class='px-8 py-3 bg-teal-600 text-white rounded-full text-lg font-bold shadow-lg hover:bg-teal-700 transition duration-300 ease-in-out transform hover:-translate-y-0.5 border border-teal-500'>Register</a>"; // New button styles
        echo "</div>";
        echo "</div>";
        break;
}

include __DIR__ . '/../views/layouts/footer.php';