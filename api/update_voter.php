<?php
include '../backend/dbConnection.php';
header('Content-Type: application/json');

// Get raw POST data
$data = json_decode(file_get_contents('php://input'), true);

if (
    isset($data['id']) &&
    isset($data['email']) &&
    isset($data['sex']) &&
    isset($data['region']) &&
    isset($data['province'])
) {
    $id = intval($data['id']);
    $email = $conn->real_escape_string($data['email']);
    $sex = $conn->real_escape_string($data['sex']);
    $region = $conn->real_escape_string($data['region']);
    $province = $conn->real_escape_string($data['province']);

    $sql = "UPDATE users 
        SET email = '$email', sex = '$sex', region = '$region', province = '$province' 
        WHERE user_id = $id";
    if ($conn->query($sql)) {
        echo json_encode(['success' => true]);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Update failed']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Incomplete data']);
}

$conn->close();
?>