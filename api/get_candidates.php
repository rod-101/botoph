<?php
include '../backend/dbConnection.php';

$sql = "SELECT candidate_id, CONCAT(first_name, ' ', last_name) AS full_name, position, party, birthdate, photo_url, page_url FROM candidates";
$result = $conn->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => $row['candidate_id'],
            'fullname' => $row['full_name'],
            'position' => $row['position'],
            'party' => $row['party'],
            'age' => date_diff(date_create($row['birthdate']), date_create('today'))->y,
            'photoUrl' => strtolower('../assets/' . str_replace(' ', '', $row['full_name']) . '.jpg'),
            'pageUrl' => strtolower('candidates/' . str_replace(' ', '', $row['full_name']) . '.html')
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
