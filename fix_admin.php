<?php
require_once 'config/database.php';

// Function to update admin password
function updateAdminPassword($conn, $username, $newPassword) {
    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Update the admin password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ? AND role = 'admin'");
    $stmt->bind_param("ss", $hashedPassword, $username);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            return [
                'success' => true,
                'message' => 'Password admin berhasil diperbarui.',
                'username' => $username,
                'new_password' => $newPassword,
                'hashed_password' => $hashedPassword
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Admin dengan username tersebut tidak ditemukan.'
            ];
        }
    } else {
        return [
            'success' => false,
            'message' => 'Gagal memperbarui password: ' . $conn->error
        ];
    }
}

// Check if form is submitted
$result = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $newPassword = $_POST['new_password'] ?? '';
    
    if (!empty($username) && !empty($newPassword)) {
        $result = updateAdminPassword($conn, $username, $newPassword);
    } else {
        $result = [
            'success' => false,
            'message' => 'Username dan password baru harus diisi.'
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fix Admin Login - PPDB</title>
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
                <h1 class="text-3xl font-bold text-gray-900">Fix Admin Login</h1>
                <p class="text-gray-600 mt-2">Perbarui password admin untuk mengakses dashboard</p>
            </div>

            <?php if ($result): ?>
                <?php if ($result['success']): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-700"><?php echo htmlspecialchars($result['message']); ?></p>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Username: <strong><?php echo htmlspecialchars($result['username']); ?></strong></p>
                                    <p>Password: <strong><?php echo htmlspecialchars($result['new_password']); ?></strong></p>
                                </div>
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
                                <p class="text-sm text-red-700"><?php echo htmlspecialchars($result['message']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username Admin</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="admin" 
                        required 
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition"
                        placeholder="Masukkan username admin">
                </div>
                
                <div>
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        value="admin123" 
                        required 
                        class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition"
                        placeholder="Masukkan password baru">
                </div>
                
                <div>
                    <button 
                        type="submit" 
                        class="w-full bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                        Perbarui Password
                    </button>
                </div>
            </form>
            
            <div class="mt-8 pt-6 border-t border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900 mb-3">Instruksi:</h2>
                <ol class="list-decimal list-inside space-y-2 text-sm text-gray-600">
                    <li>Masukkan username admin (biasanya "admin")</li>
                    <li>Masukkan password baru yang diinginkan (misalnya "admin123")</li>
                    <li>Klik tombol "Perbarui Password"</li>
                    <li>Gunakan kredensial baru untuk login</li>
                </ol>
                
                <div class="mt-4 p-4 bg-yellow-50 rounded-lg">
                    <p class="text-sm text-yellow-700">
                        <strong>Catatan:</strong> Untuk keamanan, ubah password admin setelah berhasil login.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>