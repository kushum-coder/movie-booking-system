<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../bootstrap.php';

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM cast_members WHERE id=?");
$stmt->execute([$id]);
$cast = $stmt->fetch();

if (!$cast) die('Cast not found');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE cast_members SET name=? WHERE id=?");
    $stmt->execute([trim($_POST['name']), $id]);

    header('Location: index.php');
    exit;
}

echo $twig->render('cast/form.twig', [
    'cast' => $cast
]);
