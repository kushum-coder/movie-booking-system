<?php
require_once __DIR__ . '/../bootstrap.php';

$results = [];
$query = '';

if (isset($_GET['query']) && $_GET['query'] !== '') {
    $query = trim($_GET['query']);
    $like = '%' . $query . '%';

    $stmt = $pdo->prepare(
        "SELECT * FROM movies
         WHERE title LIKE ? OR genre LIKE ?
         ORDER BY id DESC"
    );
    $stmt->execute([$like, $like]);
    $results = $stmt->fetchAll();
}

echo $twig->render('movies.twig', [
    'movies' => $results
]);
