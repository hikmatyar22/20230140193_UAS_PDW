<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-7xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Detail Praktikum: "<span class="text-teal-400"><?php echo htmlspecialchars($praktikum_data['name']); ?></span>"</h1>
        
        <p class="text-slate-300 mb-6 leading-relaxed">
            <?php echo nl2br(htmlspecialchars($praktikum_data['description'])); ?>
        </p>

        <a href="<?php echo BASE_URL; ?>index.php?page=praktikum_saya"
           class="inline-flex items-center px-6 py-3 rounded-full 
                  bg-blue-600 hover:bg-blue-700 text-white 
                  transition duration-300 ease-in-out transform hover:-translate-y-1 
                  shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 
                  mb-10 text-base font-semibold"
           aria-label="Kembali ke Praktikum Saya">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Praktikum Saya
        </a>

        <h3 class="text-3xl font-bold text-white mb-6">Daftar Modul & Tugas</h3>

        <?php if (empty($modules_with_submission_status)): ?>
            <p class="text-slate-400 text-lg text-center mt-6">
                Belum ada modul yang tersedia untuk praktikum ini.
            </p>
        <?php else: ?>
            <div class="space-y-8">
                <?php foreach ($modules_with_submission_status as $module): ?>
                    <div class="border border-slate-700 rounded-lg 
                                bg-slate-700 bg-opacity-70 shadow-lg 
                                relative overflow-hidden" 
                                x-data="{ open: false }">
                        
                        <div @click="open = !open"
                             class="flex items-center justify-between p-6 
                                    cursor-pointer rounded-lg 
                                    hover:bg-slate-700 transition duration-200 ease-in-out"
                             :class="{ 'bg-slate-600': open }"> <h4 class="text-2xl font-semibold text-white">
                                <?php echo htmlspecialchars($module['module_name']); ?>
                            </h4>
                            <svg class="w-6 h-6 text-slate-300 transform transition-transform duration-200"
                                 :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>

                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-screen"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-screen"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="p-6 border-t border-slate-600 overflow-hidden">
                            
                            <div class="flex flex-col lg:flex-row lg:items-start lg:gap-8">
                                <div class="lg:w-1/2 lg:pr-4 mb-4 lg:mb-0 relative z-10">
                                    <h5 class="text-xl font-semibold text-white mb-3">Materi Modul</h5>
                                    <?php if ($module['material_file_path']): ?>
                                        <p class="text-slate-300 flex items-center mb-0">
                                            <a href="<?php echo MATERIAL_URL_PATH . basename($module['material_file_path']); ?>" target="_blank"
                                               class="inline-flex items-center 
                                                      text-violet-400 hover:text-violet-300 transition duration-200 
                                                      focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-opacity-75 
                                                      font-semibold py-2 px-4 rounded-full 
                                                      bg-slate-800 bg-opacity-40 shadow-md">
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                Unduh Materi
                                            </a>
                                        </p>
                                    <?php else: ?>
                                        <p class="text-slate-400">Materi belum tersedia.</p>
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4 pt-4 border-t border-slate-600 
                                            lg:mt-0 lg:pt-0 lg:border-t-0 lg:border-l lg:pl-8 lg:border-slate-600 
                                            lg:w-1/2 relative z-10">
                                    <h5 class="text-xl font-semibold text-white mb-3">Laporan & Nilai</h5>
                                    <?php if ($module['submission_status'] === 'submitted'): ?>
                                        <p class="text-slate-300 mb-1">Status Laporan: <span class="font-bold text-blue-400">Sudah Dikumpulkan</span></p>
                                        <p class="text-slate-300 mb-1">Tanggal Pengumpulan: <span class="font-semibold"><?php echo date('d M Y H:i', strtotime($module['submission_data']['submission_date'])); ?></span></p>
                                        <p class="text-slate-300 mb-3 flex items-center">
                                            <span class="mr-2">File Laporan:</span>
                                            <a href="<?php echo SUBMISSION_URL_PATH . basename($module['submission_data']['file_path']); ?>" target="_blank"
                                               class="inline-flex items-center 
                                                      text-violet-400 hover:text-violet-300 transition duration-200
                                                      focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-opacity-75
                                                      font-semibold py-2 px-4 rounded-full bg-slate-800 bg-opacity-40 shadow-md">
                                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                Unduh Laporan
                                            </a>
                                        </p>
                                        <?php if ($module['submission_data']['status'] === 'graded'): ?>
                                            <p class="text-slate-300 mb-1">Nilai: <span class="font-bold text-emerald-400 text-xl"><?php echo htmlspecialchars($module['submission_data']['grade']); ?></span></p>
                                            <p class="text-slate-300">Feedback: <span class="font-semibold"><?php echo nl2br(htmlspecialchars($module['submission_data']['feedback'])); ?></span></p>
                                        <?php else: ?>
                                            <p class="text-slate-300">Nilai: <span class="font-bold text-amber-400">Belum Dinilai</span></p>
                                        <?php endif; ?>

                                        <form action="<?php echo BASE_URL; ?>index.php?page=upload_submission" method="POST" enctype="multipart/form-data" 
                                              class="mt-6 p-4 border border-blue-700 rounded-lg 
                                                     bg-slate-800 bg-opacity-70 shadow-inner">
                                            <h6 class="font-semibold text-white mb-3">Perbarui Laporan (akan menimpa laporan sebelumnya)</h6>
                                            <input type="hidden" name="action" value="upload_submission">
                                            <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">
                                            <input type="hidden" name="praktikum_id" value="<?php echo $praktikum_data['id']; ?>">
                                            <input type="file" name="laporan_file" accept=".pdf,.doc,.docx,.zip,.rar"
                                                   class="block w-full text-base text-slate-300 
                                                          file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 
                                                          file:text-sm file:font-semibold file:bg-violet-600 file:text-white 
                                                          hover:file:bg-violet-700 transition duration-300 cursor-pointer 
                                                          focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-opacity-75" required>
                                            <button type="submit"
                                                    class="mt-4 bg-indigo-600 hover:bg-indigo-700 text-white 
                                                           font-bold py-3 px-6 rounded-full transition duration-300 
                                                           shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                                Perbarui Laporan
                                            </button>
                                        </form>

                                    <?php else: ?>
                                        <p class="text-slate-300 mb-3">Status Laporan: <span class="font-bold text-red-400">Belum Dikumpulkan</span></p>
                                        <form action="<?php echo BASE_URL; ?>index.php?page=upload_submission" method="POST" enctype="multipart/form-data" 
                                              class="mt-6 p-4 border border-green-700 rounded-lg 
                                                     bg-slate-800 bg-opacity-70 shadow-inner">
                                            <input type="hidden" name="action" value="upload_submission">
                                            <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">
                                            <input type="hidden" name="praktikum_id" value="<?php echo $praktikum_data['id']; ?>">
                                            <input type="file" name="laporan_file" accept=".pdf,.doc,.docx,.zip,.rar"
                                                   class="block w-full text-base text-slate-300 
                                                          file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 
                                                          file:text-sm file:font-semibold file:bg-emerald-600 file:text-white 
                                                          hover:file:bg-emerald-700 transition duration-300 cursor-pointer 
                                                          focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:ring-opacity-75" required>
                                            <button type="submit"
                                                    class="mt-4 bg-green-600 hover:bg-green-700 text-white 
                                                           font-bold py-3 px-6 rounded-full transition duration-300 
                                                           shadow-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                                Kumpulkan Laporan
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
</main>