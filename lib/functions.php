<?php
// lib/functions.php

// Function to authenticate user
function authenticateUser($username, $password) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            return [
                'id' => $row['id'],
                'username' => $row['username'],
                'role' => $row['role']
            ];
        }
    }
    return false;
}

// Function to get user data
function getUserData($user_id) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT id, username, role FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row;
    }
    return false;
}

// Function to get student statistics
function getStudentStatistics($user_id) {
    global $conn;
    
    // Get registration status
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM calon_siswa WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $registration = $result->fetch_assoc();
    
    // Get documents status
    $stmt = $conn->prepare("SELECT COUNT(*) as total, SUM(CASE WHEN status_verifikasi = 'approved' THEN 1 ELSE 0 END) as approved FROM dokumen_siswa ds JOIN calon_siswa cs ON ds.calon_siswa_id = cs.id WHERE cs.user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $documents = $stmt->get_result()->fetch_assoc();
    
    return [
        'registration_status' => $registration['count'] > 0 ? 'Selesai' : 'Belum Selesai',
        'documents_status' => $documents['total'] > 0 ? $documents['approved'] . '/' . $documents['total'] . ' disetujui' : 'Tidak ada dokumen',
        'announcement_status' => 'Tidak ada pengumuman baru'
    ];
}

// Function to register a new user
function registerUser($username, $password, $email, $full_name) {
    global $conn;
    
    // Check if username already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        return ['success' => false, 'message' => 'Username sudah digunakan.'];
    }
    
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, 'siswa')");
    $stmt->bind_param("ss", $username, $hashed_password);
    
    if ($stmt->execute()) {
        // Get the user ID
        $user_id = $conn->insert_id;
        
        // Insert student data
        $stmt = $conn->prepare("INSERT INTO calon_siswa (user_id, nama, tanggal_lahir, jenis_kelamin, alamat, no_telepon) VALUES (?, ?, '', '', '', '')");
        $stmt->bind_param("is", $user_id, $full_name);
        $stmt->execute();
        
        return ['success' => true, 'message' => 'Registrasi berhasil! Silakan login.'];
    } else {
        return ['success' => false, 'message' => 'Registrasi gagal. Silakan coba lagi.'];
    }
}

// Function to get registration settings
function getRegistrationSettings() {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM pengaturan LIMIT 1");
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        return $row;
    }
    return false;
}

// Function to get announcements
function getAnnouncements($limit = 5) {
    global $conn;
    
    $stmt = $conn->prepare("SELECT * FROM pengumuman ORDER BY tanggal DESC LIMIT ?");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $announcements = [];
    while ($row = $result->fetch_assoc()) {
        $announcements[] = $row;
    }
    
    return $announcements;
}
?>