<?php
require 'db/db_conn.php';
require 'backend/session_validator.php';

$title = "Recycle Bin";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/view_records.css">

</head>
<body>
    <div class="container">
        <h1>Recycle Bin</h1>
        <p><a href="dashboard.php">&larr; Back to Dashboard</a> | <a href="view_records.php">View Active Records</a></p>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="success"><?php echo htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>

        <?php
        try {
            $stmt = $pdo->query(
                'SELECT r.id, r.title, r.description, r.name, r.recorder_id, r.deleted_at, u.created_at AS registered_at'
                . ' FROM records r'
                . ' LEFT JOIN users u ON r.recorder_id = u.id'
                . ' WHERE r.deleted_at IS NOT NULL'
                . ' ORDER BY r.deleted_at DESC'
            );
            $records = $stmt->fetchAll();
        } catch (Exception $e) {
            echo '<div class="error">Error fetching deleted records.</div>';
            $records = [];
        }

        if (empty($records)): ?>
            <div class="no-records">No deleted records found.</div>
        <?php else: ?>
            <table class="records-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Name</th>
                        <th>Recorder ID</th>
                        <th>Deleted At</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['title']); ?></td>
                            <td><?php echo htmlspecialchars($row['description']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['recorder_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['deleted_at']); ?></td>
                            <td>
                                <form method="POST" action="backend/process_restore.php" style="display: inline;">
                                    <input type="hidden" name="record_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="restore-button">Restore</button>
                                </form>
                            </td>
                            <td>
                                <form method="POST" action="backend/process_permanent_delete.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to permanently delete this record? This action cannot be undone.')">
                                    <input type="hidden" name="record_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="delete-button">Delete Forever</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>