<?php
    header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
    header("Pragma: no-cache"); // HTTP 1.0
    header("Expires: 0"); // Proxies
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *'); // Adjust this for production security

    // Database connection
$host = 'sql200.infinityfree.com';
$username = 'if0_39059735';
$password = '2G0o1rxhBKAmt1';
$dbname = 'if0_39059735_botoph';
$charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    try {
        $pdo = new PDO($dsn, $username, $password, $options);

        // Get total users
        $stmt = $pdo->query("SELECT COUNT(*) AS total FROM users");
        $total = $stmt->fetch()['total'];

        // Get by role
        $roles = ['voter', 'moderator', 'admin'];
        $counts = ['total' => $total];

        foreach ($roles as $role) {
            $stmt = $pdo->prepare("SELECT COUNT(*) AS count FROM users WHERE role = ?");
            $stmt->execute([$role]);
            $counts[$role . 's'] = $stmt->fetch()['count'];
        }

        echo json_encode($counts);

    } catch (\PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
?>