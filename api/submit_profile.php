<?php
include '../backend/dbConnection.php';
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

// Receive JSON input
$data = json_decode(file_get_contents("php://input"), true);
$candidateId = intval($data['candidateId'] ?? 0);
$fullName = trim($data['fullName'] ?? '');
$runningFor = trim($data['runningFor'] ?? '');
$partyList = trim($data['partyList'] ?? '');
$content = trim($data['contentHTML'] ?? '');

if (!$candidateId || !$fullName || !$runningFor || !$partyList || !$content) {
    http_response_code(400);
    echo json_encode(["error" => "All fields are required."]);
    exit();
}

// Check if a profile exists for this candidate
$stmt = $conn->prepare("SELECT * FROM candidate_profiles WHERE candidate_id = ?");
$stmt->bind_param("i", $candidateId);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

if ($result->num_rows > 0) {
    // UPDATE
    $stmt = $conn->prepare("UPDATE candidate_profiles 
                            SET full_name = ?, running_for = ?, party_list = ?, content = ? 
                            WHERE candidate_id = ?");
    $stmt->bind_param("ssssi", $fullName, $runningFor, $partyList, $content, $id);
    $action = "updated";
} else {
    // INSERT
    $stmt = $conn->prepare("INSERT INTO candidate_profiles 
                            (candidate_id, full_name, running_for, party_list, content) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $candidateId, $fullName, $runningFor, $partyList, $content);
    $action = "created";
}

if ($stmt->execute()) {
    echo json_encode([
        "success" => true,
        "message" => "Profile $action.",
        "profile_id" => $action === "created" ? $stmt->insert_id : $candidateId
    ]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Database operation failed."]);
}

$stmt->close();
$conn->close();
?>
