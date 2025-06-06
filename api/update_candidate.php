<?php
include '../backend/dbConnection.php';

$data = $_POST; // FormData sends data here

// Sanitize inputs
$candidateId = $data['candidate_id'] ?? null;
$firstName   = $data['fname'] ?? '';
$lastName    = $data['lname'] ?? '';
$position    = $data['position'] ?? '';
$party       = $data['party'] ?? 'Independent';
$platform    = $data['platform'] ?? 'No platform';

$photoUrl = '';
if (isset($_FILES['photoUpload']) && $_FILES['photoUpload']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../assets/candidates/';
    $fileTmpPath = $_FILES['photoUpload']['tmp_name'];
    $fileName = strtolower(str_replace(' ', '', $firstName . $lastName)) . '.jpg';
    $destPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        $photoUrl = $fileName;
    }
}

if ($candidateId && $firstName && $lastName && $position && $party && $platform) {

    // Determine SQL based on whether photoUrl is set
    if (!empty($photoUrl)) {
        $sql = "UPDATE candidates SET 
                    first_name = ?, 
                    last_name = ?, 
                    position = ?, 
                    party = ?, 
                    platform = ?,
                    photo_url = ?
                WHERE candidate_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $firstName, $lastName, $position, $party, $platform, $photoUrl, $candidateId);
    } else {
        $sql = "UPDATE candidates SET 
                    first_name = ?, 
                    last_name = ?, 
                    position = ?, 
                    party = ?, 
                    platform = ?
                WHERE candidate_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $firstName, $lastName, $position, $party, $platform, $candidateId);
    }

    if ($stmt && $stmt->execute()) {
        echo json_encode(["success" => true, "message" => "Candidate updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Execution failed."]);
    }

    $stmt->close();
} else {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
}

$conn->close();

?>
