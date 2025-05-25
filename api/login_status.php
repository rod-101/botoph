<?php
session_start();

$response = [
    "isLoggedIn" => isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true
];

header('Content-Type: application/json');
echo json_encode($response);
?>
