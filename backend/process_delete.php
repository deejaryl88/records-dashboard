<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_id = $_POST['record_id'] ?? null;

    if (!$record_id || !is_numeric($record_id)) {
        $_SESSION['flash_error'] = 'Invalid record ID.';
        header('Location: ../view_records.php');
        exit;
    }

    try {
        // Soft delete the record (move to recycle bin)
        $stmt = $pdo->prepare('UPDATE records SET deleted_at = NOW() WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$record_id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['flash_success'] = 'Record moved to recycle bin.';
        } else {
            $_SESSION['flash_error'] = 'Record not found or already deleted.';
        }
    } catch (Exception $e) {
        $_SESSION['flash_error'] = 'Error deleting record.';
    }

    header('Location: ../view_records.php');
    exit;
} else {
    // If not POST request, redirect back
    header('Location: ../view_records.php');
    exit;
}
