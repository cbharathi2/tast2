<?php
require 'config.php';
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $password])) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: Could not register user.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body { background:#121212; color:#fff; font-family:Arial; }
        .container { width:300px; margin:100px auto; padding:20px; background:#1e1e1e; border-radius:5px; }
        input { width:100%; padding:10px; margin:5px 0; border:none; border-radius:3px; }
        button { background:#444; color:#fff; padding:10px; border:none; border-radius:3px; cursor:pointer; }
    </style>
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
</div>
</body>
</html>