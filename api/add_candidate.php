<?php
include '../backend/dbConnection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data['fname']) ||
    !isset($data['lname']) ||
    !isset($data['position'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

$fname = trim($data['fname']);
$lname = trim($data['lname']);
$position = trim($data['position']);
$party = isset($data['party']) ? trim($data['party']) : null;
$platform = isset($data['platform']) ? trim($data['platform']) : null;
$photoUrl = isset($data['photoUrl']) ? trim($data['photoUrl']) : null;

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$stmt = $conn->prepare("INSERT INTO candidates (first_name, last_name, position, party, platform, photoUrl) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $fname, $lname, $position, $party, $platform, $photoUrl);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Candidate added successfully"]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to add candidate"]);
}

$stmt->close();
$conn->close();
?>
