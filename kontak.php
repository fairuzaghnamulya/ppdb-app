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
    <title>Kontak - PPDB Online 2025</title>
    
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
        .contact-card {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <main>
        <!-- Contact Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Hubungi Kami</h1>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Punya pertanyaan? Jangan ragu untuk menghubungi kami melalui saluran berikut.</p>
                </div>
                
                <div class="max-w-4xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Contact Information -->
                    <div class="contact-card bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>
                        
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900">Telepon</h3>
                                    <p class="text-gray-600 mt-1">(021) 765-4321</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900">Email</h3>
                                    <p class="text-gray-600 mt-1">ppdb@kotacerdas.go.id</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900">Alamat</h3>
                                    <p class="text-gray-600 mt-1">Dinas Pendidikan Kota Cerdas<br>Jl. Pendidikan No. 1, Indonesia</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start">
                                <div class="bg-sky-100 text-sky-600 rounded-lg h-12 w-12 flex items-center justify-center flex-shrink-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="font-semibold text-gray-900">Jam Operasional</h3>
                                    <p class="text-gray-600 mt-1">Senin - Jumat: 08.00 - 16.00 WIB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Contact Form -->
                    <div class="contact-card bg-white p-8 rounded-xl shadow-lg border border-gray-200">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>
                        
                        <form class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" id="name" required placeholder="Masukkan nama Anda" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                <input type="email" id="email" required placeholder="Masukkan alamat email Anda" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subjek</label>
                                <input type="text" id="subject" required placeholder="Masukkan subjek pesan" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Pesan</label>
                                <textarea id="message" rows="4" required placeholder="Tulis pesan Anda di sini..." class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition"></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        
    </main>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>