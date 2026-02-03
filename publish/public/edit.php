<?php
require_once __DIR__ . '/../bootstrap.php';

$id = (int)($_GET['id'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM movies WHERE id = ?");
$stmt->execute([$id]);
$movie = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$movie) {
    die('Movie not found');
}

$genres = $pdo->query("SELECT id, name FROM genres ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$casts  = $pdo->query("SELECT id, name FROM cast_members ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'] ?? '')) {
        $errors[] = 'Invalid CSRF token';
    }

    $title    = trim($_POST['title'] ?? '');
    $genre_id = (int)$_POST['genre_id'];
    $cast_id  = (int)$_POST['cast_id'];
    $year     = trim($_POST['release_year']);
    $rating   = $_POST['rating'] !== '' ? (float)$_POST['rating'] : null;

    if (!preg_match('/^[A-Za-z0-9 ]{2,100}$/', $title)) {
        $errors[] = 'Invalid title';
    }

    if (!preg_match('/^\d{4}$/', $year)) {
        $errors[] = 'Invalid release year';
    }

    if ($rating !== null && ($rating < 0 || $rating > 10)) {
        $errors[] = 'Invalid rating';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "UPDATE movies
             SET title=?, genre_id=?, cast_id=?, release_year=?, rating=?
             WHERE id=?"
        );
        $stmt->execute([$title, $genre_id, $cast_id, $year, $rating, $id]);

        header('Location: index.php');
        exit;
    }
}

echo $twig->render('form.twig', [
    'heading' => 'Edit Movie',
    'button'  => 'Update Movie',
    'movie'   => $movie,
    'genres'  => $genres,
    'casts'   => $casts,
    'errors'  => $errors,
    'csrf'    => csrf_token()
]);
