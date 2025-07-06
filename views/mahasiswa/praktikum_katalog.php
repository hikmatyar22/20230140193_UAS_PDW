<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Daftar Mata Praktikum</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=dashboard"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700
                  transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg
                  focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Dashboard">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <?php if (empty($praktikums)): ?>
            <p class="text-slate-400 text-lg text-center mt-6 mb-6">Belum ada mata praktikum yang tersedia saat ini.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php foreach ($praktikums as $praktikum): ?>
                    <div class="group relative block p-8 rounded-2xl bg-gradient-to-br from-slate-800 to-slate-900 overflow-hidden
                                shadow-xl hover:shadow-2xl transform hover:-translate-y-2 transition-all duration-300 ease-in-out
                                border border-slate-700 hover:border-violet-600 focus:outline-none focus:ring-4 focus:ring-violet-500 focus:ring-opacity-75
                                flex flex-col h-full justify-between text-white cursor-default"
                                id="praktikum_card_<?php echo $praktikum['id']; ?>">

                        <div class="absolute inset-0 bg-violet-900 opacity-0 group-hover:opacity-15 transition-opacity duration-300 transform group-hover:scale-105"></div>

                        <div class="absolute top-4 right-4 text-violet-700 opacity-20 group-hover:opacity-50 transition-opacity duration-300 transform group-hover:rotate-12">
                            <svg class="w-24 h-24" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.523 5.794 20 7.5 20s3.332-.477 4.5-1.247m0 0c1.168.777 2.794 1.247 4.5 1.247 1.706 0 3.332-.477 4.5-1.247m-4.5-13V13m-2-2l2-2m0 0l2 2m-2-2v7.5"></path></svg>
                        </div>

                        <div class="relative z-10 flex flex-col h-full">
                            <h3 class="text-3xl font-extrabold mb-2 leading-tight group-hover:text-violet-300 transition-colors duration-300">
                                <?php echo htmlspecialchars($praktikum['name']); ?>
                            </h3>
                            <p class="text-slate-300 text-sm mb-4 leading-relaxed group-hover:text-slate-200 transition-colors duration-300 line-clamp-3 flex-grow">
                                <?php echo nl2br(htmlspecialchars($praktikum['description'])); ?>
                            </p>
                        </div>

                        <div class="mt-auto pt-4 border-t border-slate-700 relative z-10" id="action_section_<?php echo $praktikum['id']; ?>">
                            <?php
                            $user_id = Auth::getUserId();
                            $is_registered = $studentPraktikumModel->isAlreadyRegistered($user_id, $praktikum['id']);
                            ?>
                            <?php if ($is_registered): ?>
                                <button type="button" class="w-full text-center py-2.5 px-4 rounded-full font-bold cursor-not-allowed
                                                               bg-gray-500 text-white transition duration-300 shadow-md">
                                    Sudah Terdaftar
                                </button>
                            <?php else: ?>
                                <button type="submit" form="registerForm_<?php echo $praktikum['id']; ?>"
                                        class="w-full text-center py-2.5 px-4 rounded-full font-bold
                                               bg-green-600 hover:bg-green-700 text-white transition duration-300 shadow-md
                                               hover:shadow-lg transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                                    Daftar Praktikum
                                </button>
                                <form id="registerForm_<?php echo $praktikum['id']; ?>" action="<?php echo BASE_URL; ?>index.php?page=praktikum_daftar" method="POST" class="hidden">
                                    <input type="hidden" name="praktikum_id" value="<?php echo $praktikum['id']; ?>">
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>

<script>
    // Tidak ada lagi fungsi handleRegister() atau showGlobalMessage() di sini.
    // Pesan success/error akan ditampilkan oleh PHP melalui mekanisme session dan redirect.
</script>