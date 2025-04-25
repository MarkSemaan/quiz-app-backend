<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$data = json_decode(file_get_contents("php://input"), true);
$user_id = $data['user_id'] ?? null;
$quiz_id = $data['quiz_id'] ?? null;
$percentage = $data['percentage'] ?? null;

if (!$user_id || !$quiz_id || $percentage === null) {
    echo json_encode(['error' => 'All fields required.']);
    exit;
}

$stmt = $pdo->prepare("REPLACE INTO scores (user_id, quiz_id, percentage) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $quiz_id, $percentage]);
echo json_encode(['success' => true]);
?>

