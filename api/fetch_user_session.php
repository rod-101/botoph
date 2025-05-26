<?php
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

session_start();

$response = [
    'fullname'   => $_SESSION['fullname']   ?? 'Unauthorized',
    'email'      => $_SESSION['email']      ?? 'unauthorized@access.com',
    'isLoggedIn' => $_SESSION['isLoggedIn'] ?? false,
    'role'       => $_SESSION['role']       ?? null
];

echo json_encode($response);
exit;

?>