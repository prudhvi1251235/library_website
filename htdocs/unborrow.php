<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

$user_id = $_SESSION['user_id'];
$book_id = intval($_POST['book_id']);

$conn->query("DELETE FROM borrowings WHERE user_id = $user_id AND book_id = $book_id");

header("Location: dashboard.php");
exit();
?>
