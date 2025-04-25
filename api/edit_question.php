<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

parse_str(file_get_contents("php://input"), $_PUT);
$question_id = $_GET['id'] ?? null;

$question_text = $_PUT['question_text'] ?? '';
$options = json_decode($_PUT['options'] ?? '[]', true);
$correct = $_PUT['correct_answer_index'] ?? null;

if (!$question_id || !$question_text || !is_array($options) || $correct === null) {
    echo json_encode(['error' => 'Missing required fields']);
    exit;
}

$stmt = $pdo->prepare("UPDATE questions SET question_text = ?, options = ?, correct_answer_index = ? WHERE id = ?");
$stmt->execute([$question_text, json_encode($options), $correct, $question_id]);
echo json_encode(['success' => true]);
?>
