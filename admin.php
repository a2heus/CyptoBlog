<?php
session_start();

// Vérification des identifiants
const ADMIN_USER = 'root';
const ADMIN_PASS = 'root';

// Gestion de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === ADMIN_USER && $password === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Identifiants incorrects.";
    }
}

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion Admin</title>
        <link rel="stylesheet" href="style.css">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <h1>Connexion Admin</h1>
        </header>
        <div class="container">
            <form action="admin.php" method="POST" class="admin-form">
                <?php if (isset($error)): ?>
                    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
                <?php endif; ?>
                <label for="username">Utilisateur :</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>

        <!-- Bouton de mode sombre/clair -->
        <button id="theme-toggle" aria-label="Changer le mode">
            <i class="fas fa-sun" id="theme-icon"></i>
        </button>

        <script>
            const toggleButton = document.getElementById('theme-toggle');
            const themeIcon = document.getElementById('theme-icon');
            const body = document.body;

            // Vérifie le thème stocké
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
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panneau d'administration</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <h1>Panneau d'administration</h1>
    </header>
    <div class="admin-forms-container">
    <form action="add_article.php" method="POST" class="admin-form">
        <h2>Ajouter un article</h2>
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" placeholder="Titre de l'article" required>
        <label for="content">Contenu :</label>
        <textarea id="content" name="content" placeholder="Contenu HTML de l'article" rows="10" required></textarea>
        <button type="submit">Ajouter l'article</button>
    </form>

    <form action="delete_article.php" method="POST" class="admin-form">
        <h2>Supprimer un article</h2>
        <label for="id">ID de l'article :</label>
        <input type="number" id="id" name="id" placeholder="ID de l'article" required>
        <button type="submit">Supprimer l'article</button>
    </form>

    <form action="logout.php" method="POST" class="admin-form">
        <button type="submit">Se déconnecter</button>
    </form>
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
