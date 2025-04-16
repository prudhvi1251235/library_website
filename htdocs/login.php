<?php
// Start the session
session_start();

// Include DB connection
include 'db_connect.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize input
    $email = trim($_POST['email'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Server-side validation
    if (empty($email) || empty($password)) {
        echo "<p style='color:red;'>⚠️ Please fill in all fields.</p>";
        exit;
    }

    // Prepare query to check user
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    if (!$stmt) {
        die("❌ SQL error: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    // Check if user found
    if ($res->num_rows === 1) {
        $user = $res->fetch_assoc();

        // Check hashed password
        if (password_verify($password, $user['password'])) {
            // Save user session info
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if ($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit();
        } else {
            echo "<p style='color:red;'>❌ Invalid password. Please try again.</p>";
        }
    } else {
        echo "<p style='color:red;'>❌ No account found with that email.</p>";
    }

    $stmt->close();
}
?>
