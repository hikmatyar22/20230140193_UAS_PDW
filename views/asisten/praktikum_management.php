<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Kelola Praktikum</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=dashboard"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Dashboard">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="mb-12 border border-slate-700 p-8 rounded-lg bg-slate-700 bg-opacity-60 shadow-lg">
            <h2 class="text-2xl font-semibold text-white mb-6 pb-4 border-b border-slate-600">Management Praktikum</h2>
            <form action="<?php echo BASE_URL; ?>index.php?page=asisten_praktikum_management" method="POST" id="praktikumForm" class="space-y-6">
                <input type="hidden" name="action" id="praktikumAction" value="create_praktikum">
                <input type="hidden" name="praktikum_id" id="praktikumId">

                <div>
                    <label for="praktikum_name" class="block text-slate-200 text-base font-bold mb-2">Nama Praktikum:</label>
                    <input type="text" name="praktikum_name" id="praktikum_name"
                           class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                           required aria-label="Nama Praktikum">
                </div>

                <div>
                    <label for="description" class="block text-slate-200 text-base font-bold mb-2">Deskripsi:</label>
                    <textarea name="description" id="description" rows="6"
                              class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                              placeholder="Masukkan deskripsi singkat praktikum..." aria-label="Deskripsi Praktikum"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center justify-start space-y-4 sm:space-y-0 sm:space-x-5 pt-4">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg w-full sm:w-auto"
                            id="submitButton">
                        Tambah Praktikum
                    </button>
                    <button type="button"
                            class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-md w-full sm:w-auto"
                            onclick="resetPraktikumForm()">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        <h2 class="text-3xl font-bold text-white mb-6">Daftar Praktikum</h2>
        <?php if (empty($praktikums)): ?>
            <p class="text-slate-400 text-lg text-center mt-6">Belum ada praktikum yang dibuat.</p>
        <?php else: ?>
            <div class="overflow-x-auto rounded-lg border border-slate-700 shadow-lg">
                <table class="min-w-full bg-slate-800">
                    <thead class="bg-slate-700">
                        <tr class="text-slate-300 uppercase text-sm leading-normal">
                            <th class="py-4 px-6 text-left border-b border-slate-600">Nama Praktikum</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">Deskripsi</th>
                            <th class="py-4 px-6 text-center border-b border-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-200 text-base divide-y divide-slate-700">
                        <?php foreach ($praktikums as $praktikum): ?>
                            <tr class="hover:bg-slate-700 transition duration-150 ease-in-out">
                                <td class="py-4 px-6 text-left whitespace-nowrap"><?php echo htmlspecialchars($praktikum['name']); ?></td>
                                <td class="py-4 px-6 text-left"><?php echo htmlspecialchars($praktikum['description'] ?? '-'); ?></td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        <a href="<?php echo BASE_URL; ?>index.php?page=asisten_module_management&praktikum_id=<?php echo $praktikum['id']; ?>"
                                           class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.206 5 7.5 5S4.168 5.477 3 6.253v13C4.168 19.523 5.794 20 7.5 20s3.332-.477 4.5-1.247m0 0c1.168.777 2.794 1.247 4.5 1.247 1.706 0 3.332-.477 4.5-1.247m-4.5-13V13m-2-2l2-2m0 0l2 2m-2-2v7.5"></path></svg>
                                            Modul
                                        </a>
                                        <button onclick="editPraktikum(<?php echo htmlspecialchars(json_encode($praktikum)); ?>)"
                                                class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            Edit
                                        </button>
                                        <form action="<?php echo BASE_URL; ?>index.php?page=asisten_praktikum_management" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus praktikum ini? Semua modul dan laporan terkait juga akan terhapus!');">
                                            <input type="hidden" name="action" value="delete_praktikum">
                                            <input type="hidden" name="praktikum_id" value="<?php echo $praktikum['id']; ?>">
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
    </section>
</main>

<script>
    /**
     * Mengisi formulir untuk mengedit praktikum.
     * @param {object} praktikum - Objek praktikum yang akan diedit.
     */
    function editPraktikum(praktikum) {
        document.getElementById('praktikumAction').value = 'update_praktikum';
        document.getElementById('praktikumId').value = praktikum.id;
        document.getElementById('praktikum_name').value = praktikum.name;
        document.getElementById('description').value = praktikum.description || ''; // Pastikan tidak undefined
        document.getElementById('submitButton').textContent = 'Update Praktikum';
        // Scroll ke bagian form agar pengguna langsung melihat form yang terisi
        document.getElementById('praktikumForm').scrollIntoView({ behavior: 'smooth' });
    }

    /**
     * Mereset formulir kembali ke mode "Tambah Praktikum".
     */
    function resetPraktikumForm() {
        document.getElementById('praktikumAction').value = 'create_praktikum';
        document.getElementById('praktikumId').value = '';
        document.getElementById('praktikum_name').value = '';
        document.getElementById('description').value = '';
        document.getElementById('submitButton').textContent = 'Tambah Praktikum';
        // Opsional: scroll ke atas jika form direset
        // window.scrollTo({ top: 0, behavior: 'smooth' });
    }
</script>