<?php
session_start();
include 'db_connect.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$book_id = intval($_POST['book_id'] ?? 0);
if ($book_id > 0) {
    $conn->query("DELETE FROM books WHERE id = $book_id");
}

header("Location: admin_dashboard.php");
exit();
?>
