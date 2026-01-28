<?php
require_once __DIR__ . '/../config/db.php';

$q = '%' . ($_GET['q'] ?? '') . '%';

$stmt = $pdo->prepare(
    "SELECT * FROM movies WHERE title LIKE ? OR genre LIKE ?"
);
$stmt->execute([$q, $q]);

echo json_encode($stmt->fetchAll());
