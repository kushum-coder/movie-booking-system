<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$_POST['username']]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($_POST['password'], $admin['password'])) {
        $_SESSION['admin'] = $admin['username'];
        header('Location: ../index.php');
        exit;
    } else {
        $error = 'Invalid login';
    }
}
?>
<!DOCTYPE html>
<html>
<body>
<h2>Admin Login</h2>
<form method="post">
    <input name="username" placeholder="Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <button>Login</button>
</form>
<p style="color:red;"><?= $error ?></p>
</body>
</html>
