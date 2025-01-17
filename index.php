<?php
include 'config.php';

$search = $_GET['search'] ?? '';

// sql search
if ($search) {
    $stmt = $pdo->prepare("SELECT * FROM articles WHERE title LIKE :search OR content LIKE :search ORDER BY id DESC");
    $stmt->execute(['search' => '%' . $search . '%']);
} else {
    $stmt = $pdo->query("SELECT * FROM articles ORDER BY id DESC");
}

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

function generatePreview($content, $limit = 200) {
    $content = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $content);
    $content = strip_tags($content);
    $content = mb_strimwidth($content, 0, $limit, '...');
    return htmlspecialchars($content, ENT_QUOTES, 'UTF-8');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CryptoBlog</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
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

        <!-- recherche result -->
        <?php if ($search): ?>
            <p>Résultats de recherche pour : <strong><?= htmlspecialchars($search) ?></strong></p>
        <?php endif; ?>

        <!-- list -->
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

    <!-- dark mode -->
    <button id="theme-toggle" aria-label="Changer le mode">
        <i class="fas fa-sun" id="theme-icon"></i>
    </button>

    <!-- particules qui marchent pas -->
    <div class="particles"></div>

    <script>
        // script dark mode
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

            if (isDarkMode) {
                themeIcon.classList.replace('fa-sun', 'fa-moon');
                localStorage.setItem('theme', 'dark');
            } else {
                themeIcon.classList.replace('fa-moon', 'fa-sun');
                localStorage.setItem('theme', 'light');
            }
        });

        // particules qui marchent pas 
        const particlesContainer = document.querySelector('.particles');
        for (let i = 0; i < 50; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = `${Math.random() * 100}%`;
            particle.style.top = `${Math.random() * 100}%`;
            particle.style.animationDelay = `${Math.random() * 5}s`;
            particle.style.animationDuration = `${3 + Math.random() * 5}s`;
            particlesContainer.appendChild(particle);
        }
    </script>

    <footer>
    <p>&copy; 2025 CryptoBlog - made with ❤ by <a href="https://github.com/a2heus/CyptoBlog" target="_blank" rel="noopener noreferrer">Marceau</a></p>
    </footer>
</body>
</html>
