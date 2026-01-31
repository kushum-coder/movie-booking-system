<?php
session_start();

if (empty($_SESSION['admin'])) {
    header('Location: /movie-booking-system/public/admin/login.php');
    exit;
}
