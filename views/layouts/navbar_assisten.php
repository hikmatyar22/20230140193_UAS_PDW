<nav class="bg-gradient-to-r from-blue-900 to-blue-700 p-4 shadow-xl">
    <div class="container mx-auto flex justify-between items-center">
        <a href="<?php echo BASE_URL; ?>index.php?page=dashboard"
           class="text-white text-2xl font-bold tracking-wide hover:text-blue-200 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-opacity-75 rounded px-2 py-1"
           aria-label="Asisten Profile - Go to Dashboard">
            SIMPRAK
        </a>

        <div class="flex items-center space-x-4">
            <a href="<?php echo BASE_URL; ?>index.php?page=logout"
               class="px-6 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-semibold transition duration-300 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 shadow-md flex items-center"
               aria-label="Logout">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </a>
        </div>
    </div>
</nav>