<?php
include 'config.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
$stmt->execute(['id' => $id]);
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "<p>Article introuvable.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= htmlspecialchars($article['title']) ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <small>
            <em>Publié le : <?= date('d/m/Y', strtotime($article['created_at'])) ?> | ID : <?= $article['id'] ?></em>
        </small>
    </header>
    <div class="container">
        <div class="article-content">
            <!-- Affiche le contenu HTML complet, y compris les scripts -->
            <?= $article['content'] ?>
        </div>
        <a href="index.php">Retour à l'accueil</a>
    </div>
</body>
</html>
