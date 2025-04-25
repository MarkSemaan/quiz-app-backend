<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$data = json_decode(file_get_contents("php://input"), true);
$title = trim($data['title'] ?? '');

if (!$title) {
    echo json_encode(['error' => 'Title is required.']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO quizzes (title) VALUES (?)");
$stmt->execute([$title]);
$quizId = $pdo->lastInsertId();
echo json_encode(['success' => true, 'quiz_id' => $quizId]);