<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $record_id = $_POST['record_id'] ?? null;

    if (!$record_id || !is_numeric($record_id)) {
        $_SESSION['flash_error'] = 'Invalid record ID.';
        header('Location: ../recycle_bin.php');
        exit;
    }

    try {
        // Permanently delete the record
        $stmt = $pdo->prepare('DELETE FROM records WHERE id = ? AND deleted_at IS NOT NULL');
        $stmt->execute([$record_id]);

        if ($stmt->rowCount() > 0) {
            $_SESSION['flash_success'] = 'Record permanently deleted.';
        } else {
            $_SESSION['flash_error'] = 'Record not found in recycle bin.';
        }
    } catch (Exception $e) {
        $_SESSION['flash_error'] = 'Error permanently deleting record.';
    }

    header('Location: ../recycle_bin.php');
    exit;
} else {
    // If not POST request, redirect back
    header('Location: ../recycle_bin.php');
    exit;
}