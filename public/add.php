<?php
require_once __DIR__ . '/../bootstrap.php';

$errors = [];

/* FETCH GENRES & CAST */
$genres = $pdo->query("SELECT id, name FROM genres ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);
$casts  = $pdo->query("SELECT id, name FROM cast_members ORDER BY name")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!csrf_check($_POST['csrf'] ?? '')) {
        $errors[] = 'Invalid CSRF token';
    }

    $title    = trim($_POST['title'] ?? '');
    $genre_id = (int)($_POST['genre_id'] ?? 0);
    $cast_id  = (int)($_POST['cast_id'] ?? 0);
    $year     = trim($_POST['release_year'] ?? '');
    $rating   = $_POST['rating'] !== '' ? (float)$_POST['rating'] : null;

    if (!preg_match('/^[A-Za-z0-9 ]{2,100}$/', $title)) {
        $errors[] = 'Title must contain only letters, numbers and spaces';
    }

    if ($genre_id <= 0) {
        $errors[] = 'Please select a genre';
    }

    if ($cast_id <= 0) {
        $errors[] = 'Please select a cast member';
    }

    if (!preg_match('/^\d{4}$/', $year)) {
        $errors[] = 'Release year must be a 4-digit year';
    }

    if ($rating !== null && ($rating < 0 || $rating > 10)) {
        $errors[] = 'Rating must be between 0 and 10';
    }

    if (!$errors) {
        $stmt = $pdo->prepare(
            "INSERT INTO movies (title, genre_id, cast_id, release_year, rating)
             VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->execute([$title, $genre_id, $cast_id, $year, $rating]);

        header('Location: index.php');
        exit;
    }
}

echo $twig->render('form.twig', [
    'heading' => 'Add Movie',
    'button'  => 'Add Movie',
    'movie'   => $_POST,
    'genres'  => $genres,
    'casts'   => $casts,
    'errors'  => $errors,
    'csrf'    => csrf_token()
]);
