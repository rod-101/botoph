<?php
include '../backend/dbConnection.php';

// Define utf8ize to recursively fix encoding issues
function utf8ize($mixed) {
    if (is_array($mixed)) {
        foreach ($mixed as $key => $value) {
            $mixed[$key] = utf8ize($value);
        }
    } elseif (is_string($mixed)) {
        return mb_convert_encoding($mixed, 'UTF-8', 'UTF-8, ISO-8859-1, Windows-1252');
    }
    return $mixed;
}

$sql = "SELECT candidate_id, first_name, last_name, CONCAT(first_name, ' ', last_name) AS fullname, position, party, platform, photo_url FROM candidates;";
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
            'photoUrl' => $row['photo_url']
        ];
    }
} else {
    $response = [];
}

$conn->close();

// Sanitize data before encoding
$response = utf8ize($response);

header('Content-Type: application/json');

$json = json_encode($response);
if ($json === false) {
    echo 'json_encode failed: ' . json_last_error_msg();
} else {
    echo $json;
}

exit();
