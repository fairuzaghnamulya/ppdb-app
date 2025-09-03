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
$stmt = $conn->prepare("SELECT id FROM calon_siswa WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Handle document upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['document'])) {
    $document_name = trim($_POST['document_name']);
    $document_file = $_FILES['document'];
    
    if (empty($document_name)) {
        $error = "Nama dokumen harus diisi.";
    } elseif ($document_file['error'] !== UPLOAD_ERR_OK) {
        $error = "Terjadi kesalahan saat mengunggah dokumen.";
    } else {
        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'pdf'];
        $file_extension = strtolower(pathinfo($document_file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_types)) {
            $error = "Format file tidak didukung. Gunakan JPG, JPEG, PNG, atau PDF.";
        } else {
            // Validate file size (max 2MB)
            if ($document_file['size'] > 2 * 1024 * 1024) {
                $error = "Ukuran file terlalu besar. Maksimal 2MB.";
            } else {
                // Create uploads directory if it doesn't exist
                if (!is_dir('uploads')) {
                    mkdir('uploads', 0777, true);
                }
                
                // Generate unique filename
                $filename = uniqid() . '_' . $document_file['name'];
                $upload_path = 'uploads/' . $filename;
                
                // Move uploaded file
                if (move_uploaded_file($document_file['tmp_name'], $upload_path)) {
                    // Save document info to database
                    $stmt = $conn->prepare("INSERT INTO dokumen_siswa (calon_siswa_id, nama_dokumen, file_path) VALUES (?, ?, ?)");
                    $stmt->bind_param("iss", $student['id'], $document_name, $upload_path);
                    
                    if ($stmt->execute()) {
                        $success = "Dokumen berhasil diunggah.";
                    } else {
                        $error = "Gagal menyimpan informasi dokumen.";
                        // Delete uploaded file if database insert fails
                        unlink($upload_path);
                    }
                } else {
                    $error = "Gagal mengunggah dokumen.";
                }
            }
        }
    }
}

// Get student documents
$stmt = $conn->prepare("SELECT * FROM dokumen_siswa WHERE calon_siswa_id = ? ORDER BY id DESC");
$stmt->bind_param("i", $student['id']);
$stmt->execute();
$result = $stmt->get_result();

$documents = [];
while ($row = $result->fetch_assoc()) {
    $documents[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dokumen Saya - PPDB Online 2025</title>
    
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
                <h1 class="text-3xl font-bold text-gray-900">Dokumen Saya</h1>
                <p class="text-gray-600 mt-2">Unggah dan kelola dokumen yang diperlukan untuk pendaftaran</p>
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

            <!-- Upload Form -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Unggah Dokumen Baru</h2>
                
                <form action="documents.php" method="POST" enctype="multipart/form-data" class="space-y-4">
                    <div>
                        <label for="document_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Dokumen</label>
                        <input type="text" name="document_name" id="document_name" required placeholder="Contoh: Ijazah SMP, Kartu Keluarga, dll." class="w-full px-4 py-2 rounded-lg border-2 border-gray-200 focus:outline-none focus:border-sky-500 transition">
                    </div>
                    
                    <div>
                        <label for="document" class="block text-sm font-medium text-gray-700 mb-1">Pilih File</label>
                        <label class="file-input-label">
                            <span class="text-sm">Pilih file... (Max. 2MB, Format: JPG, JPEG, PNG, PDF)</span>
                            <input id="document" name="document" type="file" required class="sr-only">
                        </label>
                    </div>
                    
                    <div>
                        <button type="submit" class="bg-sky-600 text-white font-semibold px-6 py-3 rounded-lg hover:bg-sky-700 transition">
                            Unggah Dokumen
                        </button>
                    </div>
                </form>
            </div>

            <!-- Documents List -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Dokumen yang Telah Diunggah</h2>
                
                <?php if (count($documents) > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Dokumen</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Unggah</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php foreach ($documents as $document): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($document['nama_dokumen']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($document['status_verifikasi'] == 'pending'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Menunggu
                                                </span>
                                            <?php elseif ($document['status_verifikasi'] == 'approved'): ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Disetujui
                                                </span>
                                            <?php else: ?>
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Ditolak
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo date('d F Y H:i', strtotime($document['id'])); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="<?php echo htmlspecialchars($document['file_path']); ?>" target="_blank" class="text-sky-600 hover:text-sky-900">
                                                Lihat
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <p class="mt-4 text-gray-600">Belum ada dokumen yang diunggah</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <?php include 'templates/partials/footer_tailwind.php'; ?>
</body>
</html>