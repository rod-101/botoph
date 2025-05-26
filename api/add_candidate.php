<?php
include '../backend/dbConnection.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");


file_put_contents('debug.log', ""); // Clears it
file_put_contents('debug.log', print_r($_POST, true), FILE_APPEND);
file_put_contents('debug.log', print_r($_FILES, true), FILE_APPEND);


$data = $_POST;

if(isset($_POST)) {
    echo 'there is file ' . $data['fname'];
} else { echo 'there is no file';}

// Get values from $_POST
$fname = trim($_POST['fname'] ?? '');
$lname = trim($_POST['lname'] ?? '');
$position = trim($_POST['position'] ?? '');
$party = trim($_POST['party'] ?? '') ?: 'Independent';
$platform = trim($_POST['platform'] ?? '') ?: 'No platform';
$photoUrl = null;

// Validate required fields
if (empty($fname) || empty($lname) || empty($position)) {
    http_response_code(400);
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// Handle file upload if exists
if (isset($_FILES['photoUpload']) && $_FILES['photoUpload']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../assets/candidates/';
    $fileTmpPath = $_FILES['photoUpload']['tmp_name'];
    
    // Sanitize filename: fname + lname (lowercased, no spaces) + .jpg
    $fileName = strtolower(str_replace(' ', '', $fname . $lname)) . '.jpg';
    $destPath = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        $photoUrl = $fileName;
    } else {
        http_response_code(500);
        echo json_encode(["error" => "Failed to save uploaded file."]);
        exit;
    }
}

// Prepare insert query
$stmt = $conn->prepare("INSERT INTO candidates (first_name, last_name, position, party, platform, photo_url) VALUES (?, ?, ?, ?, ?, ?)");
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