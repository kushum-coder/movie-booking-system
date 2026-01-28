<?php
require_once __DIR__ . '/../bootstrap.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    die("Movie not found");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "UPDATE movies SET title=?, genre=?, release_year=? WHERE id=?"
    );
    $stmt->execute([
        trim($_POST['title']),
        trim($_POST['genre']),
        (int) $_POST['release_year'],
        $id
    ]);

    header('Location: index.php');
    exit;
}

echo $twig->render('form.twig', [
    'heading' => 'Edit Movie',
    'button'  => 'Update Movie',
    'movie'   => $movie
]);
