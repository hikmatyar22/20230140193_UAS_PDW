<?php
// app/config/database.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // <<< Sesuaikan dengan password database Anda
define('DB_NAME', 'simprok'); // <<< PASTIKAN INI ADALAH 'simprok' sesuai screenshot phpMyAdmin Anda

// Path untuk menyimpan file yang diunggah
define('MATERIAL_UPLOAD_DIR', __DIR__ . '/../../public/assets/material_files/');
define('SUBMISSION_UPLOAD_DIR', __DIR__ . '/../../public/assets/submission_files/');

// URL dasar untuk akses file yang diunggah dari browser
define('BASE_URL', 'http://localhost/SIMPROK/public/'); // <<< Sesuaikan dengan NAMA FOLDER PROYEK Anda ('SIMPROK')
define('MATERIAL_URL_PATH', BASE_URL . 'assets/material_files/');
define('SUBMISSION_URL_PATH', BASE_URL . 'assets/submission_files/');