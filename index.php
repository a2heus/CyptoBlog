<?php
include 'config.php';

// Récupérer la recherche si elle existe
$search = $_GET['search'] ?? '';

// Préparer la requête SQL avec recherche
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE title LIKE :search OR content LIKE :search ORDER BY id DESC");
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM articles ORDER BY id DESC");
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fonction pour créer un aperçu sécurisé de l'article
function generatePreview($content, $limit = 200) {
    // Supprimer les balises <script> et leur contenu
    $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
    // Supprimer toutes les autres balises HTML
    $content = strip_tags($content);
    // Troncature du contenu
    $content = mb_strimwidth($content, 0, $limit, '...');
    // Échapper le contenu pour éviter toute exécution
    return htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CryptoBlog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Bienvenue sur CryptoBlog</h1>
    </header>
    <div class="container">
        <!-- Barre de recherche -->
        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Rechercher un article..." value="<?= htmlspecialchars($search) ?>" />
            <button type="submit">Rechercher</button>
        </form>

        <hr>

        <!-- Résultats de la recherche -->
        <?php if ($search): ?>
            <p>Résultats de recherche pour : <strong><?= htmlspecialchars($search) ?></strong></p>
        <?php endif; ?>

        <!-- Liste des articles -->
        <?php if (empty($articles)): ?>
            <p>Aucun article trouvé.</p>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
                <div class="article-preview">
                    <h2>
                        <a href="article.php?id=<?= $article['id'] ?>">
                            <?= htmlspecialchars($article['title']) ?>
                        </a>
                    </h2>
                    <small>
                        <em>Publié le : <?= date('d/m/Y', strtotime($article['created_at'])) ?> | ID : <?= $article['id'] ?></em>
                    </small>
                    <p>
                        <?= generatePreview($article['content']) ?>
                    </p>
                    <a class="read-more" href="article.php?id=<?= $article['id'] ?>">Lire l'article complet</a>
                </div>
                <hr>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>
