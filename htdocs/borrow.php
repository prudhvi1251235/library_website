<?php
session_start();
include 'db_connect.php';

// Only allow logged-in students
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id'] ?? 0);

// Check current borrow count
$check = $conn->query("SELECT COUNT(*) AS total FROM borrowings WHERE user_id = $user_id");
$count = $check->fetch_assoc()['total'];

if ($count < 4) {
    // Check if already borrowed
    $dupe = $conn->query("SELECT id FROM borrowings WHERE user_id = $user_id AND book_id = $book_id");
    if ($dupe->num_rows === 0) {
        // Insert borrow record
        $stmt = $conn->prepare("INSERT INTO borrowings (user_id, book_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $book_id);
        $stmt->execute();
    }
}

// Redirect back to dashboard
header("Location: dashboard.php");
exit();
?>
