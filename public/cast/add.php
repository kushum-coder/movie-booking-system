<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO cast_members (name) VALUES (?)");
    $stmt->execute([trim($_POST['name'])]);

    header('Location: index.php');
    exit;
}

echo $twig->render('cast/form.twig', [
    'cast' => []
]);
