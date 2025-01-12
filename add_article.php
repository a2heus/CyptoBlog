<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $pdo->prepare("INSERT INTO articles (title, content) VALUES (:title, :content)");
    $stmt->execute(['title' => $title, 'content' => $content]);

    header('Location: admin.php');
    exit;
}
?>
