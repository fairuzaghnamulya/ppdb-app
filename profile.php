<?php
session_start();
require_once 'config/database.php';
require_once 'lib/functions.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if user is student
if ($_SESSION['user_role'] !== 'siswa') {
    header("Location: dashboard_" . $_SESSION['user_role'] . ".php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Get student data
$stmt = $conn->prepare("SELECT cs.*, u.username FROM calon_siswa cs JOIN users u ON cs.user_id = u.id WHERE cs.user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Get parent data
$stmt = $conn->prepare("SELECT * FROM data_orangtua WHERE calon_siswa_id = ?");
$stmt->bind_param("i", $student['id']);
$stmt->execute();
$result = $stmt->get_result();
$parent = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Student data
    $nama = trim($_POST['nama']);
    $tanggal_lahir = trim($_POST['tanggal_lahir']);
    $jenis_kelamin = trim($_POST['jenis_kelamin']);
    $alamat = trim($_POST['alamat']);
    $no_telepon = trim($_POST['no_telepon']);
    
    // Parent data
    $nama_ayah = trim($_POST['nama_ayah']);
    $nama_ibu = trim($_POST['nama_ibu']);
    $pekerjaan_ayah = trim($_POST['pekerjaan_ayah']);
    $pekerjaan_ibu = trim($_POST['pekerjaan_ibu']);
    
    // Update student data
    $stmt = $conn->prepare("UPDATE calon_siswa SET nama = ?, tanggal_lahir = ?, jenis_kelamin = ?, alamat = ?, no_telepon = ? WHERE user_id = ?");
    $stmt->bind_param("sssssi", $nama, $tanggal_lahir, $jenis_kelamin, $alamat, $no_telepon, $user_id);
    
    if ($stmt->execute()) {
        // Update or insert parent data
        if ($parent) {
            // Update existing parent data
            $stmt = $conn->prepare("UPDATE data_orangtua SET nama_ayah = ?, nama_ibu = ?, pekerjaan_ayah = ?, pekerjaan_ibu = ? WHERE calon_siswa_id = ?");
            $stmt->bind_param("ssssi", $nama_ayah, $nama_ibu, $pekerjaan_ayah, $pekerjaan_ibu, $student['id']);
        } else {
            // Insert new parent data
            $stmt = $conn->prepare("INSERT INTO data_orangtua (calon_siswa_id, nama_ayah, nama_ibu, pekerjaan_ayah, pekerjaan_ibu) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("issss", $student['id'], $nama_ayah, $nama_ibu, $pekerjaan_ayah, $pekerjaan_ibu);
        }
        
        if ($stmt->execute()) {
            $success = "Data profil berhasil diperbarui.";
            
            // Refresh data
            $stmt = $conn->prepare("SELECT cs.*, u.username FROM calon_siswa cs JOIN users u ON cs.user_id = u.id WHERE cs.user_id = ?");
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();
            $student = $result->fetch_assoc();
            
            $stmt = $conn->prepare("SELECT * FROM data_orangtua WHERE calon_siswa_id = ?");
            $stmt->bind_param("i", $student['id']);
            $stmt->execute();
            $result = $stmt->get_result();
            $parent = $result->fetch_assoc();
        } else {
            $error = "Gagal memperbarui data orang tua.";
        }
    } else {
        $error = "Gagal memperbarui data siswa.";
    }
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Saya - PPDB Online 2025</title>
    
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
        .sidebar {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <?php include 'templates/partials/header_tailwind.php'; ?>

    <div class="container mx-auto px-6 py-8 flex flex-col md:flex-row gap-8">
        <!-- Sidebar -->
        <?php include 'templates/partials/sidebar_siswa.php'; ?>

        <!-- Main Content -->
        <main class="flex-1">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Profil Saya</h1>
                <p class="text-gray-600 mt-2">Kelola informasi pribadi Anda</p>
            </div>

            <?php if (!empty($success)): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
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
            <?php endif; ?>
            
            <?php if (!empty($error)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
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

            <div class="bg-white rounded-xl shadow-md p-6">
                <form action="profile.php" method="POST">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Data Siswa</h2>
                            
                            <div class="mb-4">
                                <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($student['username']); ?>" disabled class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 bg-gray-100 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                                <input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($student['nama']); ?>" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo htmlspecialchars($student['tanggal_lahir']); ?>" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition bg-white">
                                    <option value="L" <?php echo $student['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>Laki-laki</option>
                                    <option value="P" <?php echo $student['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>Perempuan</option>
                                </select>
                            </div>
                            
                            <div class="mb-4">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="3" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition"><?php echo htmlspecialchars($student['alamat']); ?></textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="no_telepon" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                                <input type="text" name="no_telepon" id="no_telepon" value="<?php echo htmlspecialchars($student['no_telepon']); ?>" class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                        </div>
                        
                        <div>
                            <h2 class="text-xl font-bold text-gray-900 mb-4">Data Orang Tua</h2>
                            
                            <div class="mb-4">
                                <label for="nama_ayah" class="block text-sm font-medium text-gray-700 mb-1">Nama Ayah</label>
                                <input type="text" name="nama_ayah" id="nama_ayah" value="<?php echo htmlspecialchars($parent['nama_ayah'] ?? ''); ?>" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="nama_ibu" class="block text-sm font-medium text-gray-700 mb-1">Nama Ibu</label>
                                <input type="text" name="nama_ibu" id="nama_ibu" value="<?php echo htmlspecialchars($parent['nama_ibu'] ?? ''); ?>" required class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="pekerjaan_ayah" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ayah</label>
                                <input type="text" name="pekerjaan_ayah" id="pekerjaan_ayah" value="<?php echo htmlspecialchars($parent['pekerjaan_ayah'] ?? ''); ?>" class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                            
                            <div class="mb-4">
                                <label for="pekerjaan_ibu" class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan Ibu</label>
                                <input type="text" name="pekerjaan_ibu" id="pekerjaan_ibu" value="<?php echo htmlspecialchars($parent['pekerjaan_ibu'] ?? ''); ?>" class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <button type="submit" class="bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>