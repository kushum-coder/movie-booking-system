<?php
require_once __DIR__ . '/admin/auth.php';
require_once __DIR__ . '/../bootstrap.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch();

if (!$movie) {
    die('Movie not found');
}

$genres = $pdo->query("SELECT * FROM genres")->fetchAll();
$casts  = $pdo->query("SELECT * FROM cast_members")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $year = (int) $_POST['release_year'];
    if ($year <= 0) {
        die('Invalid year');
    }

    $stmt = $pdo->prepare(
        "UPDATE movies
         SET title=?, genre_id=?, cast_id=?, release_year=?, rating=?
         WHERE id=?"
    );

    $stmt->execute([
        trim($_POST['title']),
        (int) $_POST['genre_id'],
        (int) $_POST['cast_id'],
        $year,
        (float) $_POST['rating'],
        $id
    ]);

    header('Location: index.php');
    exit;
}

echo $twig->render('form.twig', [
    'movie'  => $movie,
    'genres' => $genres,
    'casts'  => $casts
]);
