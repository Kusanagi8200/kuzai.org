<?php
$pdo = new PDO('mysql:host=localhost;dbname=kuzai;charset=utf8', 'root', 'motdepasse');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
