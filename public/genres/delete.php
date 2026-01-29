<?php
require_once __DIR__ . '/../admin/auth.php';
require_once __DIR__ . '/../../config/db.php';

$stmt = $pdo->prepare("DELETE FROM genres WHERE id=?");
$stmt->execute([(int)$_GET['id']]);

header('Location: index.php');
exit;
