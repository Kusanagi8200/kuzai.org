<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) header('Location: index.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO ia_list (name, url, description) VALUES (?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['url'],
        $_POST['description']
    ]);
    header("Location: dashboard.php");
}
