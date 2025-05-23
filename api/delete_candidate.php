<?php
include '../backend/dbConnection.php';

// Enable CORS if this API is used cross-origin
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

// Get the raw POST body and decode JSON
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (!isset($data['id'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing candidate ID"]);
    exit;
}

$candidateId = intval($data['id']);

// Prepare DELETE statement
$stmt = $conn->prepare("DELETE FROM candidates WHERE candidate_id = ?");
$stmt->bind_param("i", $candidateId);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Candidate deleted successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to delete candidate"]);
}

$stmt->close();
$conn->close();
?>
