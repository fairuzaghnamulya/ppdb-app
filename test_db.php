<?php
require_once 'config/database.php';

// Test database connection
function testDatabaseConnection($conn) {
    if ($conn->connect_error) {
        return [
            'success' => false,
            'message' => 'Koneksi database gagal: ' . $conn->connect_error
        ];
    }
    
    // Test a simple query
    $result = $conn->query("SELECT COUNT(*) as count FROM users");
    if ($result) {
        $row = $result->fetch_assoc();
        return [
            'success' => true,
            'message' => 'Koneksi database berhasil!',
            'user_count' => $row['count']
        ];
    } else {
        return [
            'success' => false,
            'message' => 'Query gagal: ' . $conn->error
        ];
    }
}

$connectionResult = testDatabaseConnection($conn);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Database Connection - PPDB</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-xl shadow-lg p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Test Koneksi Database</h1>
                <p class="text-gray-600 mt-2">Memverifikasi koneksi ke database PPDB</p>
            </div>

            <?php if ($connectionResult['success']): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700"><?php echo htmlspecialchars($connectionResult['message']); ?></p>
                            <p class="text-sm text-green-700 mt-1">Jumlah user dalam database: <?php echo $connectionResult['user_count']; ?></p>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700"><?php echo htmlspecialchars($connectionResult['message']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mt-6">
                <a href="fix_admin.php" class="block w-full text-center bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition mb-4">
                    Perbaiki Admin Login
                </a>
                <a href="index.php" class="block w-full text-center bg-gray-200 text-gray-800 font-semibold px-6 py-3 rounded-lg hover:bg-gray-300 transition">
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>