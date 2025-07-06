<?php
// app/controllers/PraktikumController.php

require_once __DIR__ . '/../models/Praktikum.php';
require_once __DIR__ . '/../models/Module.php';
require_once __DIR__ . '/../models/StudentPraktikum.php';
require_once __DIR__ . '/../models/Submission.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../core/Helper.php';

class PraktikumController {
    private $praktikumModel;
    private $moduleModel;
    private $studentPraktikumModel;
    private $submissionModel;
    private $userModel;

    public function __construct() {
        $this->praktikumModel = new Praktikum();
        $this->moduleModel = new Module();
        $this->studentPraktikumModel = new StudentPraktikum();
        $this->submissionModel = new Submission();
        $this->userModel = new User();
    }

    // --- Mahasiswa Functions ---
    public function showKatalog() {
        Auth::requireLogin();
        $praktikums = $this->praktikumModel->getAllPraktikums();
        $studentPraktikumModel = $this->studentPraktikumModel;
        include __DIR__ . '/../../views/mahasiswa/praktikum_katalog.php';
    }

    public function registerToPraktikum() {
        Auth::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['praktikum_id'])) {
            $praktikum_id = $_POST['praktikum_id'];
            $user_id = Auth::getUserId();

            if ($this->studentPraktikumModel->isAlreadyRegistered($user_id, $praktikum_id)) {
                $_SESSION['error_message'] = "Anda sudah terdaftar di praktikum ini.";
            } elseif ($this->studentPraktikumModel->registerStudentToPraktikum($user_id, $praktikum_id)) {
                $_SESSION['success_message'] = "Berhasil mendaftar ke praktikum!";
            } else {
                $_SESSION['error_message'] = "Gagal mendaftar ke praktikum.";
            }
        }
        header('Location: ' . BASE_URL . 'index.php?page=praktikum_katalog');
        exit();
    }

    public function showMyPraktikums() {
        Auth::requireLogin();
        $user_id = Auth::getUserId();
        $my_praktikums = $this->studentPraktikumModel->getPraktikumsByUserId($user_id);
        include __DIR__ . '/../../views/mahasiswa/praktikum_saya.php';
    }

    public function showPraktikumDetail() {
        Auth::requireLogin();
        $user_id = Auth::getUserId();
        $praktikum_id = $_GET['id'] ?? null;

        if (!$praktikum_id || !$this->studentPraktikumModel->isStudentRegisteredToPraktikum($user_id, $praktikum_id)) {
            $_SESSION['error_message'] = "Akses tidak diizinkan atau praktikum tidak ditemukan.";
            header('Location: ' . BASE_URL . 'index.php?page=praktikum_saya');
            exit();
        }

        $praktikum_data = $this->praktikumModel->getPraktikumById($praktikum_id);
        $modules = $this->moduleModel->getModulesByPraktikumId($praktikum_id);
        $submissions = $this->submissionModel->getSubmissionsByUserIdAndPraktikumId($user_id, $praktikum_id);

        $modules_with_submission_status = [];
        foreach ($modules as $module) {
            $module_id = $module['id'];
            $submission_status = null;
            $submission_data = null;
            foreach ($submissions as $submission) {
                if ($submission['module_id'] == $module_id) {
                    $submission_status = 'submitted';
                    $submission_data = $submission;
                    break;
                }
            }
            $modules_with_submission_status[] = array_merge($module, [
                'submission_status' => $submission_status,
                'submission_data' => $submission_data
            ]);
        }

        include __DIR__ . '/../../views/mahasiswa/praktikum_detail.php';
    }

    public function uploadSubmission() {
        Auth::requireLogin();
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_submission') {
            $module_id = $_POST['module_id'] ?? null;
            $praktikum_id = $_POST['praktikum_id'] ?? null;
            $user_id = Auth::getUserId();

            if (!$module_id || !$praktikum_id) {
                $_SESSION['error_message'] = "Data tidak lengkap untuk mengunggah laporan.";
                header('Location: ' . BASE_URL . 'index.php?page=praktikum_saya');
                exit();
            }

            if (isset($_FILES['laporan_file']) && $_FILES['laporan_file']['error'] === UPLOAD_ERR_OK) {
                $upload_result = Helper::handleFileUpload($_FILES['laporan_file'], SUBMISSION_UPLOAD_DIR, 'submission_');

                if ($upload_result['success']) {
                    $target_file = $upload_result['file_path'];
                    $existing_submission = $this->submissionModel->getSubmissionByUserIdAndModuleId($user_id, $module_id);

                    if ($existing_submission) {
                        if ($existing_submission['file_path'] && file_exists($existing_submission['file_path'])) {
                            unlink($existing_submission['file_path']);
                        }
                        if ($this->submissionModel->updateSubmissionFile($existing_submission['id'], $target_file)) {
                            $_SESSION['success_message'] = "Laporan berhasil diperbarui.";
                        } else {
                            $_SESSION['error_message'] = "Gagal memperbarui laporan di database.";
                        }
                    } else {
                        if ($this->submissionModel->createSubmission($user_id, $module_id, $target_file)) {
                            $_SESSION['success_message'] = "Laporan berhasil diunggah.";
                        } else {
                            $_SESSION['error_message'] = "Gagal menyimpan laporan di database.";
                        }
                    }
                } else {
                    $_SESSION['error_message'] = $upload_result['message'];
                }
            } else {
                $_SESSION['error_message'] = "Silakan pilih file laporan yang valid.";
            }
            header('Location: ' . BASE_URL . 'index.php?page=praktikum_detail&id=' . $praktikum_id);
            exit();
        }
        header('Location: ' . BASE_URL . 'index.php?page=praktikum_saya');
        exit();
    }


    // --- Asisten Functions ---
    public function managePraktikums() {
        Auth::requireRole('asisten');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $praktikum_id = $_POST['praktikum_id'] ?? null;
            // PENTING: Pastikan nama input HTML sesuai di sini
            $name = $_POST['praktikum_name'] ?? ''; // Mengambil dari 'praktikum_name'
            $description = $_POST['description'] ?? '';

            // PENTING: Pastikan nama action HTML sesuai di sini
            if ($action === 'create_praktikum') {
                if ($this->praktikumModel->createPraktikum($name, $description)) {
                    $_SESSION['success_message'] = "Mata praktikum berhasil ditambahkan.";
                } else {
                    $_SESSION['error_message'] = "Gagal menambahkan mata praktikum.";
                }
            } elseif ($action === 'update_praktikum' && $praktikum_id) {
                if ($this->praktikumModel->updatePraktikum($praktikum_id, $name, $description)) {
                    $_SESSION['success_message'] = "Mata praktikum berhasil diperbarui.";
                } else {
                    $_SESSION['error_message'] = "Gagal memperbarui mata praktikum.";
                }
            } elseif ($action === 'delete_praktikum' && $praktikum_id) { // Menyesuaikan nama action jika diperlukan
                if ($this->praktikumModel->deletePraktikum($praktikum_id)) {
                    $_SESSION['success_message'] = "Mata praktikum berhasil dihapus.";
                } else {
                    $_SESSION['error_message'] = "Gagal menghapus mata praktikum. Pastikan tidak ada modul atau pendaftaran terkait.";
                }
            }
            header('Location: ' . BASE_URL . 'index.php?page=asisten_praktikum_management');
            exit();
        }

        $praktikums = $this->praktikumModel->getAllPraktikums();
        include __DIR__ . '/../../views/asisten/praktikum_management.php';
    }

    public function manageModules() {
        Auth::requireRole('asisten');
        $praktikum_id = $_GET['praktikum_id'] ?? null;

        // Logika redirect yang menyebabkan Anda kembali ke Kelola Praktikum
        if (!$praktikum_id) {
            $_SESSION['error_message'] = "Silakan pilih mata praktikum terlebih dahulu.";
            header('Location: ' . BASE_URL . 'index.php?page=asisten_praktikum_management');
            exit();
        }

        $praktikum_data = $this->praktikumModel->getPraktikumById($praktikum_id);
        // Logika redirect jika praktikum tidak ditemukan
        if (!$praktikum_data) {
            $_SESSION['error_message'] = "Praktikum tidak ditemukan.";
            header('Location: ' . BASE_URL . 'index.php?page=asisten_praktikum_management');
            exit();
        }
        $modules = $this->moduleModel->getModulesByPraktikumId($praktikum_id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $module_id = $_POST['module_id'] ?? null;
            $module_name = $_POST['module_name'] ?? '';

            if ($action === 'create_module') {
                $material_file_path = null;
                if (isset($_FILES['material_file']) && $_FILES['material_file']['error'] === UPLOAD_ERR_OK) {
                    $upload_result = Helper::handleFileUpload($_FILES['material_file'], MATERIAL_UPLOAD_DIR, 'material_');
                    if ($upload_result['success']) {
                        $material_file_path = $upload_result['file_path'];
                    } else {
                        $_SESSION['error_message'] = $upload_result['message'];
                        header('Location: ' . BASE_URL . 'index.php?page=asisten_module_management&praktikum_id=' . $praktikum_id);
                        exit();
                    }
                }
                if ($this->moduleModel->createModule($praktikum_id, $module_name, $material_file_path)) {
                    $_SESSION['success_message'] = "Modul berhasil ditambahkan.";
                } else {
                    $_SESSION['error_message'] = "Gagal menambahkan modul.";
                }
            } elseif ($action === 'update_module' && $module_id) {
                $current_module = $this->moduleModel->getModuleById($module_id);
                $material_file_path = $current_module['material_file_path'];

                if (isset($_FILES['material_file']) && $_FILES['material_file']['error'] === UPLOAD_ERR_OK) {
                    $upload_result = Helper::handleFileUpload($_FILES['material_file'], MATERIAL_UPLOAD_DIR, 'material_');
                    if ($upload_result['success']) {
                        // Hapus file lama jika ada
                        if ($material_file_path && file_exists($material_file_path)) {
                            unlink($material_file_path);
                        }
                        $material_file_path = $upload_result['file_path'];
                    } else {
                        $_SESSION['error_message'] = $upload_result['message'];
                        header('Location: ' . BASE_URL . 'index.php?page=asisten_module_management&praktikum_id=' . $praktikum_id);
                        exit();
                    }
                }

                if ($this->moduleModel->updateModule($module_id, $module_name, $material_file_path)) {
                    $_SESSION['success_message'] = "Modul berhasil diperbarui.";
                } else {
                    $_SESSION['error_message'] = "Gagal memperbarui modul.";
                }
            } elseif ($action === 'delete_module' && $module_id) {
                $module_to_delete = $this->moduleModel->getModuleById($module_id);
                if ($module_to_delete && $module_to_delete['material_file_path'] && file_exists($module_to_delete['material_file_path'])) {
                    unlink($module_to_delete['material_file_path']);
                }

                if ($this->moduleModel->deleteModule($module_id)) {
                    $_SESSION['success_message'] = "Modul berhasil dihapus.";
                } else {
                    $_SESSION['error_message'] = "Gagal menghapus modul. Pastikan tidak ada laporan terkait.";
                }
            }
            header('Location: ' . BASE_URL . 'index.php?page=asisten_module_management&praktikum_id=' . $praktikum_id);
            exit();
        }

        include __DIR__ . '/../../views/asisten/module_management.php';
    }

    public function showSubmissionList() {
        Auth::requireRole('asisten');

        $filter_module_id = $_GET['module_id'] ?? null;
        $filter_user_id = $_GET['user_id'] ?? null;
        $filter_status = $_GET['status'] ?? null;

        $submissions = $this->submissionModel->getFilteredSubmissions($filter_module_id, $filter_user_id, $filter_status);

        $all_modules = $this->moduleModel->getAllModules();
        $all_students = $this->userModel->getUsersByRole('mahasiswa');

        include __DIR__ . '/../../views/asisten/submission_list.php';
    }

    public function gradeSubmission() {
        Auth::requireRole('asisten');
        $submission_id = $_GET['id'] ?? null;

        if (!$submission_id) {
            $_SESSION['error_message'] = "ID Laporan tidak ditemukan.";
            header('Location: ' . BASE_URL . 'index.php?page=asisten_submission_list');
            exit();
        }

        $submission_data = $this->submissionModel->getSubmissionById($submission_id);

        if (!$submission_data) {
            $_SESSION['error_message'] = "Laporan tidak ditemukan.";
            header('Location: ' . BASE_URL . 'index.php?page=asisten_submission_list');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $grade = $_POST['grade'] ?? null;
            $feedback = $_POST['feedback'] ?? null;

            if ($this->submissionModel->gradeSubmission($submission_id, $grade, $feedback)) {
                $_SESSION['success_message'] = "Nilai dan feedback berhasil disimpan.";
                header('Location: ' . BASE_URL . 'index.php?page=asisten_submission_list');
                exit();
            } else {
                $_SESSION['error_message'] = "Gagal menyimpan nilai dan feedback.";
            }
        }

        include __DIR__ . '/../../views/asisten/grade_submission.php';
    }

    public function manageUsers() {
        Auth::requireRole('asisten');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';
            $user_id_to_manage = $_POST['user_id'] ?? null;
            $username = $_POST['username'] ?? '';
            $full_name = $_POST['full_name'] ?? '';
            $role = $_POST['role'] ?? '';
            $nim = ($role === 'mahasiswa') ? ($_POST['nim'] ?? null) : null;
            $password = $_POST['password'] ?? null;

            if ($action === 'create_user') {
                if (empty($username) || empty($full_name) || empty($role) || empty($password)) {
                    $_SESSION['error_message'] = "Username, Nama Lengkap, Peran, dan Password wajib diisi.";
                } elseif ($this->userModel->findByUsername($username)) {
                    $_SESSION['error_message'] = "Username sudah terdaftar.";
                } else {
                    if ($this->userModel->register($username, $password, $full_name, $role, $nim)) {
                        $_SESSION['success_message'] = "Pengguna berhasil ditambahkan.";
                    } else {
                        $_SESSION['error_message'] = "Gagal menambahkan pengguna.";
                    }
                }
            } elseif ($action === 'update_user' && $user_id_to_manage) {
                $new_password = !empty($password) ? $password : null;
                if ($this->userModel->updateUser($user_id_to_manage, $username, $full_name, $role, $nim, $new_password)) {
                    $_SESSION['success_message'] = "Pengguna berhasil diperbarui.";
                } else {
                    $_SESSION['error_message'] = "Gagal memperbarui pengguna.";
                }
            } elseif ($action === 'delete_user' && $user_id_to_manage) {
                if ($user_id_to_manage == Auth::getUserId()) {
                    $_SESSION['error_message'] = "Anda tidak bisa menghapus akun Anda sendiri.";
                } elseif ($this->userModel->deleteUser($user_id_to_manage)) {
                    $_SESSION['success_message'] = "Pengguna berhasil dihapus.";
                } else {
                    $_SESSION['error_message'] = "Gagal menghapus pengguna. Pastikan tidak ada data terkait.";
                }
            }
            header('Location: ' . BASE_URL . 'index.php?page=asisten_user_management');
            exit();
        }

        $all_users = $this->userModel->getAllUsers();
        include __DIR__ . '/../../views/asisten/user_management.php';
    }
}