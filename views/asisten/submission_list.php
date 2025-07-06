<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-7xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Daftar Laporan Masuk</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=dashboard"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Dashboard">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="mb-12 p-8 border border-slate-700 rounded-lg bg-slate-700 bg-opacity-60 shadow-lg">
            <h2 class="text-2xl font-semibold text-white mb-6 pb-4 border-b border-slate-600">Filter Laporan</h2>
            <form action="<?php echo BASE_URL; ?>index.php?page=asisten_submission_list" method="GET" class="space-y-6">
                <input type="hidden" name="page" value="asisten_submission_list">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="module_id" class="block text-slate-200 text-base font-bold mb-2">Filter Modul:</label>
                        <select name="module_id" id="module_id"
                                class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                aria-label="Filter berdasarkan modul">
                            <option value="">Semua Modul</option>
                            <?php foreach ($all_modules as $module): ?>
                                <option value="<?php echo $module['id']; ?>" <?php echo (isset($_GET['module_id']) && $_GET['module_id'] == $module['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($module['praktikum_name'] . ' - ' . $module['module_name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="user_id" class="block text-slate-200 text-base font-bold mb-2">Filter Mahasiswa:</label>
                        <select name="user_id" id="user_id"
                                class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                aria-label="Filter berdasarkan mahasiswa">
                            <option value="">Semua Mahasiswa</option>
                            <?php foreach ($all_students as $student): ?>
                                <option value="<?php echo $student['id']; ?>" <?php echo (isset($_GET['user_id']) && $_GET['user_id'] == $student['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($student['full_name'] . ' (' . $student['nim'] . ')'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label for="status" class="block text-slate-200 text-base font-bold mb-2">Filter Status:</label>
                        <select name="status" id="status"
                                class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                aria-label="Filter berdasarkan status">
                            <option value="">Semua Status</option>
                            <option value="submitted" <?php echo (isset($_GET['status']) && $_GET['status'] == 'submitted') ? 'selected' : ''; ?>>Belum Dinilai</option>
                            <option value="graded" <?php echo (isset($_GET['status']) && $_GET['status'] == 'graded') ? 'selected' : ''; ?>>Sudah Dinilai</option>
                        </select>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-start space-y-4 sm:space-y-0 sm:space-x-5 pt-4">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg w-full sm:w-auto">
                        Terapkan Filter
                    </button>
                    <a href="<?php echo BASE_URL; ?>index.php?page=asisten_submission_list"
                       class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-3.5 px-8 rounded-full transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-md focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-opacity-75 w-full sm:w-auto">
                        Reset Filter
                    </a>
                </div>
            </form>
        </div>

        <h2 class="text-3xl font-bold text-white mb-6">Daftar Laporan</h2>
        <?php if (empty($submissions)): ?>
            <p class="text-slate-400 text-lg text-center mt-6">Tidak ada laporan yang ditemukan dengan filter yang dipilih.</p>
        <?php else: ?>
            <div class="overflow-x-auto rounded-lg border border-slate-700 shadow-lg">
                <table class="min-w-full bg-slate-800">
                    <thead class="bg-slate-700">
                        <tr class="text-slate-300 uppercase text-sm leading-normal">
                            <th class="py-4 px-6 text-left border-b border-slate-600">Mahasiswa</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">Praktikum</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">Modul</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">Tanggal Kumpul</th>
                            <th class="py-4 px-6 text-center border-b border-slate-600">Status</th>
                            <th class="py-4 px-6 text-center border-b border-slate-600">Nilai</th>
                            <th class="py-4 px-6 text-center border-b border-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-200 text-base divide-y divide-slate-700">
                        <?php foreach ($submissions as $submission): ?>
                            <tr class="hover:bg-slate-700 transition duration-150 ease-in-out">
                                <td class="py-4 px-6 text-left whitespace-nowrap"><?php echo htmlspecialchars($submission['student_name']); ?> (<?php echo htmlspecialchars($submission['nim']); ?>)</td>
                                <td class="py-4 px-6 text-left"><?php echo htmlspecialchars($submission['praktikum_name']); ?></td>
                                <td class="py-4 px-6 text-left"><?php echo htmlspecialchars($submission['module_name']); ?></td>
                                <td class="py-4 px-6 text-left"><?php echo date('d M Y H:i', strtotime($submission['submission_date'])); ?></td>
                                <td class="py-4 px-6 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold <?php echo ($submission['status'] === 'graded') ? 'bg-emerald-700 text-emerald-100' : 'bg-amber-700 text-amber-100'; ?>">
                                        <?php echo ($submission['status'] === 'graded') ? 'Dinilai' : 'Belum Dinilai'; ?>
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-center font-bold text-lg"><?php echo $submission['grade'] ?? '-'; ?></td>
                                <td class="py-4 px-6 text-center">
                                    <a href="<?php echo BASE_URL; ?>index.php?page=asisten_grade_submission&id=<?php echo $submission['id']; ?>"
                                       class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2.5 px-5 rounded-full text-sm transition duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        <?php echo ($submission['status'] === 'graded') ? 'Lihat/Edit' : 'Beri Nilai'; ?>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</main>