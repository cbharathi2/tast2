<?php
require 'config.php';
require 'functions.php';
require_login();

$id = $_GET['id'];
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);
header("Location: index.php");
exit;
?>