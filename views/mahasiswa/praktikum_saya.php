<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Praktikum Saya</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=dashboard"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700
                  transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg
                  focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Dashboard">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <?php if (empty($my_praktikums)): ?>
            <p class="text-slate-400 text-lg text-center mt-6 mb-6">Anda belum mengikuti mata praktikum apapun.</p>
            <div class="text-center">
                <a href="<?php echo BASE_URL; ?>index.php?page=praktikum_katalog"
                   class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700
                          transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg
                          focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75
                          text-base font-semibold">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    Cari Praktikum
                </a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($my_praktikums as $praktikum): ?>
                    <a href="<?php echo BASE_URL; ?>index.php?page=praktikum_detail&id=<?php echo $praktikum['praktikum_id']; ?>"
                       class="group relative block p-8 rounded-xl bg-gradient-to-br from-slate-700 to-slate-800 overflow-hidden
                              shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 ease-in-out
                              border border-slate-700 hover:border-violet-500 focus:outline-none focus:ring-4 focus:ring-violet-400 focus:ring-opacity-75
                              flex flex-col h-full justify-between"> <div class="absolute inset-0 bg-violet-900 opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-800 to-transparent opacity-80 z-0"></div>


                        <div class="mb-4 text-violet-400 group-hover:text-white transition-colors duration-300 relative z-10">
                            <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.523 5.794 20 7.5 20s3.332-.477 4.5-1.247m0 0c1.168.777 2.794 1.247 4.5 1.247 1.706 0 3.332-.477 4.5-1.247m-4.5-13V13m-2-2l2-2m0 0l2 2m-2-2v7.5"></path></svg>
                        </div>

                        <div class="relative z-10">
                            <h3 class="text-3xl font-extrabold text-white mb-2 text-center leading-tight"><?php echo htmlspecialchars($praktikum['praktikum_name']); ?></h3>
                            <p class="text-slate-300 text-sm mb-4 text-center leading-relaxed group-hover:text-slate-200 transition-colors duration-300 line-clamp-4">
                                <?php echo nl2br(htmlspecialchars($praktikum['description'])); ?>
                            </p>
                        </div>

                        <div class="mt-auto pt-4 border-t border-slate-600 relative z-10">
                            <span class="block text-center text-violet-400 group-hover:text-white font-bold transition-colors duration-300 ease-in-out">
                                Lihat Detail & Tugas <span class="ml-1 inline-block transform group-hover:translate-x-1 transition-transform duration-300">&#8594;</span>
                            </span>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>