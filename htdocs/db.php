<?php
$host = 'sql103.infinityfree.com';  // FROM your InfinityFree MySQL info
$db = 'if0_38758243_college_library';
$user = 'if0_38758243';
$pass = '1PW4XtOSzN5';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>
