<?php
require 'config.php';
require 'functions.php';
require_login();

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
    <style>
        body { background:#121212; color:#fff; font-family:Arial; }
        .container { width:400px; margin:100px auto; padding:20px; background:#1e1e1e; border-radius:5px; }
        input, textarea { width:100%; padding:10px; margin:5px 0; border:none; border-radius:3px; }
        button { background:#444; color:#fff; padding:10px; border:none; border-radius:3px; cursor:pointer; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Post</h2>
    <form method="post">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required><br>
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea><br>
        <button type="submit">Update</button>
    </form>
</div>
</body>
</html>