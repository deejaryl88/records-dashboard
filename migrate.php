<?php
require 'db/db_conn.php';

try {
    $sql = "ALTER TABLE records ADD COLUMN deleted_at TIMESTAMP NULL DEFAULT NULL";
    $pdo->exec($sql);
    echo "Successfully added deleted_at column to records table.";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    // Column might already exist
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo " Column already exists.";
    }
}
?>