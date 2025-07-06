<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-5xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Beri Nilai Laporan</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=asisten_submission_list"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Daftar Laporan Masuk">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Laporan Masuk
        </a>

        <?php if (empty($submission_data)): ?>
            <p class="text-red-400 text-xl mt-6 text-center">Laporan tidak ditemukan.</p>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div class="border border-slate-700 p-8 rounded-lg bg-slate-700 bg-opacity-60 shadow-lg">
                    <h2 class="text-2xl font-semibold text-white mb-6 pb-4 border-b border-slate-600">Detail Laporan</h2>
                    <dl class="space-y-4 text-base">
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Mahasiswa:</dt>
                            <dd class="text-slate-200"><?php echo htmlspecialchars($submission_data['student_name']); ?> (NIM: <?php echo htmlspecialchars($submission_data['nim']); ?>)</dd>
                        </div>
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Praktikum:</dt>
                            <dd class="text-slate-200"><?php echo htmlspecialchars($submission_data['praktikum_name']); ?></dd>
                        </div>
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Modul:</dt>
                            <dd class="text-slate-200"><?php echo htmlspecialchars($submission_data['module_name']); ?></dd>
                        </div>
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Tanggal Kumpul:</dt>
                            <dd class="text-slate-200"><?php echo date('d M Y H:i', strtotime($submission_data['submission_date'])); ?></dd>
                        </div>
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Status:</dt>
                            <dd class="text-slate-200">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold <?php echo ($submission_data['status'] === 'graded') ? 'bg-emerald-700 text-emerald-100' : 'bg-amber-700 text-amber-100'; ?>">
                                    <?php echo ($submission_data['status'] === 'graded') ? 'Dinilai' : 'Belum Dinilai'; ?>
                                </span>
                            </dd>
                        </div>
                        <?php if ($submission_data['grade'] !== null): ?>
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Nilai Diberikan:</dt>
                            <dd class="text-slate-200 text-xl font-bold"><?php echo htmlspecialchars($submission_data['grade']); ?></dd>
                        </div>
                        <?php endif; ?>
                        <?php if ($submission_data['feedback']): ?>
                        <div>
                            <dt class="font-medium text-slate-100 mb-1">Feedback:</dt>
                            <dd class="text-slate-200 leading-relaxed"><?php echo nl2br(htmlspecialchars($submission_data['feedback'])); ?></dd>
                        </div>
                        <?php endif; ?>
                        <div class="pt-4">
                            <dt class="font-medium text-slate-100 sr-only">File Laporan:</dt>
                            <dd>
                                <a href="<?php echo SUBMISSION_URL_PATH . basename($submission_data['file_path']); ?>" target="_blank"
                                   class="inline-flex items-center justify-center px-6 py-3 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75 text-base font-semibold">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Unduh Laporan (<?php echo htmlspecialchars(basename($submission_data['file_path'])); ?>)
                                </a>
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="border border-slate-700 p-8 rounded-lg bg-slate-700 bg-opacity-60 shadow-lg">
                    <h2 class="text-2xl font-semibold text-white mb-6 pb-4 border-b border-slate-600">Form Penilaian</h2>
                    <form action="<?php echo BASE_URL; ?>index.php?page=asisten_grade_submission&id=<?php echo $submission_data['id']; ?>" method="POST" class="space-y-6">
                        <div>
                            <label for="grade" class="block text-slate-200 text-base font-bold mb-2">Nilai (0-100):</label>
                            <input type="number" name="grade" id="grade" min="0" max="100"
                                   class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 text-xl font-bold"
                                   value="<?php echo htmlspecialchars($submission_data['grade'] ?? ''); ?>" required aria-label="Input nilai laporan">
                        </div>
                        <div>
                            <label for="feedback" class="block text-slate-200 text-base font-bold mb-2">Feedback:</label>
                            <textarea name="feedback" id="feedback" rows="8"
                                      class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                      placeholder="Berikan feedback untuk laporan ini..." aria-label="Input feedback laporan"><?php echo htmlspecialchars($submission_data['feedback'] ?? ''); ?></textarea>
                        </div>
                        <div class="pt-4">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg w-full">
                                Simpan Nilai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    </section>
</main>