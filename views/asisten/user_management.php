<main class="container mx-auto px-4 py-8">
    <section class="bg-slate-800 glassmorphism shadow-xl rounded-xl p-10 w-full max-w-6xl mx-auto animate-fadeIn border border-slate-700">
        <h1 class="text-4xl font-bold text-white mb-6">Kelola Akun Pengguna</h1>

        <a href="<?php echo BASE_URL; ?>index.php?page=dashboard"
           class="inline-flex items-center px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition duration-300 ease-in-out transform hover:-translate-y-1 shadow-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75 mb-10 text-base font-semibold"
           aria-label="Kembali ke Dashboard">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Dashboard
        </a>

        <div class="mb-12 border border-slate-700 p-8 rounded-lg bg-slate-700 bg-opacity-60 shadow-lg">
            <h2 class="text-2xl font-semibold text-white mb-6 pb-4 border-b border-slate-600">Management Pengguna</h2>
            <form action="<?php echo BASE_URL; ?>index.php?page=asisten_user_management" method="POST" id="userForm" class="space-y-6">
                <input type="hidden" name="action" id="userAction" value="create_user">
                <input type="hidden" name="user_id" id="userId">

                <div>
                    <label for="username" class="block text-slate-200 text-base font-bold mb-2">Username:</label>
                    <input type="text" name="username" id="username"
                           class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                           required aria-label="Username pengguna">
                </div>
                <div>
                    <label for="full_name" class="block text-slate-200 text-base font-bold mb-2">Nama Lengkap:</label>
                    <input type="text" name="full_name" id="full_name"
                           class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                           required aria-label="Nama lengkap pengguna">
                </div>
                <div>
                    <label for="role" class="block text-slate-200 text-base font-bold mb-2">Peran:</label>
                    <select name="role" id="role"
                            class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                            required onchange="toggleNimFieldUserManagement()" aria-label="Peran pengguna">
                        <option value="mahasiswa">Mahasiswa</option>
                        <option value="asisten">Asisten</option>
                    </select>
                </div>
                <div id="nimFieldUserManagement">
                    <label for="nim" class="block text-slate-200 text-base font-bold mb-2">NIM (jika Mahasiswa):</label>
                    <input type="text" name="nim" id="nim"
                           class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                           placeholder="Kosongkan jika bukan mahasiswa" aria-label="NIM mahasiswa">
                </div>
                <div>
                    <label for="password" class="block text-slate-200 text-base font-bold mb-2">Password (isi untuk ubah):</label>
                    <input type="password" name="password" id="password"
                           placeholder="Biarkan kosong jika tidak ingin mengubah password"
                           class="shadow-sm border border-slate-600 rounded-lg w-full py-3 px-4 bg-white text-black placeholder-slate-500 leading-tight focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300"
                           aria-label="Password pengguna">
                </div>
                <div class="flex flex-col sm:flex-row items-center justify-start space-y-4 sm:space-y-0 sm:space-x-5 pt-4">
                    <button type="submit"
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-lg w-full sm:w-auto"
                            id="submitButton">
                        Tambah Pengguna
                    </button>
                    <button type="button"
                            class="bg-slate-600 hover:bg-slate-700 text-white font-bold py-3.5 px-8 rounded-full focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-0.5 shadow-md w-full sm:w-auto"
                            onclick="resetUserForm()">
                        Batal
                    </button>
                </div>
            </form>
        </div>

        <h2 class="text-3xl font-bold text-white mb-6">Daftar Akun Pengguna</h2>
        <?php if (empty($all_users)): ?>
            <p class="text-slate-400 text-lg text-center mt-6">Belum ada pengguna terdaftar.</p>
        <?php else: ?>
            <div class="overflow-x-auto rounded-lg border border-slate-700 shadow-lg">
                <table class="min-w-full bg-slate-800">
                    <thead class="bg-slate-700">
                        <tr class="text-slate-300 uppercase text-sm leading-normal">
                            <th class="py-4 px-6 text-left border-b border-slate-600">Username</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">Nama Lengkap</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">Peran</th>
                            <th class="py-4 px-6 text-left border-b border-slate-600">NIM</th>
                            <th class="py-4 px-6 text-center border-b border-slate-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-200 text-base divide-y divide-slate-700">
                        <?php foreach ($all_users as $user_data): ?>
                            <tr class="hover:bg-slate-700 transition duration-150 ease-in-out">
                                <td class="py-4 px-6 text-left whitespace-nowrap"><?php echo htmlspecialchars($user_data['username']); ?></td>
                                <td class="py-4 px-6 text-left"><?php echo htmlspecialchars($user_data['full_name']); ?></td>
                                <td class="py-4 px-6 text-left"><?php echo htmlspecialchars(ucfirst($user_data['role'])); ?></td>
                                <td class="py-4 px-6 text-left"><?php echo htmlspecialchars($user_data['nim'] ?? '-'); ?></td>
                                <td class="py-4 px-6 text-center">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        <button onclick="editUser(<?php echo htmlspecialchars(json_encode($user_data)); ?>)"
                                                class="inline-flex items-center bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-full text-sm transition duration-200 shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            Edit
                                        </button>
                                        <form action="<?php echo BASE_URL; ?>index.php?page=asisten_user_management" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                            <input type="hidden" name="action" value="delete_user">
                                            <input type="hidden" name="user_id" value="<?php echo $user_data['id']; ?>">
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
     * Mengatur visibilitas field NIM berdasarkan peran yang dipilih.
     */
    function toggleNimFieldUserManagement() {
        var role = document.getElementById('role').value;
        var nimField = document.getElementById('nimFieldUserManagement');
        var nimInput = document.getElementById('nim');

        if (role === 'mahasiswa') {
            nimField.style.display = 'block';
            nimInput.setAttribute('required', 'required'); // NIM is required for students
        } else {
            nimField.style.display = 'none';
            nimInput.removeAttribute('required');
            nimInput.value = ''; // Clear NIM if not a student
        }
    }

    /**
     * Mengisi formulir untuk mengedit pengguna.
     * @param {object} user - Objek pengguna yang akan diedit.
     */
    function editUser(user) {
        document.getElementById('userAction').value = 'update_user';
        document.getElementById('userId').value = user.id;
        document.getElementById('username').value = user.username;
        document.getElementById('full_name').value = user.full_name;
        document.getElementById('role').value = user.role;
        document.getElementById('nim').value = user.nim || '';
        document.getElementById('password').value = ''; // Clear password field on edit
        document.getElementById('submitButton').textContent = 'Update Pengguna';
        toggleNimFieldUserManagement(); // Call this to set NIM field visibility and required status
        document.getElementById('userForm').scrollIntoView({ behavior: 'smooth' });
    }

    /**
     * Mereset formulir kembali ke mode "Tambah Pengguna".
     */
    function resetUserForm() {
        document.getElementById('userAction').value = 'create_user';
        document.getElementById('userId').value = '';
        document.getElementById('username').value = '';
        document.getElementById('full_name').value = '';
        document.getElementById('role').value = 'mahasiswa'; // Default to Mahasiswa
        document.getElementById('nim').value = '';
        document.getElementById('password').value = '';
        document.getElementById('submitButton').textContent = 'Tambah Pengguna';
        toggleNimFieldUserManagement(); // Call this to reset NIM field visibility and required status
    }

    // Panggil saat DOM selesai dimuat untuk mengatur status NIM field awal
    document.addEventListener('DOMContentLoaded', toggleNimFieldUserManagement);
</script>