<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Kelola Modul untuk Praktikum: "<span class="text-teal-400"><?php echo htmlspecialchars($praktikum_data['name']); ?></span>"</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=asisten_praktikum_management"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Kelola Praktikum">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Kelola Praktikum
        </a>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
            <div class="order-1 lg:order-1"> <div class="mb-12 border border-slate-700 p-8 rounded-lg bg-slate-700 bg-opacity-60 shadow-lg">
                    <h2 class="text-2xl font-semibold text-white mb-6 pb-4 border-b border-slate-600">Management Modul</h2>
                    <form action="<?php echo BASE_URL; ?>index.php?page=asisten_module_management&praktikum_id=<?php echo $praktikum_data['id']; ?>" method="POST" enctype="multipart/form-data" id="moduleForm" class="space-y-6">
                        <input type="hidden" name="action" id="moduleAction" value="create_module">
                        <input type="hidden" name="module_id" id="moduleId">

                        <div>
                            <label for="module_name" class="block text-slate-200 text-base font-bold mb-2">Nama Modul:</label>
                            <input type="text" name="module_name" id="module_name"
                                   class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                                   required aria-label="Nama Modul">
                        </div>

                        <div>
                            <label for="material_file" class="block text-slate-200 text-base font-bold mb-2">File Materi (PDF/DOCX/etc.):</label>
                            <input type="file" name="material_file" id="material_file" accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip"
                                   class="block w-full text-base text-slate-300 file:mr-4 file:py-3 file:px-6 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-600 file:text-white hover:file:bg-violet-700 transition duration-300 cursor-pointer focus:outline-none focus:ring-2 focus:ring-violet-400 focus:ring-opacity-75"
                                   aria-label="Pilih file materi">
                            <p class="text-sm text-slate-400 mt-2" id="currentMaterialFile">Tidak ada file materi saat ini. (Pilih file untuk menambah/mengubah)</p>
                        </div>

                        <div class="flex flex-col sm:flex-row items-center justify-start space-y-4 sm:space-y-0 sm:space-x-5 pt-4">
                            <button type="submit"
                                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg w-full sm:w-auto"
                                    id="submitButton">
                                Tambah Modul
                            </button>
                            <button type="button"
                                    class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-md w-full sm:w-auto"
                                    onclick="resetModuleForm()">
                                Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="order-2 lg:order-2"> <h2 class="text-3xl font-bold text-white mb-6">Daftar Modul</h2>
                <?php if (empty($modules)): ?>
                    <p class="text-slate-400 text-lg text-center mt-6">Belum ada modul untuk praktikum ini.</p>
                <?php else: ?>
                    <div class="overflow-x-auto rounded-lg border border-slate-700 shadow-lg">
                        <table class="min-w-full bg-slate-800">
                            <thead class="bg-slate-700">
                                <tr class="text-slate-300 uppercase text-sm leading-normal">
                                    <th class="py-4 px-6 text-left border-b border-slate-600">Nama Modul</th>
                                    <th class="py-4 px-6 text-left border-b border-slate-600">File Materi</th>
                                    <th class="py-4 px-6 text-center border-b border-slate-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-slate-200 text-base divide-y divide-slate-700">
                                <?php foreach ($modules as $module): ?>
                                    <tr class="hover:bg-slate-700 transition duration-150 ease-in-out">
                                        <td class="py-4 px-6 text-left whitespace-nowrap"><?php echo htmlspecialchars($module['module_name']); ?></td>
                                        <td class="py-4 px-6 text-left">
                                            <?php if ($module['material_file_path']): ?>
                                                <a href="<?php echo MATERIAL_URL_PATH . basename($module['material_file_path']); ?>" target="_blank"
                                                   class="inline-flex items-center text-indigo-400 hover:underline focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-opacity-75">
                                                    <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                    <?php echo htmlspecialchars(basename($module['material_file_path'])); ?>
                                                </a>
                                            <?php else: ?>
                                                <span class="text-slate-500">Tidak ada</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="py-4 px-6 text-center">
                                            <div class="flex flex-wrap justify-center gap-2">
                                                <button onclick="editModule(<?php echo htmlspecialchars(json_encode($module)); ?>)"
                                                        class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                    Edit
                                                </button>
                                                <form action="<?php echo BASE_URL; ?>index.php?page=asisten_module_management&praktikum_id=<?php echo $praktikum_data['id']; ?>" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus modul ini? Laporan terkait juga akan terhapus!');">
                                                    <input type="hidden" name="action" value="delete_module">
                                                    <input type="hidden" name="module_id" value="<?php echo $module['id']; ?>">
                                                    <button type="submit"
                                                            class="inline-flex items-center bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full text-sm shadow-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75">
                                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>

<script>
    /**
     * Mengisi formulir untuk mengedit modul.
     * @param {object} module - Objek modul yang akan diedit.
     */
    function editModule(module) {
        document.getElementById('moduleAction').value = 'update_module';
        document.getElementById('moduleId').value = module.id;
        document.getElementById('module_name').value = module.module_name;
        document.getElementById('submitButton').textContent = 'Update Modul';
        document.getElementById('material_file').removeAttribute('required'); // No longer required for update
        document.getElementById('material_file').value = ''; // Clear file input on edit

        // Menampilkan nama file materi saat ini dengan tautan
        if (module.material_file_path) {
            const fileName = module.material_file_path.split('/').pop();
            // Pastikan MATERIAL_URL_PATH didefinisikan di PHP atau JavaScript jika diperlukan
            document.getElementById('currentMaterialFile').innerHTML = `
                File saat ini: <a href="<?php echo MATERIAL_URL_PATH; ?>${fileName}" target="_blank" class="text-indigo-400 hover:underline">
                    <svg class="w-4 h-4 inline-block mr-1 -mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    ${fileName}
                </a> (Kosongkan untuk menghapus, pilih baru untuk mengganti)
            `;
        } else {
            document.getElementById('currentMaterialFile').textContent = 'Tidak ada file materi saat ini. (Pilih file untuk menambah/mengubah)';
        }
        document.getElementById('moduleForm').scrollIntoView({ behavior: 'smooth' });
    }

    /**
     * Mereset formulir kembali ke mode "Tambah Modul".
     */
    function resetModuleForm() {
        document.getElementById('moduleAction').value = 'create_module';
        document.getElementById('moduleId').value = '';
        document.getElementById('module_name').value = '';
        document.getElementById('material_file').value = '';
        document.getElementById('material_file').setAttribute('required', 'required'); // Set required for new module
        document.getElementById('currentMaterialFile').textContent = 'Tidak ada file materi saat ini. (Pilih file untuk menambah/mengubah)';
        document.getElementById('submitButton').textContent = 'Tambah Modul';
    }
</script>