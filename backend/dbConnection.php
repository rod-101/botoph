<?php
$host = 'sql200.infinityfree.com';
$username = 'if0_39059735';
$password = '2G0o1rxhBKAmt1';
$dbname = 'if0_39059735_botoph';

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$conn->set_charset("utf8mb4");
?>