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
    <title>Jalur Pendaftaran - PPDB Online 2025</title>
    
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
        .feature-card {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <main>
        <!-- Information / Features Section -->
        <section class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Jalur Pendaftaran PPDB 2025</h1>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Pilih jalur pendaftaran yang sesuai dengan kriteria calon peserta didik.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Feature Card 1: Zonasi -->
                    <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Jalur Zonasi</h3>
                        <p class="text-gray-600 mb-4">Bagi calon siswa yang berdomisili di dalam wilayah zonasi yang telah ditetapkan pemerintah daerah.</p>
                        <a href="#" class="text-sky-600 font-medium hover:text-sky-800">Selengkapnya →</a>
                    </div>
                    <!-- Feature Card 2: Afirmasi -->
                    <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Jalur Afirmasi</h3>
                        <p class="text-gray-600 mb-4">Untuk calon siswa dari keluarga ekonomi tidak mampu dan penyandang disabilitas.</p>
                        <a href="#" class="text-sky-600 font-medium hover:text-sky-800">Selengkapnya →</a>
                    </div>
                    <!-- Feature Card 3: Prestasi -->
                    <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                           <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Jalur Prestasi</h3>
                        <p class="text-gray-600 mb-4">Bagi calon siswa yang memiliki prestasi akademik maupun non-akademik yang diakui.</p>
                        <a href="#" class="text-sky-600 font-medium hover:text-sky-800">Selengkapnya →</a>
                    </div>
                    <!-- Feature Card 4: Perpindahan Orang Tua -->
                    <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Perpindahan Orang Tua</h3>
                        <p class="text-gray-600 mb-4">Untuk calon siswa yang orang tuanya pindah domisili karena mutasi kerja.</p>
                        <a href="#" class="text-sky-600 font-medium hover:text-sky-800">Selengkapnya →</a>
                    </div>
                    <!-- Feature Card 5: Siswa Luar Negeri -->
                    <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Siswa Luar Negeri</h3>
                        <p class="text-gray-600 mb-4">Bagi calon siswa warga negara Indonesia yang baru kembali dari luar negeri.</p>
                        <a href="#" class="text-sky-600 font-medium hover:text-sky-800">Selengkapnya →</a>
                    </div>
                    <!-- Feature Card 6: Tahfidz Qur'an -->
                    <div class="feature-card bg-gray-50 p-8 rounded-xl shadow-lg border border-gray-200">
                        <div class="bg-sky-100 text-sky-600 rounded-full h-16 w-16 flex items-center justify-center mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2 text-gray-900">Tahfidz Qur'an</h3>
                        <p class="text-gray-600 mb-4">Untuk calon siswa yang memiliki sertifikat hafalan Al-Qur'an minimal 5 Juz.</p>
                        <a href="#" class="text-sky-600 font-medium hover:text-sky-800">Selengkapnya →</a>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Requirements Section -->
        <section class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Persyaratan Umum</h2>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Berikut adalah persyaratan umum yang harus dipenuhi oleh semua calon peserta didik.</p>
                </div>
                
                <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <div class="bg-sky-100 text-sky-600 rounded-full h-6 w-6 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="ml-4 text-gray-700">Warga Negara Indonesia (WNI)</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-sky-100 text-sky-600 rounded-full h-6 w-6 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="ml-4 text-gray-700">Berusia maksimal 21 tahun pada tanggal 1 Juli 2025</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-sky-100 text-sky-600 rounded-full h-6 w-6 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="ml-4 text-gray-700">Memiliki ijazah/surat keterangan lulus jenjang sebelumnya</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-sky-100 text-sky-600 rounded-full h-6 w-6 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="ml-4 text-gray-700">Sehat jasmani dan rohani dibuktikan dengan surat keterangan dokter</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-sky-100 text-sky-600 rounded-full h-6 w-6 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="ml-4 text-gray-700">Mengisi formulir pendaftaran secara online dengan data yang sebenar-benarnya</span>
                        </li>
                        <li class="flex items-start">
                            <div class="bg-sky-100 text-sky-600 rounded-full h-6 w-6 flex items-center justify-center flex-shrink-0 mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <span class="ml-4 text-gray-700">Melengkapi dokumen persyaratan sesuai jalur pendaftaran yang dipilih</span>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </main>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>