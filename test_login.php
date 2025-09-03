<?php
require_once 'config/database.php';
require_once 'lib/functions.php';

echo "Testing admin login...
";

// Test authentication
$username = 'admin';
$password = 'admin123';

echo "Attempting to authenticate user: $username with password: $password
";

$user = authenticateUser($username, $password);

if ($user) {
    echo "SUCCESS: Authentication successful!
";
    echo "User ID: " . $user['id'] . "
";
    echo "Username: " . $user['username'] . "
";
    echo "Role: " . $user['role'] . "
";
} else {
    echo "FAILED: Authentication failed.
";
    
    // Let's debug further
    echo "Debugging...
";
    
    // Check if user exists
    $stmt = $conn->prepare("SELECT id, username, password, role FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo "User found in database:
";
        echo "ID: " . $row['id'] . "
";
        echo "Username: " . $row['username'] . "
";
        echo "Role: " . $row['role'] . "
";
        echo "Password Hash: " . $row['password'] . "
";
        
        // Test password verification
        if (password_verify($password, $row['password'])) {
            echo "Password verification: SUCCESS
";
        } else {
            echo "Password verification: FAILED
";
            echo "Expected password: $password
";
        }
    } else {
        echo "User not found in database.
";
    }
}

$conn->close();
?>
