<?php
require_once __DIR__ . '/admin/auth.php';
require_once __DIR__ . '/../bootstrap.php';

$genres = $pdo->query("SELECT * FROM genres")->fetchAll();
$casts  = $pdo->query("SELECT * FROM cast_members")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $year = (int) $_POST['release_year'];
    if ($year <= 0) {
        die('Invalid year');
    }

    $stmt = $pdo->prepare(
        "INSERT INTO movies (title, genre_id, cast_id, release_year, rating)
         VALUES (?, ?, ?, ?, ?)"
    );

    $stmt->execute([
        trim($_POST['title']),
        (int) $_POST['genre_id'],
        (int) $_POST['cast_id'],
        $year,
        (float) $_POST['rating']
    ]);

    header('Location: index.php');
    exit;
}

echo $twig->render('form.twig', [
    'genres' => $genres,
    'casts'  => $casts,
    'movie'  => []
]);
