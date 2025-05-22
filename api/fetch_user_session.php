<?php
session_start();

echo json_encode([
    'fullname' => $_SESSION['fullname'] ?? 'Guest',
    'email' => $_SESSION['email'] ?? 'guest@gmail.com'
]);

?>