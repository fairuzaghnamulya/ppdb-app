<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPDB Online - Penerimaan Siswa Baru 2025</title>
    
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
        .gradient-bg {
            background: linear-gradient(120deg, #f0f9ff 0%, #e0f2fe 100%);
        }
        .cta-button {
            transition: all 0.3s ease;
        }
        .feature-card, .timeline-item {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php 
    // Check if user is logged in
    $is_logged_in = isset($_SESSION['user_id']);
    $user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : '';
    ?>

    <!-- Header / Navigation Bar -->
    <header x-data="{ mobileMenuOpen: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-6 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="index.php" class="flex-shrink-0 flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                </svg>
                <span class="text-xl font-bold text-gray-800">PPDB Online</span>
            </a>
            
            <!-- Desktop Menu Links (Centered) -->
            <div class="hidden md:flex items-center space-x-7 text-gray-600 font-medium">
                <a href="index.php" class="hover:text-sky-600 transition">Beranda</a>
                <a href="jalur_pendaftaran.php" class="hover:text-sky-600 transition">Jalur Pendaftaran</a>
                <a href="alur_pendaftaran.php" class="hover:text-sky-600 transition">Alur</a>
                <a href="jadwal.php" class="hover:text-sky-600 transition">Jadwal</a>
                <a href="faq.php" class="hover:text-sky-600 transition">FAQ</a>
                <a href="kontak.php" class="hover:text-sky-600 transition">Kontak</a>
            </div>

            <!-- Desktop Action Buttons -->
            <div class="hidden md:flex items-center space-x-5">
                <?php if ($is_logged_in): ?>
                    <a href="dashboard_<?php echo $user_role; ?>.php" class="border border-sky-600 text-sky-600 font-medium px-5 py-2 rounded-lg hover:bg-sky-600 hover:text-white transition">Dashboard</a>
                    <a href="logout.php" class="cta-button bg-sky-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-sky-700">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="border border-sky-600 text-sky-600 font-medium px-5 py-2 rounded-lg hover:bg-sky-600 hover:text-white transition">Login</a>
                    <a href="register.php" class="cta-button bg-sky-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-sky-700">Daftar Sekarang</a>
                <?php endif; ?>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="mobileMenuOpen = !mobileMenuOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-transition class="md:hidden px-6 pb-4 border-t border-gray-200">
            <div class="space-y-2 pt-4">
                <a href="index.php" @click="mobileMenuOpen = false" class="block text-gray-600 hover:text-sky-600 py-1">Beranda</a>
                <a href="jalur_pendaftaran.php" @click="mobileMenuOpen = false" class="block text-gray-600 hover:text-sky-600 py-1">Jalur Pendaftaran</a>
                <a href="alur_pendaftaran.php" @click="mobileMenuOpen = false" class="block text-gray-600 hover:text-sky-600 py-1">Alur</a>
                <a href="jadwal.php" @click="mobileMenuOpen = false" class="block text-gray-600 hover:text-sky-600 py-1">Jadwal</a>
                <a href="faq.php" @click="mobileMenuOpen = false" class="block text-gray-600 hover:text-sky-600 py-1">FAQ</a>
                <a href="kontak.php" @click="mobileMenuOpen = false" class="block text-gray-600 hover:text-sky-600 py-1">Kontak</a>
            </div>
            <div class="mt-4 pt-4 border-t border-gray-200 space-y-3">
                <?php if ($is_logged_in): ?>
                    <a href="dashboard_<?php echo $user_role; ?>.php" class="block w-full text-center border border-sky-600 text-sky-600 font-medium px-5 py-2 rounded-lg hover:bg-sky-600 hover:text-white transition">Dashboard</a>
                    <a href="logout.php" class="block w-full text-center cta-button bg-sky-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-sky-700">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="block w-full text-center text-sky-600 font-medium px-5 py-2 rounded-lg border border-sky-600 hover:bg-sky-600 hover:text-white transition">Login</a>
                    <a href="register.php" class="block w-full text-center cta-button bg-sky-600 text-white font-medium px-5 py-2 rounded-lg hover:bg-sky-700">Daftar Sekarang</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main>