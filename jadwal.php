<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';

// Get registration settings
$settings = getRegistrationSettings();
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal - PPDB Online 2025</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Custom CSS for theme -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .timeline-item {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <main>
        <!-- Schedule Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Jadwal Penting PPDB 2025</h1>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Catat tanggal-tanggal penting berikut agar tidak terlewat.</p>
                </div>
                <div class="max-w-3xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                    <?php if ($settings): ?>
                    <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                        <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_mulai'])); ?> - <?php echo date('d F Y', strtotime($settings['tanggal_selesai'])); ?></span>
                        <h3 class="text-xl font-bold my-2 text-gray-900">Pendaftaran Online</h3>
                        <p class="text-gray-600">Pembuatan akun dan pengisian formulir pendaftaran.</p>
                    </div>
                    <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                        <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_mulai'] . ' +15 days')); ?> - <?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' -10 days')); ?></span>
                        <h3 class="text-xl font-bold my-2 text-gray-900">Verifikasi Berkas</h3>
                        <p class="text-gray-600">Panitia melakukan verifikasi data dan kelengkapan dokumen.</p>
                    </div>
                    <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                        <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' +5 days')); ?></span>
                        <h3 class="text-xl font-bold my-2 text-gray-900">Pengumuman Hasil</h3>
                        <p class="text-gray-600">Hasil seleksi akan diumumkan melalui portal PPDB.</p>
                    </div>
                    <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                        <span class="font-bold text-sky-600"><?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' +6 days')); ?> - <?php echo date('d F Y', strtotime($settings['tanggal_selesai'] . ' +10 days')); ?></span>
                        <h3 class="text-xl font-bold my-2 text-gray-900">Daftar Ulang</h3>
                        <p class="text-gray-600">Calon siswa yang lulus seleksi melakukan proses daftar ulang.</p>
                    </div>
                    <?php else: ?>
                    <div class="timeline-item bg-gray-50 p-6 rounded-xl shadow-lg border border-gray-200">
                        <span class="font-bold text-sky-600">Jadwal belum ditentukan</span>
                        <h3 class="text-xl font-bold my-2 text-gray-900">Informasi akan diumumkan</h3>
                        <p class="text-gray-600">Jadwal pendaftaran akan diumumkan segera.</p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>