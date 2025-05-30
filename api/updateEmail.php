<?php
session_start();
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../backend/dbConnection.php';

if (!isset($_SESSION['id'])) {
    echo json_encode(["success" => false, "message" => "User not authenticated."]);
    exit;
}

$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);

if (!is_array($data)) {
    echo json_encode(["success" => false, "message" => "Invalid input."]);
    exit;
}

$newEmail = trim($data['email'] ?? '');

if (!$newEmail || !filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(["success" => false, "message" => "Invalid email."]);
    exit;
}

$userId = $_SESSION['id'];

$stmt = $conn->prepare("UPDATE users SET email = ? WHERE user_id = ?");
$stmt->bind_param("si", $newEmail, $userId);

if ($stmt->execute()) {
    $_SESSION['email'] = $newEmail;
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Database update failed."]);
}

$stmt->close();
$conn->close();