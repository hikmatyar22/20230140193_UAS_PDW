<div class="relative bg-white bg-opacity-5 glassmorphism rounded-3xl shadow-6xl p-8 sm:p-12 w-full max-w-md transform transition-all duration-700 ease-out scale-95 opacity-0 animate-fadeIn z-10 border border-gray-700">
    <h2 class="text-4xl sm:text-5xl font-extrabold text-white text-center mb-4 drop-shadow-lg leading-tight">
        LOGIN <span class="text-indigo-400">SIMPRAK</span>
    </h2>
    <p class="text-center text-slate-300 mb-10 text-lg sm:text-xl font-light">
        Akses Informasi Praktikum Anda
    </p>

    <form action="<?php echo BASE_URL; ?>index.php?page=login" method="POST" class="space-y-6">
        <div>
            <label for="username" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Username</label>
            <div class="relative group">
                <input type="text" name="username" id="username" placeholder="Nama pengguna Anda"
                    class="w-full px-5 py-3 pr-12 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md" required>
                <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-500 group-focus-within:text-indigo-400 w-6 h-6 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            </div>
        </div>
        <div>
            <label for="password" class="block text-slate-200 text-base sm:text-lg font-medium mb-2">Password</label>
            <div class="relative group">
                <input type="password" name="password" id="password" placeholder="Kata sandi rahasia Anda"
                    class="w-full px-5 py-3 pr-12 bg-slate-800 border border-slate-700 rounded-lg text-gray-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500 transition duration-300 ease-in-out text-base sm:text-lg focus:shadow-md" required>
                <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 text-slate-500 group-focus-within:text-cyan-400 w-6 h-6 transition-colors duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
            </div>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-4">
            <button type="submit"
                class="w-full sm:w-auto flex-grow bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:shadow-xl transition duration-300 ease-in-out transform hover:-translate-y-0.5 text-lg tracking-wide uppercase focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 border border-indigo-500">
                Masuk
            </button>
            <a href="<?php echo BASE_URL; ?>index.php?page=register"
                class="text-cyan-400 hover:text-cyan-300 font-semibold text-center mt-4 sm:mt-0 sm:ml-4 text-base transition duration-300 ease-in-out hover:underline">
                Belum punya akun? Daftar Sekarang!
            </a>
        </div>
    </form>
</div>