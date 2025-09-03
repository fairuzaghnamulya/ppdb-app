<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if user is student
if ($_SESSION['user_role'] !== 'siswa') {
    header("Location: dashboard_" . $_SESSION['user_role'] . ".php");
    exit();
}

// Fetch user data from the database
$user_id = $_SESSION['user_id'];
$user_data = getUserData($user_id);

// Fetch additional data for the dashboard
$statistics = getStudentStatistics($user_id);

// Get announcements
$announcements = getAnnouncements(5);
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - PPDB Online 2025</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js for interactivity -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Custom CSS for theme -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <div class="container mx-auto px-6 py-8 flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-sky-100 text-sky-600 rounded-full h-12 w-12 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($user_data['username']); ?></h3>
                        <p class="text-sm text-gray-600">Siswa</p>
                    </div>
                </div>
                
                <nav class="space-y-2">
                    <a href="dashboard_siswa.php" class="flex items-center space-x-3 bg-sky-50 text-sky-600 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="profile.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profil Saya</span>
                    </a>
                    <a href="documents.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Dokumen</span>
                    </a>
                    <a href="jadwal.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Jadwal</span>
                    </a>
                    <a href="faq.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
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

        <!-- Main Content -->
        <main class="flex-1">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Dashboard Siswa</h1>
                <p class="text-gray-600 mt-2">Selamat datang kembali, <?php echo htmlspecialchars($user_data['username']); ?>!</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Status Pendaftaran</p>
                            <p class="text-xl font-bold text-gray-900"><?php echo $statistics['registration_status']; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Dokumen</p>
                            <p class="text-xl font-bold text-gray-900"><?php echo $statistics['documents_status']; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md p-6">
                    <div class="flex items-center">
                        <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-600">Pengumuman</p>
                            <p class="text-xl font-bold text-gray-900"><?php echo $statistics['announcement_status']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Aksi Cepat</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="profile.php" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-sky-50 transition">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-12 w-12 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Edit Profil</span>
                    </a>
                    <a href="documents.php" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-sky-50 transition">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-12 w-12 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Unggah Dokumen</span>
                    </a>
                    <a href="jadwal.php" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-sky-50 transition">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-12 w-12 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Lihat Jadwal</span>
                    </a>
                    <a href="faq.php" class="flex flex-col items-center justify-center p-4 bg-gray-50 rounded-lg hover:bg-sky-50 transition">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-12 w-12 flex items-center justify-center mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium text-gray-900">Tanya Jawab</span>
                    </a>
                </div>
            </div>

            <!-- Recent Announcements -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-900">Pengumuman Terbaru</h2>
                    <a href="announcements.php" class="text-sky-600 hover:text-sky-800 text-sm font-medium">Lihat Semua</a>
                </div>
                
                <?php if (count($announcements) > 0): ?>
                    <div class="space-y-4">
                        <?php foreach ($announcements as $announcement): ?>
                            <div class="border-b border-gray-200 pb-4 last:border-0 last:pb-0">
                                <h3 class="font-semibold text-gray-900"><?php echo htmlspecialchars($announcement['judul']); ?></h3>
                                <p class="text-gray-600 text-sm mt-1"><?php echo htmlspecialchars(substr($announcement['isi'], 0, 100)) . '...'; ?></p>
                                <p class="text-gray-400 text-xs mt-2"><?php echo date('d F Y H:i', strtotime($announcement['tanggal'])); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <p class="mt-4 text-gray-600">Belum ada pengumuman</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>