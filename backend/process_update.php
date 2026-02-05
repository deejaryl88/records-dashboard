<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_id = $_POST['record_id'] ?? null;
    $title = $_POST['titleInput'];
    $description = $_POST['descriptionInput'];

    if (!$record_id) {
        $_SESSION['flash_error'] = 'Record ID is missing.';
        header('Location: ../update.php?id=' . urlencode($record_id));
        exit;
    }

    if ($title === '' || $description === '') {
        $_SESSION['flash_error'] = 'All fields are required.';
        header('Location: ../update.php?id=' . urlencode($record_id));
        exit;
    }

    // Update the record
    $stmt = $pdo->prepare('UPDATE records SET title = ?, description = ? WHERE id = ?');
    if (!$stmt) {
        die('Prepare failed');
    }

    $stmt->execute([$title, $description, $record_id]);
    header('Location: ../view_records.php?updated=1');
    exit;
} else {
    echo 'Invalid request method';
}

?>
