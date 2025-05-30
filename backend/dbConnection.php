<?php

// Localhost credentials
$localHost = 'localhost';
$localUsername = 'root'; // Change if different
$localPassword = '';     // Change if your local MySQL has a password
$localDbname = 'botoph'; // Change to your local database name

$host = 'sql200.infinityfree.com';
$username = 'if0_39059735';
$password = '2G0o1rxhBKAmt1';
$dbname = 'if0_39059735_botoph';

//try local connection
$conn = new mysqli($localHost, $localUsername, $localPassword, $localDbname);

if($conn->connect_error) {
    
    // create remote connection
    $conn = new mysqli($host, $username, $password, $dbname);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
}
$conn->set_charset("utf8mb4");
?>