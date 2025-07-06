<main class="container mx-auto px-4 py-10">
    <section class="bg-slate-800 glassmorphism shadow-2xl rounded-2xl p-12 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-5xl font-extrabold text-white mb-6 text-center tracking-tight">DASHBOARD ASISTEN</h1>
        <p class="text-slate-300 mb-12 text-xl text-center">Selamat Datang, <span class="font-semibold text-violet-300"><?php echo htmlspecialchars(Auth::getFullName() ?? 'Asisten'); ?></span>!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
            <a href="<?php echo BASE_URL; ?>index.php?page=asisten_praktikum_management" class="group flex flex-col items-center justify-center bg-slate-700 hover:bg-slate-600 text-white p-8 rounded-2xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-2 focus:outline-none focus:ring-3 focus:ring-indigo-400 focus:ring-opacity-75 border border-slate-600">
                <div class="mb-5 text-indigo-400 group-hover:text-white transition duration-300">
                    <svg class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-white">Kelola Praktikum</h2>
                <p class="text-sm text-slate-300 opacity-90 group-hover:opacity-100 leading-relaxed">Tambah, Edit, dan Hapus Mata Praktikum.</p>
            </a>

            <a href="<?php echo BASE_URL; ?>index.php?page=asisten_praktikum_management" class="group flex flex-col items-center justify-center bg-slate-700 hover:bg-slate-600 text-white p-8 rounded-2xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-2 focus:outline-none focus:ring-3 focus:ring-violet-400 focus:ring-opacity-75 border border-slate-600">
                <div class="mb-5 text-violet-400 group-hover:text-white transition duration-300">
                    <svg class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.523 5.794 20 7.5 20s3.332-.477 4.5-1.247m0 0c1.168.777 2.794 1.247 4.5 1.247 1.706 0 3.332-.477 4.5-1.247m-4.5-13V13m-2-2l2-2m0 0l2 2m-2-2v7.5"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-white">Kelola Modul</h2>
                <p class="text-sm text-slate-300 opacity-90 group-hover:opacity-100 leading-relaxed">Atur Modul untuk Setiap Praktikum.</p>
            </a>

            <a href="<?php echo BASE_URL; ?>index.php?page=asisten_submission_list" class="group flex flex-col items-center justify-center bg-slate-700 hover:bg-slate-600 text-white p-8 rounded-2xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-2 focus:outline-none focus:ring-3 focus:ring-teal-400 focus:ring-opacity-75 border border-slate-600">
                <div class="mb-5 text-teal-400 group-hover:text-white transition duration-300">
                    <svg class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-white">Laporan Masuk</h2>
                <p class="text-sm text-slate-300 opacity-90 group-hover:opacity-100 leading-relaxed">Periksa dan Lihat Laporan Mahasiswa.</p>
            </a>
            
            <a href="<?php echo BASE_URL; ?>index.php?page=asisten_user_management" class="group flex flex-col items-center justify-center bg-slate-700 hover:bg-slate-600 text-white p-8 rounded-2xl text-center transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-2 focus:outline-none focus:ring-3 focus:ring-emerald-400 focus:ring-opacity-75 border border-slate-600">
                <div class="mb-5 text-emerald-400 group-hover:text-white transition duration-300">
                    <svg class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2h-3v3.586l-7.707-7.707a1 1 0 00-1.414 0L2 10.586V20a2 2 0 002 2h9.586a1 1 0 00.707-.293l3.414-3.414a1 1 0 00.293-.707V17z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-white">Kelola Akun Pengguna</h2>
                <p class="text-sm text-slate-300 opacity-90 group-hover:opacity-100 leading-relaxed">Atur Akun Mahasiswa dan Asisten.</p>
            </a>
        </div>
    </section>
</main>