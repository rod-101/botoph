<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$charset = 'utf8mb4';

$remote = [
    'host' => 'sql200.infinityfree.com',
    'username' => 'if0_39059735',
    'password' => '2G0o1rxhBKAmt1',
    'dbname' => 'if0_39059735_botoph'
];
$local = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'dbname' => 'botoph'
];
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];


try {
    $dsn = "mysql:host={$local['host']};dbname={$local['dbname']};charset=$charset";
    $pdo = new PDO($dsn, $local['username'], $local['password'], $options);
} catch(PDOException $e) {
    try {
        $dsn = "mysql:host={$remote['host']};dbname={$remote['dbname']};charset=$charset";
        $pdo = new PDO($dsn, $remote['username'], $remote['password'], $options);
    } catch(PDOException $e1) {
        echo json_encode(['error' => $e1.getMessage()]);
    }
}

try {
    // Get the type from the URL (default to 'daily')
    $type = $_GET['type'] ?? 'daily';

    // Determine SQL based on the type
    switch ($type) {
        case 'weekly':
            $stmt = $pdo->query("
                SELECT 
                    DATE_FORMAT(created_at, '%Y-%u') AS week,
                    COUNT(*) AS count
                FROM users
                GROUP BY week
                ORDER BY week ASC
            ");

            $labels = [];
            $counts = [];

            foreach ($stmt as $row) {
                $year = substr($row['week'], 0, 4);
                $week = substr($row['week'], 5);
                $labels[] = "Week $week ($year)";
                $counts[] = $row['count'];
            }
            break;
        default: // daily
            $stmt = $pdo->query("
                SELECT 
                    DATE_FORMAT(created_at, '%Y-%m-%d') AS day,
                    COUNT(*) AS count
                FROM users
                GROUP BY day
                ORDER BY day ASC
            ");

            $labels = [];
            $counts = [];

            foreach ($stmt as $row) {
                $labels[] = $row['day'];
                $counts[] = $row['count'];
            }
            break;
    }

    echo json_encode([
        "labels" => $labels,
        "counts" => $counts
    ]);

} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
