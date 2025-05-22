<?php
include '../backend/dbConnection.php';
$data = json_decode(file_get_contents('php://input'), true);

if(isset($data['status'])) {
    $status = $conn->real_escape_string($data['status']);
    $id = $conn->real_escape_string($data['id']);

    $sql = "UPDATE users SET status = $status WHERE user_id = $id";
    if($conn->query($sql)) {
        echo json_encode(['success' => true, 'massage'=> "Updated voter's status"]);
    } else {
        http_response_code(500);
        echo json_encode(['error:'=> 'Update failed.']);
    }
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Status is not set.']);
}

$conn->close();
?>