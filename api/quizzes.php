<?php
header("Content-Type: application/json");
require_once "../config/db_connection.php";

$stmt = $pdo->query("SELECT id, title FROM quizzes");
$quizzes = $stmt->fetchAll();
echo json_encode($quizzes);
?>