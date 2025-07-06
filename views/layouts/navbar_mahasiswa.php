<span class="block px-4 py-2 text-slate-300 font-semibold text-sm border-b border-slate-700 mb-2 pb-2">
    Halo, <?php echo htmlspecialchars(Auth::getFullName() ?? 'Mahasiswa'); ?>
</span>
<a href="<?php echo BASE_URL; ?>index.php?page=logout" class="block px-4 py-2 text-red-400 hover:bg-slate-700 hover:text-red-300 transition duration-200 text-sm">Logout</a>