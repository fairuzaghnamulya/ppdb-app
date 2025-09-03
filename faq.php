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
    <title>FAQ - PPDB Online 2025</title>
    
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
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <main>
        <!-- FAQ Section -->
        <section class="py-20">
            <div class="container mx-auto px-6">
                <div class="text-center mb-12">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Frequently Asked Questions (FAQ)</h1>
                    <p class="text-gray-600 mt-2 max-w-2xl mx-auto">Temukan jawaban atas pertanyaan yang paling sering diajukan.</p>
                </div>
                <div class="max-w-3xl mx-auto space-y-4" x-data="{ selected: null }">
                    <!-- FAQ Item 1 -->
                    <div class="bg-white rounded-lg shadow-md">
                        <button @click="selected = (selected === 1 ? null : 1)" class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-semibold text-lg">Bagaimana cara membuat akun PPDB?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 1 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="selected === 1" x-collapse class="px-6 pb-6 text-gray-600">
                            <p>Anda dapat membuat akun dengan mengklik tombol "Daftar Sekarang" di pojok kanan atas halaman. Anda akan diminta untuk mengisi data diri awal seperti NIK dan alamat email.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="bg-white rounded-lg shadow-md">
                        <button @click="selected = (selected === 2 ? null : 2)" class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-semibold text-lg">Dokumen apa saja yang diperlukan?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 2 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="selected === 2" x-collapse class="px-6 pb-6 text-gray-600">
                            <p>Dokumen umum yang diperlukan antara lain Kartu Keluarga, Akta Kelahiran, dan Ijazah/SKL jenjang sebelumnya. Persyaratan spesifik untuk setiap jalur dapat dilihat pada halaman panduan.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 3 -->
                    <div class="bg-white rounded-lg shadow-md">
                        <button @click="selected = (selected === 3 ? null : 3)" class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-semibold text-lg">Bagaimana jika saya lupa kata sandi?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 3 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="selected === 3" x-collapse class="px-6 pb-6 text-gray-600">
                            <p>Pada halaman login, terdapat tautan "Lupa Kata Sandi". Klik tautan tersebut dan ikuti instruksi yang akan dikirimkan ke alamat email yang Anda daftarkan.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 4 -->
                    <div class="bg-white rounded-lg shadow-md">
                        <button @click="selected = (selected === 4 ? null : 4)" class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-semibold text-lg">Berapa kuota pendaftaran setiap jalur?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 4 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="selected === 4" x-collapse class="px-6 pb-6 text-gray-600">
                            <p>Kuota pendaftaran setiap jalur ditentukan berdasarkan kebijakan Dinas Pendidikan setempat. Informasi lebih lanjut dapat dilihat di halaman pengumuman resmi.</p>
                        </div>
                    </div>
                    <!-- FAQ Item 5 -->
                    <div class="bg-white rounded-lg shadow-md">
                        <button @click="selected = (selected === 5 ? null : 5)" class="w-full flex justify-between items-center text-left p-6">
                            <span class="font-semibold text-lg">Kapan hasil seleksi akan diumumkan?</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform" :class="{ 'rotate-180': selected === 5 }" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </button>
                        <div x-show="selected === 5" x-collapse class="px-6 pb-6 text-gray-600">
                            <p>Hasil seleksi akan diumumkan sesuai dengan jadwal yang telah ditetapkan. Pastikan Anda secara berkala mengecek halaman pengumuman di portal PPDB untuk mendapatkan informasi terkini.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>