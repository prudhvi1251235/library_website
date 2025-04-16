<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

$books = $conn->query("SELECT * FROM books");
if (!$books) {
    die("Books query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url('https://images.unsplash.com/photo-1523240795612-9a054b0db644') no-repeat center center fixed;
            background-size: cover;
            color: white;
            transition: background 0.3s;
        }

        .dark-mode {
            background: #111 !important;
            color: #ddd !important;
        }

        .container {
            padding: 30px;
            background: rgba(0, 0, 0, 0.75);
            margin: 40px auto;
            width: 90%;
            max-width: 1100px;
            border-radius: 15px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-bar .actions {
            display: flex;
            gap: 10px;
        }

        a.button, button, input[type="submit"] {
            padding: 8px 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            background: #007bff;
            color: white;
            text-decoration: none;
        }

        .logout-btn {
            background: #dc3545;
        }

        h2, h3 {
            text-align: center;
            margin-top: 15px;
        }

        .book-form input {
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            width: 30%;
        }

        .book-form button {
            padding: 10px 20px;
            background: #28a745;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .search-bar {
            margin: 20px 0;
            text-align: center;
        }

        .search-bar input {
            width: 60%;
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: none;
        }

        .book-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .book-card {
            background: #222;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 2px 2px 10px rgba(255,255,255,0.1);
            transition: 0.3s ease;
        }

        .book-card:hover {
            transform: scale(1.02);
        }

        .toggle-btn {
            background: #333;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="top-bar">
        <h2>📚 Welcome Admin: <?= htmlspecialchars($_SESSION['username']); ?></h2>
        <div class="actions">
            <button class="toggle-btn" onclick="toggleMode()">🌓 Mode</button>
            <a class="button" href="borrow_records.php">📖 Borrow Records</a>
            <a class="button logout-btn" href="logout.php">Logout</a>
        </div>
    </div>

    <h3>➕ Add a Book</h3>
    <form class="book-form" action="add_book.php" method="POST">
        <input type="text" name="title" placeholder="Title" required />
        <input type="text" name="author" placeholder="Author" required />
        <input type="text" name="genre" placeholder="Genre" required />
        <button type="submit">Add Book</button>
    </form>

    <div class="search-bar">
        <input type="text" id="searchInput" placeholder="🔍 Search books..." onkeyup="filterBooks()" />
    </div>

    <h3>📘 All Books</h3>
    <div class="book-list" id="bookList">
        <?php while ($book = $books->fetch_assoc()): ?>
            <div class="book-card">
                <h4><?= htmlspecialchars($book['title']); ?></h4>
                <p>Author: <?= htmlspecialchars($book['author']); ?></p>
                <p>Genre: <?= htmlspecialchars($book['genre']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<script>
    function toggleMode() {
        document.body.classList.toggle('dark-mode');
    }

    function filterBooks() {
        const input = document.getElementById("searchInput").value.toLowerCase();
        const cards = document.querySelectorAll(".book-card");
        cards.forEach(card => {
            card.style.display = card.innerText.toLowerCase().includes(input) ? "block" : "none";
        });
    }
</script>
</body>
</html>
