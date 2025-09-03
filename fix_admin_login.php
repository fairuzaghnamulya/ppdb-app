<?php
require_once 'config/database.php';

// Function to update admin password
function updateAdminPassword($conn) {
    // The correct password we want to set
    $newPassword = 'admin123';
    
    // Hash the new password
    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    
    // Update the admin password in the database
    $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = 'admin' AND role = 'admin'");
    $stmt->bind_param("s", $hashedPassword);
    
    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo "SUCCESS: Password admin berhasil diperbarui.\n";
            echo "Username: admin\n";
            echo "Password: admin123\n";
            echo "Hashed Password: " . $hashedPassword . "\n";
        } else {
            echo "ERROR: Admin user tidak ditemukan.\n";
        }
    } else {
        echo "ERROR: Gagal memperbarui password - " . $conn->error . "\n";
    }
    
    $stmt->close();
}

// Function to verify the current admin password
function verifyAdminPassword($conn) {
    echo "Checking current admin user...\n";
    
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = 'admin' AND role = 'admin'");
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo "Found admin user:\n";
        echo "ID: " . $row['id'] . "\n";
        echo "Username: " . $row['username'] . "\n";
        echo "Role: " . $row['role'] . "\n";
        echo "Current Password Hash: " . $row['password'] . "\n";
        
        // Test if 'admin123' matches the current hash
        if (password_verify('admin123', $row['password'])) {
            echo "SUCCESS: Password 'admin123' matches the current hash!\n";
        } else {
            echo "INFO: Password 'admin123' does not match the current hash.\n";
            echo "Updating password...\n";
            updateAdminPassword($conn);
        }
    } else {
        echo "ERROR: Admin user not found in database.\n";
    }
    
    $stmt->close();
}

// Run the verification
verifyAdminPassword($conn);

// Close connection
$conn->close();
?>