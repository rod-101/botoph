<?php
include '../backend/dbConnection.php';

header('Content-Type: application/json; charset=utf-8'); // Set content type first

$sql = "SELECT candidate_id, first_name, last_name, CONCAT(first_name, ' ', last_name) AS fullname, position, party, platform, photo_url, page_url FROM candidates";
$result = $conn->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $response[] = [
            'id' => $row['candidate_id'],
            'firstName' => $row['first_name'],
            'lastName' => $row['last_name'],
            'fullname' => $row['fullname'],
            'position' => $row['position'],
            'party' => $row['party'],
            'platform' => $row['platform'],
            'photoUrl' => $row['photo_url'],
            'pageUrl' => $row['page_url']
        ];
    }
}

$conn->close();

echo json_encode($response);
exit();
