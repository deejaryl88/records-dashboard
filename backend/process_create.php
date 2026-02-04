<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['titleInput'];
    $description= $_POST['descriptionInput'];
    $name= $_POST['nameInput'];
    $recorder_id = $_POST['recorder_idInput'];

    if ($title === '' || $description === '') {
        $_SESSION['flash_error'] = 'All fields are required.';
        header('Location: ../create_record.php');
     exit;
    }
}

// Get the max recorder_id for this user and generate the next one
$stmt = $pdo->prepare('SELECT MAX(recorder_id) as max_id FROM records WHERE name = ?');
$stmt->execute([$user_id]);
$result = $stmt->fetch();
$max_id = $result['max_id'] ?? 0;
$recorder_id = $max_id + 1;

// Insert into `records` table
$stmt = $pdo->prepare('INSERT INTO records (title, description, name, recorder_id) VALUES (?, ?, ?, ?)');
if (!$stmt) {
    die('Prepare failed');
}

$stmt->execute([$title, $description, $name, $recorder_id]);
header('Location: ../dashboard.php?created=1');
exit;
