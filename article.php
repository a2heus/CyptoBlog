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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($article['title']) ?></title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($article['title']) ?></h1>
        <small>
            <em>Publié le : <?= date('d/m/Y', strtotime($article['created_at'])) ?> | ID : <?= $article['id'] ?></em>
        </small>
    </header>
    <div class="container">
        <div class="article-preview">
            <div class="article-content">
                <?= $article['content'] ?>
            </div>
            <a class="read-more" href="index.php">Retour à l'accueil</a>
        </div>
    </div>

    <!-- Bouton de mode sombre/clair -->
    <button id="theme-toggle" aria-label="Changer le mode">
        <i class="fas fa-sun" id="theme-icon"></i>
    </button>

    <script>
        const toggleButton = document.getElementById('theme-toggle');
        const themeIcon = document.getElementById('theme-icon');
        const body = document.body;

        if (localStorage.getItem('theme') === 'dark') {
            body.classList.add('dark-mode');
            themeIcon.classList.replace('fa-sun', 'fa-moon');
        }

        toggleButton.addEventListener('click', () => {
            body.classList.toggle('dark-mode');
            const isDarkMode = body.classList.contains('dark-mode');
            themeIcon.classList.toggle('fa-sun', !isDarkMode);
            themeIcon.classList.toggle('fa-moon', isDarkMode);
            localStorage.setItem('theme', isDarkMode ? 'dark' : 'light');
        });
    </script>
</body>
</html>
