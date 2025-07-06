<?php
// app/core/Helper.php

class Helper {
    public static function handleFileUpload($file_input, $target_directory, $prefix = '') {
        $result = ['success' => false, 'message' => '', 'file_path' => null];

        if (!is_dir($target_directory)) {
            if (!mkdir($target_directory, 0777, true)) {
                $result['message'] = "Gagal membuat direktori upload: " . $target_directory;
                return $result;
            }
        }
        if (!is_writable($target_directory)) {
            $result['message'] = "Direktori upload tidak dapat ditulisi: " . $target_directory;
            return $result;
        }

        if ($file_input['error'] !== UPLOAD_ERR_OK) {
            $result['message'] = "Terjadi kesalahan saat upload file: Kode error " . $file_input['error'];
            return $result;
        }

        $file_tmp_name = $file_input['tmp_name'];
        $file_original_name = basename($file_input['name']);
        $file_extension = pathinfo($file_original_name, PATHINFO_EXTENSION);

        $allowed_types = ['pdf', 'doc', 'docx', 'zip', 'rar', 'jpg', 'jpeg', 'png', 'ppt', 'pptx', 'xls', 'xlsx']; // Tambah tipe file yang diizinkan
        if (!in_array(strtolower($file_extension), $allowed_types)) {
            $result['message'] = "Tipe file tidak diizinkan. Hanya PDF, DOC, DOCX, PPT, PPTX, XLS, XLSX, ZIP, RAR, JPG, JPEG, PNG yang diperbolehkan.";
            return $result;
        }

        $new_file_name = $prefix . uniqid() . '.' . $file_extension;
        $target_file = $target_directory . $new_file_name;

        if (move_uploaded_file($file_tmp_name, $target_file)) {
            $result['success'] = true;
            $result['file_path'] = $target_file;
            $result['message'] = "File berhasil diunggah.";
        } else {
            $result['message'] = "Gagal memindahkan file yang diunggah.";
        }

        return $result;
    }
}