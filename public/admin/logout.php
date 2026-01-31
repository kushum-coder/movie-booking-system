<?php
session_start();
$_SESSION = [];
session_destroy();

header('Location: /movie-booking-system/public/admin/login.php');
exit;
