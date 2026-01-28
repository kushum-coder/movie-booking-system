<?php
require_once __DIR__ . '/../config/db.php';

$id = (int) ($_GET['id'] ?? 0);

$stmt = $pdo->prepare("DELETE FROM movies WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;
