<?php
include '../backend/dbConnection.php';

// Prepare the SQL query
$sql = "SELECT CONCAT(first_name, ' ', last_name) AS full_name, email, created_at FROM users WHERE role = 'voter'";
$result = $conn->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'joined' => date("F j, Y", strtotime($row['created_at']))
        ];
    }
} else {
    // Return empty array or message
    $response = [];
}

// Close DB connection
$conn->close();

// Set content type header to JSON
header('Content-Type: application/json');

// Output JSON response
echo json_encode($response);
exit();
