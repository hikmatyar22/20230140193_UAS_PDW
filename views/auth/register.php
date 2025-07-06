<div class="relative bg-white bg-opacity-5 glassmorphism rounded-3xl shadow-6xl p-8 sm:p-12 w-full max-w-md transform transition-all duration-700 ease-out scale-95 opacity-0 animate-fadeIn z-10 border border-gray-700">
    <h2 class="text-4xl sm:text-5xl font-extrabold text-white text-center mb-4 drop-shadow-lg leading-tight">
        Bergabung dengan <span class="text-emerald-400">SIMPRAK</span>
    </h2>
    <p class="text-center text-slate-300 mb-10 text-lg sm:text-xl font-light">
        Daftar Untuk Mengakses Informasi Praktikum
    </p>

    <form action="<?php echo BASE_URL; ?>index.php?page=register" method="POST" class="space-y-6">
        <div>
            <label for="username" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Username</label>
            <div class="relative group">
                <input type="text" name="username" id="username" placeholder="Pilih nama pengguna Anda"
                    class="w-full px-5 py-3 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md" required>
            </div>
        </div>
        <div>
            <label for="full_name" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Nama Lengkap</label>
            <div class="relative group">
                <input type="text" name="full_name" id="full_name" placeholder="Nama lengkap Anda"
                    class="w-full px-5 py-3 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md" required>
            </div>
        </div>
        <div>
            <label for="role" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Daftar sebagai</label>
            <div class="relative group">
                <select name="role" id="role"
                    class="w-full px-5 py-3 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition duration-300 ease-in-out text-base sm:text-lg appearance-none focus:shadow-md" required onchange="toggleNimField()">
                    <option value="mahasiswa" class="bg-slate-800 text-gray-900">Mahasiswa</option>
                    <option value="asisten" class="bg-slate-800 text-gray-900">Asisten</option>
                </select>
                <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-500 pointer-events-none w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>
        </div>
        <div id="nimField">
            <label for="nim" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">NIM (Nomor Induk Mahasiswa)</label>
            <div class="relative group">
                <input type="text" name="nim" id="nim" placeholder="NIM Anda (jika mahasiswa)"
                    class="w-full px-5 py-3 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md">
            </div>
        </div>
        <div>
            <label for="password" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Password</label>
            <div class="relative group">
                <input type="password" name="password" id="password" placeholder="Buat kata sandi Anda"
                    class="w-full px-5 py-3 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-violet-500 focus:border-violet-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md" required>
            </div>
        </div>
        <div>
            <label for="password_confirm" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Konfirmasi Password</label>
            <div class="relative group">
                <input type="password" name="password_confirm" id="password_confirm" placeholder="Ulangi kata sandi Anda"
                    class="w-full px-5 py-3 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md" required>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
            <button type="submit"
                class="w-full sm:w-auto flex-grow bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-0.5 text-lg tracking-wide uppercase focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-opacity-50 border border-emerald-500">
                Daftar Akun
            </button>
            <a href="<?php echo BASE_URL; ?>index.php?page=login"
                class="text-indigo-400 hover:text-indigo-300 font-semibold text-center mt-4 sm:mt-0 sm:ml-4 text-base transition duration-300 ease-in-out hover:underline">
                Sudah punya akun? Login!
            </a>
        </div>
    </form>
</div>

<script>
    function toggleNimField() {
        var role = document.getElementById('role').value;
        var nimField = document.getElementById('nimField');
        var nimInput = document.getElementById('nim');

        if (role === 'mahasiswa') {
            nimField.style.display = 'block';
            nimInput.setAttribute('required', 'required');
        } else {
            nimField.style.display = 'none';
            nimInput.removeAttribute('required');
            nimInput.value = '';
        }
    }
    document.addEventListener('DOMContentLoaded', toggleNimField);
</script>