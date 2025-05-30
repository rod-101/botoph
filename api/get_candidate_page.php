<?php
include '../backend/dbConnection.php';
header('Content-Type: application/json');

$candidateId = $_GET['id'] ?? $_POST['id'] ?? null;

if (!$candidateId) {
    http_response_code(400);
    echo json_encode(['error' => 'Candidate ID is required.']);
    exit();
}

$stmt = $conn->prepare("SELECT candidate_id, full_name, running_for, party_list, content, created_at, updated_at FROM candidate_profiles WHERE candidate_id = ?");
$stmt->bind_param("i", $candidateId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    http_response_code(404);
    echo json_encode(['error' => 'This candidate does not have a profile page.']);
    exit();
}

$profile = $result->fetch_assoc();
// $profile['content'] = nl2br(htmlspecialchars($profile['content']));
echo json_encode($profile);



$stmt->close();
$conn->close();