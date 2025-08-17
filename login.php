<?php
require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        echo "Invalid credentials.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body { background:#121212; color:#fff; font-family:Arial; }
        .container { width:300px; margin:100px auto; padding:20px; background:#1e1e1e; border-radius:5px; }
        input { width:100%; padding:10px; margin:5px 0; border:none; border-radius:3px; }
        button { background:#444; color:#fff; padding:10px; border:none; border-radius:3px; cursor:pointer; }
    </style>
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>