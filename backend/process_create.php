<?php

require __DIR__ . '/../db/db_conn.php';
require __DIR__ . '/session_validator.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../create_record.php');
    exit;
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$name = trim($_POST['name'] ?? '');
$created_at = trim($_POST['created_at'] ?? ''); // Captured from client laptop time
$user_id = $_SESSION['user_data']['id'] ?? '';

if ($title === '' || $description === '' || $name === '') {
    $_SESSION['flash_error'] = 'All fields are required.';
    header('Location: ../create_record.php');
    exit;
}

// Get the max recorder_id for this user and generate the next one
$stmt = $pdo->prepare('SELECT MAX(recorder_id) as max_id FROM records WHERE user_id = ?');
$stmt->execute([$user_id]);
$result = $stmt->fetch();
$max_id = $result['max_id'] ?? 0;
$recorder_id = $max_id + 1;

// Insert into `records` table
$stmt = $pdo->prepare('INSERT INTO records (title, description, name, recorder_id, user_id, created_at) VALUES (?, ?, ?, ?, ?, ?)');
if (!$stmt) {
    die('Prepare failed');
}

$stmt->execute([$title, $description, $name, $recorder_id, $user_id, $created_at]);
header('Location: ../dashboard.php?created=1');
exit;
