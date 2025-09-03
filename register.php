<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';

// If user is already logged in, redirect to dashboard
if (isset($_SESSION['user_id'])) {
    $user_role = $_SESSION['user_role'];
    header("Location: dashboard_$user_role.php");
    exit();
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);
    $full_name = trim($_POST['full_name']);
    
    // Validate input
    if (empty($username) || empty($password) || empty($confirm_password) || empty($full_name)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } elseif (strlen($password) < 6) {
        $error = "Password must be at least 6 characters long.";
    } else {
        // Register user
        $result = registerUser($username, $password, '', $full_name);
        
        if ($result['success']) {
            $success = $result['message'];
        } else {
            $error = $result['message'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - PPDB Online 2025</title>
    
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
        /* Custom style for file input */
        .file-input-label {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            border: 2px dashed #d1d5db;
            background-color: #f9fafb;
            color: #4b5563;
            cursor: pointer;
            transition: all .2s;
        }
        .file-input-label:hover {
            border-color: #3b82f6;
            background-color: #eff6ff;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50">

    <div class="flex min-h-screen">
        <!-- Left Column: Welcome Text Only -->
        <div class="hidden lg:flex w-1/2 items-center justify-center bg-sky-600 p-12 text-white relative">
            <div class="absolute top-8 left-8">
                 <a href="index.php" class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    <span class="text-xl font-bold">PPDB Online</span>
                </a>
            </div>
            <div class="text-center">
                <h1 class="text-4xl font-bold">Satu Langkah Lagi</h1>
                <p class="mt-4 max-w-md mx-auto">Buat akun Anda untuk memulai proses pendaftaran yang cepat, mudah, dan transparan.</p>
            </div>
        </div>

        <!-- Right Column: Registration Form -->
        <div class="flex w-full lg:w-1/2 items-center justify-center p-8 sm:p-12">
            <div class="w-full max-w-xl">
                <div class="lg:hidden text-center mb-8">
                     <a href="index.php" class="inline-flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">PPDB Online</span>
                    </a>
                </div>

                <?php if (!empty($success)): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6">
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
                    <div class="text-center">
                        <a href="login.php" class="inline-block bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                            Lanjut ke Login
                        </a>
                    </div>
                <?php else: ?>
                    <?php if (!empty($error)): ?>
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
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

                    <div x-data="{ step: 1, totalSteps: 2 }" x-cloak>
                        <!-- Progress Header -->
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-1">
                                <h2 class="text-2xl font-bold text-gray-900">Formulir Pendaftaran</h2>
                                <p class="text-sm font-medium text-gray-600">Langkah <span x-text="step"></span> dari <span x-text="totalSteps"></span></p>
                            </div>
                            <div class="bg-gray-200 rounded-full h-2">
                                <div class="bg-sky-600 h-2 rounded-full transition-all duration-500" :style="`width: ${(step / totalSteps) * 100}%`"></div>
                            </div>
                        </div>
                        
                        <form action="register.php" method="POST">
                            <div class="min-h-[450px]">
                                <!-- Step 1: Data Akun -->
                                <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="space-y-6">
                                    <h3 class="text-xl font-semibold text-gray-800">1. Data Akun</h3>
                                     <div>
                                        <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap Siswa</label>
                                        <input type="text" name="full_name" id="full_name" required placeholder="Sesuai Akta Kelahiran" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                                    </div>
                                    <div>
                                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                        <input type="text" name="username" id="username" required placeholder="Username untuk login" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                                    </div>
                                    <div>
                                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Buat Kata Sandi</label>
                                        <input type="password" name="password" id="password" required placeholder="Minimal 6 karakter" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                                    </div>
                                    <div>
                                        <label for="confirm_password" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                                        <input type="password" name="confirm_password" id="confirm_password" required placeholder="Ulangi kata sandi Anda" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                                    </div>
                                </div>

                                <!-- Step 2: Konfirmasi -->
                                <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="space-y-6">
                                    <h3 class="text-xl font-semibold text-gray-800">2. Konfirmasi & Persetujuan</h3>
                                    <div class="p-4 bg-yellow-50 border-l-4 border-yellow-500 text-yellow-800 rounded-r-lg">
                                        <p class="text-sm font-semibold">Periksa Kembali Data Anda</p>
                                        <p class="text-sm mt-1">Pastikan semua data yang Anda masukkan sudah benar sebelum menyelesaikan pendaftaran. Data tidak dapat diubah setelah dikirim.</p>
                                    </div>
                                     <div class="flex items-start pt-2">
                                        <input id="terms" name="terms" type="checkbox" required class="h-4 w-4 mt-1 text-sky-600 focus:ring-sky-500 border-gray-300 rounded">
                                        <label for="terms" class="ml-3 block text-sm text-gray-900">
                                            Saya menyatakan bahwa semua data yang diisi adalah benar dan menyetujui <a href="#" class="font-semibold text-sky-600 hover:underline">Syarat & Ketentuan</a> yang berlaku.
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Buttons -->
                            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-between items-center">
                                <button type="button" @click="step--" :class="{'invisible': step === 1}" class="border border-gray-300 text-gray-700 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition">
                                    Kembali
                                </button>
                              
                                <button type="button" @click="step++" x-show="step < totalSteps" class="bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                                    Selanjutnya
                                </button>
                                
                                <button type="submit" x-show="step === totalSteps" class="bg-green-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-green-700 transition">
                                    Selesaikan Pendaftaran
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-6">
                            <p class="text-gray-600">Sudah punya akun? <a href="login.php" class="font-semibold text-sky-600 hover:underline">Masuk di sini</a></p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>
</html>