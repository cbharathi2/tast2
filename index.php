<?php
require 'config.php';
require 'functions.php';
require_login();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['content'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $pdo->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
}

$posts = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Blog</title>
    <style>
        body { background:#121212; color:#fff; font-family:Arial; }
        .container { width:600px; margin:20px auto; }
        .post { background:#1e1e1e; margin:10px 0; padding:10px; border-radius:5px; }
        input, textarea { width:100%; padding:10px; margin:5px 0; border:none; border-radius:3px; }
        button { background:#444; color:#fff; padding:10px; border:none; border-radius:3px; cursor:pointer; }
    </style>
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo $_SESSION['username']; ?>! <a href="logout.php" style="color:#f00;">Logout</a></h2>

    <h3>Create Post</h3>
    <form method="post">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <button type="submit">Post</button>
    </form>

    <h3>All Posts</h3>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <h3><?php echo htmlspecialchars($post['title']); ?></h3>
            <p><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <small><?php echo $post['created_at']; ?></small><br>
            <a href="edit.php?id=<?php echo $post['id']; ?>" style="color:#0f0;">Edit</a> |
            <a href="delete.php?id=<?php echo $post['id']; ?>" style="color:#f00;">Delete</a>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>