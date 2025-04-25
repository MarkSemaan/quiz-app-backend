<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$question_id = $_GET['id'] ?? null;
if (!$question_id) {
    echo json_encode(['error' => 'Question ID required']);
    exit;
}

$stmt = $pdo->prepare("DELETE FROM questions WHERE id = ?");
$stmt->execute([$question_id]);
echo json_encode(['success' => true]);
?>
