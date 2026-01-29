<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    if ($name === '') die('Genre required');

    $stmt = $pdo->prepare("INSERT INTO genres (name) VALUES (?)");
    $stmt->execute([$name]);

    header('Location: index.php');
    exit;
}

echo $twig->render('genres/form.twig', [
    'genre' => []
]);
