<?php
// Include database connection
include 'db_connect.php';

// Handle form POST submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and collect form data
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');
    $role = trim($_POST['role'] ?? ''); // New role field

    // Server-side validation
    if (empty($full_name) || empty($email) || empty($password) || empty($role)) {
        echo "<p style='color:red;'>⚠️ All fields are required, including role.</p>";
        exit;
    }

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<p style='color:red;'>⚠️ Email already registered. Please login.</p>";
        exit;
    }

    // Hash password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert into database with selected role
    $stmt = $conn->prepare("INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $full_name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        echo "<p style='color:green;'>✅ Registered successfully as <strong>$role</strong>. <a href='login.html'>Login here</a></p>";
    } else {
        echo "<p style='color:red;'>❌ Error during registration.</p>";
    }

    $stmt->close();
}
?>
