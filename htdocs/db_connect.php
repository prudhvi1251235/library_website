<?php
$host = 'sql103.infinityfree.com';
$db = 'if0_38758243_college_library';
$user = 'if0_38758243';
$pass = '1PW4XtOSzN5';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>
