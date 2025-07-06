<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPRAK</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
        }

        /* Hapus atau nonaktifkan aturan dropdown lama jika tidak lagi digunakan */
        /* .dropdown-menu { display: none; } */
        /* .dropdown-item { ... } */
    </style>
</head>
<body class="bg-grid-pattern">
    <nav class="bg-slate-900 bg-opacity-70 glassmorphism p-4 text-white shadow-xl border-b border-slate-700 fixed w-full z-50 top-0">
        <div class="container mx-auto flex justify-between items-center">
            <a href="<?php echo BASE_URL; ?>index.php?page=home" class="text-3xl lg:text-4xl font-extrabold text-violet-500 hover:text-violet-400 transition duration-300 ease-in-out transform hover:scale-105 tracking-wide">SIMPRAK</a>
            <div class="flex items-center space-x-4 sm:space-x-6">
                <?php if (Auth::checkLogin()): ?>
                    <?php if (Auth::getUserRole() === 'asisten'): ?>
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="px-5 py-2 sm:px-6 sm:py-2.5 rounded-full bg-slate-700 hover:bg-slate-600 text-white font-bold transition duration-300 ease-in-out shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-opacity-50 text-sm sm:text-base">
                                Profil Asisten <span class="ml-2">&#9660;</span>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-slate-800 rounded-lg shadow-xl py-2 border border-slate-700 z-10">
                                <span class="block px-4 py-2 text-slate-300 font-semibold text-sm border-b border-slate-700 mb-2 pb-2">
                                    Halo, <?php echo htmlspecialchars(Auth::getFullName() ?? 'Asisten'); ?>
                                </span>
                                <a href="<?php echo BASE_URL; ?>index.php?page=logout" class="block px-4 py-2 text-red-400 hover:bg-slate-700 hover:text-red-300 transition duration-200 text-sm">
                                    Logout
                                </a>
                            </div>
                        </div>
                    <?php elseif (Auth::getUserRole() === 'mahasiswa'): ?>
                        <div class="relative group" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" class="px-5 py-2 sm:px-6 sm:py-2.5 rounded-full bg-slate-700 hover:bg-slate-600 text-white font-bold transition duration-300 ease-in-out shadow-md hover:shadow-lg transform hover:-translate-y-0.5 border border-slate-600 focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-opacity-50 text-sm sm:text-base">
                                Profil Mahasiswa <span class="ml-2">&#9660;</span>
                            </button>
                            <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                class="absolute right-0 mt-2 w-48 bg-slate-800 rounded-lg shadow-xl py-2 border border-slate-700 z-10">
                                <?php include __DIR__ . '/navbar_mahasiswa.php'; // File ini harus hanya berisi nama & logout ?>
                            </div>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo BASE_URL; ?>index.php?page=logout" class="px-5 py-2 sm:px-6 sm:py-2.5 rounded-full bg-red-600 hover:bg-red-700 text-white font-bold transition duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 border border-red-500 text-sm sm:text-base">Logout</a>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo BASE_URL; ?>index.php?page=login" class="px-5 py-2 sm:px-6 sm:py-2.5 rounded-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold transition duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 border border-indigo-500 text-sm sm:text-base">Login</a>
                    <a href="<?php echo BASE_URL; ?>index.php?page=register" class="px-5 py-2 sm:px-6 sm:py-2.5 rounded-full bg-teal-600 hover:bg-teal-700 text-white font-bold transition duration-300 ease-in-out shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 border border-teal-500 text-sm sm:text-base">Register</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="pt-20">
        <main class="flex-grow flex flex-col items-center justify-center p-4">
            <?php
            if (isset($_SESSION['success_message'])) {
                echo '<div class="bg-green-700 bg-opacity-80 border border-green-500 text-white px-6 py-4 rounded-lg relative mb-6 shadow-xl text-lg animate-pulse-glow w-full max-w-md mx-auto text-center" role="alert">' . htmlspecialchars($_SESSION['success_message']) . '</div>';
                unset($_SESSION['success_message']);
            }
            if (isset($_SESSION['error_message'])) {
                echo '<div class="bg-red-700 bg-opacity-80 border border-red-500 text-white px-6 py-4 rounded-lg relative mb-6 shadow-xl text-lg animate-pulse-glow w-full max-w-md mx-auto text-center" role="alert">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
                unset($_SESSION['error_message']);
            }
            ?>