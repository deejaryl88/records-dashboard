<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['titleInput'];
    $description= $_POST['descriptionInput'];
    $name= $_POST['nameInput'];

    if ($title === '' || $description === '') {
        $_SESSION['flash_error'] = 'All fields are required.';
        header('Location: ../create_record.php');
     exit;
    }
}

$recorder_id = $_SESSION['user_id'];

// Insert into `records` table
$stmt = $pdo->prepare('INSERT INTO records (title, description, name, recorder_id) VALUES (?, ?, ?, ?)');
if (!$stmt) {
    die('Prepare failed');
}

$stmt->execute([$title, $description, $name, $recorder_id]);
header('Location: ../dashboard.php?created=1');
exit;
