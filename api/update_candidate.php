<?php
include '../backend/dbConnection.php';

$data = json_decode(file_get_contents('php://input'), true);

// Validate required fields
if (
    isset($data['candidate_id']) &&
    isset($data['first_name']) &&
    isset($data['last_name']) &&
    isset($data['position']) &&
    isset($data['party']) &&
    isset($data['platform'])
) {
    $sql = "UPDATE candidates SET 
                first_name = ?, 
                last_name = ?, 
                position = ?, 
                party = ?, 
                platform = ? 
            WHERE candidate_id = ?";

    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param(
            "sssssi", 
            $data['first_name'], 
            $data['last_name'], 
            $data['position'], 
            $data['party'], 
            $data['platform'], 
            $data['candidate_id']
        );

        if ($stmt->execute()) {
            echo json_encode(["success" => true, "message" => "Candidate updated successfully."]);
        } else {
            echo json_encode(["success" => false, "message" => "Execution failed."]);
        }

        $stmt->close();
    } else {
        echo json_encode(["success" => false, "message" => "Failed to prepare statement."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Missing required fields."]);
}

$conn->close();
?>
