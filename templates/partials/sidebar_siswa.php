<aside class="w-full md:w-64 flex-shrink-0">
    <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
        <div class="flex items-center space-x-4 mb-6">
            <div class="bg-sky-100 text-sky-600 rounded-full h-12 w-12 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Siswa'); ?></h3>
                <p class="text-sm text-gray-600">Siswa</p>
            </div>
        </div>
        
        <nav class="space-y-2">
            <a href="dashboard_siswa.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'dashboard_siswa.php' ? 'bg-sky-50 text-sky-600 font-medium' : 'text-gray-600 hover:bg-gray-100'; ?> px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>
            <a href="profile.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'bg-sky-50 text-sky-600 font-medium' : 'text-gray-600 hover:bg-gray-100'; ?> px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil Saya</span>
            </a>
            <a href="documents.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'documents.php' ? 'bg-sky-50 text-sky-600 font-medium' : 'text-gray-600 hover:bg-gray-100'; ?> px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span>Dokumen</span>
            </a>
            <a href="jadwal.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'jadwal.php' ? 'bg-sky-50 text-sky-600 font-medium' : 'text-gray-600 hover:bg-gray-100'; ?> px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Jadwal</span>
            </a>
            <a href="faq.php" class="flex items-center space-x-3 <?php echo basename($_SERVER['PHP_SELF']) == 'faq.php' ? 'bg-sky-50 text-sky-600 font-medium' : 'text-gray-600 hover:bg-gray-100'; ?> px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span>FAQ</span>
            </a>
        </nav>
        
        <div class="mt-8 pt-6 border-t border-gray-200">
            <a href="logout.php" class="flex items-center space-x-3 text-red-600 hover:bg-red-50 font-medium px-4 py-3 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span>Logout</span>
            </a>
        </div>
    </div>
</aside>