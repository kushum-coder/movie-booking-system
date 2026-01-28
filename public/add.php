<?php
require_once __DIR__ . '/../bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare(
        "INSERT INTO movies (title, genre, release_year) VALUES (?, ?, ?)"
    );
    $stmt->execute([
        trim($_POST['title']),
        trim($_POST['genre']),
        (int) $_POST['release_year']
    ]);

    header('Location: index.php');
    exit;
}

echo $twig->render('form.twig', [
    'heading' => 'Add Movie',
    'button'  => 'Add Movie',
    'movie'   => []
]);
