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
    <html>
    <head>
        <title>Connexion Admin</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="container">
            <h1>Connexion Admin</h1>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form action="admin.php" method="POST">
                <label for="username">Utilisateur :</label>
                <input type="text" id="username" name="username" required>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Se connecter</button>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Panneau d'administration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Panneau d'administration</h1>
    </header>
    <div class="container">
        <h2>Ajouter un article</h2>
        <form action="add_article.php" method="POST">
            <label for="title">Titre :</label>
            <input type="text" id="title" name="title" placeholder="Titre de l'article" required>
            <label for="content">Contenu :</label>
            <textarea id="content" name="content" placeholder="Contenu HTML de l'article" rows="10" required></textarea>
            <button type="submit">Ajouter l'article</button>
        </form>

        <hr>

        <h2>Supprimer un article</h2>
        <form action="delete_article.php" method="POST">
            <label for="id">ID de l'article :</label>
            <input type="number" id="id" name="id" placeholder="ID de l'article" required>
            <button type="submit">Supprimer l'article</button>
        </form>

        <hr>

        <form action="logout.php" method="POST">
            <button type="submit">Se déconnecter</button>
        </form>
    </div>
</body>
</html>
