<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

include 'db_connect.php';

// Fetch borrow records with student name and book title
$records = $conn->query("
    SELECT u.full_name, u.email, b.title AS book_title, br.borrow_date
    FROM borrowings br
    JOIN users u ON br.user_id = u.id
    JOIN books b ON br.book_id = b.id
    ORDER BY br.borrow_date DESC
");

if (!$records) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Borrow Records</title>
    <style>
        body {
            background: #f3f3f3;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a.back-link {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            background: #007bff;
            color: white;
            padding: 10px 18px;
            border-radius: 6px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📖 Borrow Records</h2>

    <?php if ($records->num_rows > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Email</th>
                <th>Book Title</th>
                <th>Borrowed On</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $records->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['full_name']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= htmlspecialchars($row['book_title']); ?></td>
                    <td><?= $row['borrow_date']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <p>No borrow records found.</p>
    <?php endif; ?>

    <a href="admin_dashboard.php" class="back-link">⬅ Back to Dashboard</a>
</div>
</body>
</html>
