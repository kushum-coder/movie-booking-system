<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../bootstrap.php';

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM genres WHERE id=?");
$stmt->execute([$id]);
$genre = $stmt->fetch();

if (!$genre) die('Genre not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE genres SET name=? WHERE id=?");
    $stmt->execute([trim($_POST['name']), $id]);

    header('Location: index.php');
    exit;
}

echo $twig->render('genres/form.twig', [
    'genre' => $genre
]);
