<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

parse_str(file_get_contents("php://input"), $_PUT);
$quiz_id = $_GET['id'] ?? null;
$title = $_PUT['title'] ?? null;

if (!$quiz_id || !$title) {
    echo json_encode(['error' => 'Quiz ID and title required']);
    exit;
}

$stmt = $pdo->prepare("UPDATE quizzes SET title = ? WHERE id = ?");
$stmt->execute([$title, $quiz_id]);
echo json_encode(['success' => true]);
?>
