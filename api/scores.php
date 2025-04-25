<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$sql = "SELECT u.email, q.title, s.percentage FROM scores s
        JOIN users u ON s.user_id = u.id
        JOIN quizzes q ON s.quiz_id = q.id
        ORDER BY u.email, q.title";

$stmt = $pdo->query($sql);
$scores = $stmt->fetchAll();

$grouped = [];
foreach ($scores as $row) {
    $email = $row['email'];
    if (!isset($grouped[$email])) {
        $grouped[$email] = [];
    }
    $grouped[$email][] = [
        'quiz' => $row['title'],
        'score' => $row['percentage']
    ];
}
echo json_encode($grouped);