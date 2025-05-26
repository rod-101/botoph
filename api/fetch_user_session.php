<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['role'] !== 'admin') {
    echo json_encode([
        'isLoggedIn' => false,
        'redirect' => '../views/unauthorized.html'
    ]);
    exit;
}

echo json_encode([
    'fullname' => $_SESSION['fullname'] ?? 'Guest',
    'email' => $_SESSION['email'] ?? 'guest@gmail.com',
    'isLoggedIn' => true,
    'role' => $_SESSION['role']
]);
?>