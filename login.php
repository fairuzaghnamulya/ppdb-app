<?php
session_start();
require 'config/database.php';
require 'lib/functions.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $error = "Username and password are required.";
    } else {
        $user = authenticateUser($username, $password);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['username'] = $user['username'];
            
            // Redirect based on user role
            if ($user['role'] === 'admin') {
                header('Location: dashboard_admin.php');
            } else {
                header('Location: dashboard_siswa.php');
            }
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPDB Online 2025</title>
    
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
                <h1 class="text-4xl font-bold">Selamat Datang Kembali</h1>
                <p class="mt-4 max-w-md mx-auto">Masuk ke akun Anda untuk memantau status pendaftaran dan melihat pengumuman terbaru.</p>
            </div>
        </div>

        <!-- Right Column: Login Form -->
        <div class="flex w-full lg:w-1/2 items-center justify-center p-8 sm:p-12">
            <div class="w-full max-w-md">
                <div class="lg:hidden text-center mb-8">
                     <a href="index.php" class="inline-flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-sky-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                        </svg>
                        <span class="text-xl font-bold text-gray-800">PPDB Online</span>
                    </a>
                </div>

                <h2 class="text-3xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h2>
                <p class="text-gray-600 mb-8">Silakan masukkan detail akun Anda di bawah ini.</p>

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

                <form action="login.php" method="POST" class="space-y-6">
                    <div>
                        <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                        <input type="text" name="username" id="username" required placeholder="Masukkan username Anda" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                    </div>

                    <div>
                         <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Kata Sandi</label>
                            <a href="#" class="text-sm text-sky-600 hover:underline">Lupa kata sandi?</a>
                        </div>
                        <input type="password" name="password" id="password" required placeholder="Masukkan kata sandi Anda" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                    </div>

                    <div>
                        <button type="submit" class="w-full bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                            Masuk
                        </button>
                    </div>
                </form>

                <div class="text-center mt-8">
                    <p class="text-gray-600">Belum punya akun? <a href="register.php" class="font-semibold text-sky-600 hover:underline">Daftar di sini</a></p>
                </div>
            </div>
        </div>
    </div>

</body>
</html>