<main class="container mx-auto px-4 py-10">
    <section class="bg-slate-800 glassmorphism shadow-2xl rounded-2xl p-12 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-5xl font-extrabold text-white mb-6 text-center tracking-tight">DASHBOARD MAHASISWA</h1>
        <p class="text-slate-300 mb-12 text-xl text-center">Selamat Datang, <span class="font-semibold text-violet-300"><?php echo htmlspecialchars(Auth::getFullName() ?? 'Mahasiswa'); ?></span>!</p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-8">
            <a href="<?php echo BASE_URL; ?>index.php?page=praktikum_katalog" 
               class="group flex flex-col items-center justify-center 
                      bg-slate-700 hover:bg-slate-600 text-white p-8 rounded-2xl text-center 
                      transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-2 
                      focus:outline-none focus:ring-3 focus:ring-indigo-400 focus:ring-opacity-75 
                      border border-slate-600">
                <div class="mb-5 text-indigo-400 group-hover:text-white transition duration-300">
                    <svg class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-white">Cari Praktikum</h2>
                <p class="text-sm text-slate-300 opacity-90 group-hover:opacity-100 leading-relaxed">Temukan dan Daftar Praktikum Baru.</p>
            </a>

            <a href="<?php echo BASE_URL; ?>index.php?page=praktikum_saya" 
               class="group flex flex-col items-center justify-center 
                      bg-slate-700 hover:bg-slate-600 text-white p-8 rounded-2xl text-center 
                      transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-2 
                      focus:outline-none focus:ring-3 focus:ring-green-400 focus:ring-opacity-75 
                      border border-slate-600">
                <div class="mb-5 text-green-400 group-hover:text-white transition duration-300">
                    <svg class="w-14 h-14 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
                <h2 class="text-3xl font-bold mb-2 text-white">Praktikum Saya</h2>
                <p class="text-sm text-slate-300 opacity-90 group-hover:opacity-100 leading-relaxed">Lihat Daftar Praktikum yang Anda Ikuti.</p>
            </a>
            </div>
    </section>
</main>