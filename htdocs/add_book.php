<?php
session_start();
include 'db_connect.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$title = trim($_POST['title'] ?? '');
$author = trim($_POST['author'] ?? '');
$genre = trim($_POST['genre'] ?? '');

if ($title && $author && $genre) {
    $stmt = $conn->prepare("INSERT INTO books (title, author, genre) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $author, $genre);
    $stmt->execute();
}

header("Location: admin_dashboard.php");
exit();
?>
