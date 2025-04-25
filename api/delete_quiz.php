<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$quiz_id = $_GET['id'] ?? null;
if (!$quiz_id) {
    echo json_encode(['error' => 'Quiz ID required']);
    exit;
}

// Delete scores of quiz first
$stmt = $pdo->prepare("DELETE FROM scores WHERE quiz_id = ?");
$stmt->execute([$quiz_id]);

// Delete questions of quiz
$stmt = $pdo->prepare("DELETE FROM questions WHERE quiz_id = ?");
$stmt->execute([$quiz_id]);

// Delete the quiz
$stmt = $pdo->prepare("DELETE FROM quizzes WHERE id = ?");
$stmt->execute([$quiz_id]);

echo json_encode(['success' => true]);