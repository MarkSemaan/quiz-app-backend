<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$quiz_id = $_GET['quiz_id'] ?? null;
if (!$quiz_id) {
    echo json_encode(['error' => 'Quiz ID required.']);
    exit;
}

$stmt = $pdo->prepare("SELECT id, question_text, options, correct_answer_index FROM questions WHERE quiz_id = ?");
$stmt->execute([$quiz_id]);
$questions = $stmt->fetchAll();

foreach ($questions as &$q) {
    $q['options'] = json_decode($q['options']);
}
echo json_encode($questions);