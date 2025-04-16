<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'student') {
    header("Location: login.php");
    exit();
}
include 'db_connect.php';

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Count how many books user already borrowed
$borrow_check = $conn->query("SELECT COUNT(*) AS total FROM borrowings WHERE user_id = $user_id");
$borrowed_total = $borrow_check->fetch_assoc()['total'];

// Get all books
$books = $conn->query("SELECT * FROM books");

// Get user's borrowed books
$borrowed_books = $conn->query("SELECT book_id FROM borrowings WHERE user_id = $user_id");
$borrowed_ids = [];
while ($b = $borrowed_books->fetch_assoc()) {
    $borrowed_ids[] = $b['book_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>📚 Student Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      background-image: url('https://images.unsplash.com/photo-1512820790803-83ca734da794');
      background-size: cover;
      background-attachment: fixed;
      color: #fff;
      transition: background 0.3s ease;
    }
    .dark-mode {
      background: #111 !important;
      color: #ddd;
    }
    .navbar {
      background: rgba(0, 0, 0, 0.8);
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      color: white;
    }
    .container {
      padding: 20px;
      backdrop-filter: blur(10px);
    }
    .book-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }
    .book-card {
      background: rgba(0, 0, 0, 0.6);
      border-radius: 10px;
      padding: 15px;
      transition: transform 0.2s;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }
    .book-card:hover {
      transform: scale(1.05);
    }
    .book-card img {
      width: 100%;
      height: 160px;
      object-fit: cover;
      border-radius: 5px;
    }
    .book-card h3 {
      margin: 10px 0 5px;
    }
    .book-card button {
      padding: 8px 12px;
      background: #00aaff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      margin-top: 10px;
    }
    .book-card button[disabled] {
      background: gray;
      cursor: not-allowed;
    }
    #searchInput {
      padding: 10px;
      width: 100%;
      max-width: 400px;
      margin: 20px 0;
      border-radius: 8px;
      border: none;
    }
    .mode-toggle {
      cursor: pointer;
      padding: 5px 10px;
      background: #333;
      color: #fff;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <span>📚 Welcome, <?= htmlspecialchars($username) ?> 👋</span>
    <div>
      <span class="mode-toggle" onclick="toggleMode()">🌓 Mode</span>
      <a href="logout.php" style="color:white; margin-left: 20px;">Logout</a>
    </div>
  </div>

  <div class="container">
    <h2>📘 Available Books</h2>
    <p>You can borrow up to 4 books. Currently borrowed: <strong><?= $borrowed_total ?></strong></p>

    <input type="text" id="searchInput" placeholder="Search books..." onkeyup="filterBooks()">

    <div class="book-grid" id="bookList">
      <?php while ($book = $books->fetch_assoc()): ?>
        <div class="book-card">
          <img src="https://source.unsplash.com/300x200/?book,<?= urlencode($book['title']) ?>" alt="Book">
          <h3><?= htmlspecialchars($book['title']) ?></h3>
          <p><strong>Author:</strong> <?= $book['author'] ?></p>
          <p><strong>Genre:</strong> <?= $book['genre'] ?></p>

          <?php if (in_array($book['id'], $borrowed_ids)): ?>
            <form method="POST" action="unborrow.php">
              <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
              <button type="submit" style="background:#ff6666;">Unborrow</button>
            </form>
          <?php elseif ($borrowed_total >= 4): ?>
            <button disabled>Limit Reached</button>
          <?php else: ?>
            <form method="POST" action="borrow.php">
              <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
              <button type="submit">Borrow</button>
            </form>
          <?php endif; ?>
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script>
    function filterBooks() {
      const input = document.getElementById("searchInput").value.toLowerCase();
      const cards = document.querySelectorAll(".book-card");
      cards.forEach(card => {
        card.style.display = card.innerText.toLowerCase().includes(input) ? "block" : "none";
      });
    }
    function toggleMode() {
      document.body.classList.toggle("dark-mode");
    }
  </script>
</body>
</html>
