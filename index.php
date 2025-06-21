<?php
// index.php - page d'accueil avec moteur de recherche et affichage des IA
session_start();
require 'db.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$stmt = $pdo->prepare("SELECT * FROM ia_list WHERE name LIKE ? OR description LIKE ?");
$stmt->execute(["%$query%", "%$query%"]);
$results = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>KuzAI - Recherche IA</title>
    <style>
        body { font-family: Arial, sans-serif; background: linear-gradient(to right, #003366, #336699); color: #fff; margin: 0; padding: 0; }
        header { padding: 20px; text-align: center; background: rgba(0,0,0,0.2); }
        .container { max-width: 800px; margin: auto; padding: 20px; }
        input[type="text"] { width: 80%; padding: 10px; }
        input[type="submit"] { padding: 10px 20px; }
        .ia { background: rgba(255,255,255,0.1); padding: 10px; margin: 10px 0; border-radius: 5px; }
        a { color: #99ccff; }
    </style>
</head>
<body>
<header>
    <h1>KuzAI - Moteur de recherche de chatbots</h1>
</header>
<div class="container">
    <form method="get">
        <input type="text" name="q" placeholder="Rechercher une IA..." value="<?= htmlspecialchars($query) ?>">
        <input type="submit" value="Chercher">
    </form>

    <?php foreach($results as $ia): ?>
        <div class="ia">
            <h2><?= htmlspecialchars($ia['name']) ?></h2>
            <p><?= htmlspecialchars($ia['description']) ?></p>
            <p><a href="<?= htmlspecialchars($ia['url']) ?>" target="_blank">Accéder</a></p>
        </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
    <h3>Ajouter une IA</h3>
    <form method="post" action="add.php">
        <input type="text" name="name" placeholder="Nom de l'IA" required><br>
        <input type="text" name="description" placeholder="Description" required><br>
        <input type="url" name="url" placeholder="URL" required><br>
        <input type="submit" value="Ajouter">
    </form>
    <?php endif; ?>
</div>
</body>
</html>
