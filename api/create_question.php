<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$data = json_decode(file_get_contents("php://input"), true);
$quiz_id = $data['quiz_id'] ?? null;
$text = $data['question_text'] ?? '';
$options = $data['options'] ?? [];
$correct = $data['correct_answer_index'] ?? null;

if (!$quiz_id || !$text || count($options) < 2 || $correct === null) {
    echo json_encode(['error' => 'Missing required fields.']);
    exit;
}

$stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text, options, correct_answer_index) VALUES (?, ?, ?, ?)");
$stmt->execute([$quiz_id, $text, json_encode($options), $correct]);
echo json_encode(['success' => true]);