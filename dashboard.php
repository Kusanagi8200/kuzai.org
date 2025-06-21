<?php
require 'db.php';
if (!isset($_SESSION['user_id'])) header('Location: index.php');

$stmt = $pdo->query("SELECT * FROM ia_list ORDER BY name ASC");
$ias = $stmt->fetchAll();
?>

<link rel="stylesheet" href="style.css">
<h2>Base des IA disponibles</h2>

<form method="post" action="add_ia.php">
    <h3>Ajouter une IA</h3>
    <input type="text" name="name" placeholder="Nom de l'IA" required>
    <input type="text" name="url" placeholder="URL de l'IA" required>
    <textarea name="description" placeholder="Description" required></textarea>
    <input type="submit" value="Ajouter">
</form>

<hr>

<h3>Liste des IA</h3>
<ul>
<?php foreach ($ias as $ia): ?>
    <li>
        <strong><?= htmlspecialchars($ia['name']) ?></strong> — 
        <a href="<?= htmlspecialchars($ia['url']) ?>" target="_blank">Accéder</a><br>
        <em><?= htmlspecialchars($ia['description']) ?></em>
    </li>
<?php endforeach; ?>
</ul>

<p><a href="logout.php">Déconnexion</a></p>
