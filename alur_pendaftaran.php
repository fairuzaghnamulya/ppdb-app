<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alur Pendaftaran - PPDB Online 2025</title>
    
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
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <main>
        <!-- Registration Flow Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Alur Pendaftaran Siswa Baru</h1>
                    <p class="text-gray-600 mt-2">Ikuti 4 langkah mudah untuk mendaftar.</p>
                </div>
                <div class="relative max-w-4xl mx-auto">
                    <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-sky-200" style="transform: translateY(-50%);"></div>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 relative">
                        <!-- Step 1 -->
                        <div class="text-center p-4">
                            <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">1</div>
                            <h3 class="font-bold text-lg mb-2">Buat Akun</h3>
                            <p class="text-gray-600 text-sm">Isi formulir pendaftaran awal untuk membuat akun PPDB.</p>
                        </div>
                        <!-- Step 2 -->
                        <div class="text-center p-4">
                            <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">2</div>
                            <h3 class="font-bold text-lg mb-2">Lengkapi Data</h3>
                            <p class="text-gray-600 text-sm">Masuk & lengkapi data diri serta unggah dokumen.</p>
                        </div>
                        <!-- Step 3 -->
                        <div class="text-center p-4">
                           <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">3</div>
                            <h3 class="font-bold text-lg mb-2">Verifikasi</h3>
                            <p class="text-gray-600 text-sm">Panitia akan memverifikasi data dan dokumen pendaftaran Anda.</p>
                        </div>
                        <!-- Step 4 -->
                        <div class="text-center p-4">
                           <div class="mx-auto h-20 w-20 flex items-center justify-center bg-white border-4 border-sky-500 rounded-full text-sky-500 text-2xl font-bold z-10 relative mb-4">4</div>
                            <h3 class="font-bold text-lg mb-2">Pengumuman</h3>
                            <p class="text-gray-600 text-sm">Cek hasil kelulusan melalui akun Anda sesuai jadwal.</p>
                        </div>
                    </div>
                </div>
                
                <div class="max-w-3xl mx-auto mt-16 bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Detail Alur Pendaftaran</h2>
                    
                    <div class="space-y-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="bg-sky-100 text-sky-600 rounded-full h-10 w-10 flex items-center justify-center font-bold">1</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Buat Akun</h3>
                                <p class="text-gray-600 mt-2">Calon siswa membuat akun di portal PPDB dengan mengisi data diri dasar seperti nama, NISN, dan alamat email. Setelah itu, sistem akan mengirimkan email verifikasi untuk mengaktifkan akun.</p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="bg-sky-100 text-sky-600 rounded-full h-10 w-10 flex items-center justify-center font-bold">2</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Lengkapi Data</h3>
                                <p class="text-gray-600 mt-2">Setelah login, calon siswa melengkapi data diri secara menyeluruh meliputi data pribadi, data orang tua/wali, dan data pendidikan sebelumnya. Selanjutnya mengunggah dokumen yang diperlukan dalam format PDF atau gambar.</p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="bg-sky-100 text-sky-600 rounded-full h-10 w-10 flex items-center justify-center font-bold">3</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Verifikasi</h3>
                                <p class="text-gray-600 mt-2">Panitia PPDB akan memverifikasi kelengkapan dan kevalidan data serta dokumen yang diunggah. Calon siswa dapat memantau status verifikasi dokumen melalui dashboard akun masing-masing.</p>
                            </div>
                        </div>
                        
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <div class="bg-sky-100 text-sky-600 rounded-full h-10 w-10 flex items-center justify-center font-bold">4</div>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">Pengumuman</h3>
                                <p class="text-gray-600 mt-2">Hasil seleksi akan diumumkan sesuai jadwal yang telah ditetapkan. Calon siswa dapat melihat hasil seleksi melalui akun masing-masing. Bagi yang dinyatakan lulus, selanjutnya melakukan proses daftar ulang sesuai ketentuan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>