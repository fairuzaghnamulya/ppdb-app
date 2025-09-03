<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if user is admin
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: dashboard_" . $_SESSION['user_role'] . ".php");
    exit();
}

$success = '';
$error = '';

// Get current settings
$stmt = $conn->prepare("SELECT * FROM pengaturan LIMIT 1");
$stmt->execute();
$result = $stmt->get_result();
$settings = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal_mulai = trim($_POST['tanggal_mulai']);
    $tanggal_selesai = trim($_POST['tanggal_selesai']);
    $kuota = trim($_POST['kuota']);
    
    if (empty($tanggal_mulai) || empty($tanggal_selesai) || empty($kuota)) {
        $error = "Semua field harus diisi.";
    } elseif (!is_numeric($kuota) || $kuota <= 0) {
        $error = "Kuota harus berupa angka positif.";
    } else {
        if ($settings) {
            // Update existing settings
            $stmt = $conn->prepare("UPDATE pengaturan SET tanggal_mulai = ?, tanggal_selesai = ?, kuota = ? WHERE id = ?");
            $stmt->bind_param("ssii", $tanggal_mulai, $tanggal_selesai, $kuota, $settings['id']);
        } else {
            // Insert new settings
            $stmt = $conn->prepare("INSERT INTO pengaturan (tanggal_mulai, tanggal_selesai, kuota) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $tanggal_mulai, $tanggal_selesai, $kuota);
        }
        
        if ($stmt->execute()) {
            $success = "Pengaturan berhasil disimpan.";
            
            // Refresh settings
            $stmt = $conn->prepare("SELECT * FROM pengaturan LIMIT 1");
            $stmt->execute();
            $result = $stmt->get_result();
            $settings = $result->fetch_assoc();
        } else {
            $error = "Gagal menyimpan pengaturan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan - PPDB Online 2025</title>
    
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
                        <h3 class="font-bold text-gray-900"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></h3>
                        <p class="text-sm text-gray-600">Administrator</p>
                    </div>
                </div>
                
                <nav class="space-y-2">
                    <a href="dashboard_admin.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="students.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span>Daftar Siswa</span>
                    </a>
                    <a href="documents_admin.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Verifikasi Dokumen</span>
                    </a>
                    <a href="settings.php" class="flex items-center space-x-3 bg-sky-50 text-sky-600 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Pengaturan</span>
                    </a>
                    <a href="announcements_admin.php" class="flex items-center space-x-3 text-gray-600 hover:bg-gray-100 font-medium px-4 py-3 rounded-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span>Pengumuman</span>
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
                <h1 class="text-3xl font-bold text-gray-900">Pengaturan</h1>
                <p class="text-gray-600 mt-2">Kelola pengaturan sistem PPDB</p>
            </div>

            <?php if (!empty($success)): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700"><?php echo htmlspecialchars($success); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700"><?php echo htmlspecialchars($error); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="bg-white rounded-xl shadow-md p-6">
                <form action="settings.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Mulai Pendaftaran</label>
                            <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="<?php echo htmlspecialchars($settings['tanggal_mulai'] ?? ''); ?>" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                        </div>
                        
                        <div class="mb-4">
                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Selesai Pendaftaran</label>
                            <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="<?php echo htmlspecialchars($settings['tanggal_selesai'] ?? ''); ?>" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                        </div>
                        
                        <div class="mb-4">
                            <label for="kuota" class="block text-sm font-medium text-gray-700 mb-1">Kuota Pendaftaran</label>
                            <input type="number" name="kuota" id="kuota" value="<?php echo htmlspecialchars($settings['kuota'] ?? ''); ?>" required min="1" class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <button type="submit" class="bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>