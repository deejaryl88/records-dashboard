<?php
require 'db/db_conn.php';
require 'backend/session_validator.php';

$title = "View Records";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/view_records.css">
  
</head>
<body>
    <div class="container">
        <h1>Mga Saved Records</h1>
        <p><a href="dashboard.php">&larr; Back to Dashboard</a></p>

        <?php if (!empty($_SESSION['flash_success'])): ?>
            <div class="success"><?php echo htmlspecialchars($_SESSION['flash_success']); unset($_SESSION['flash_success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>

        <?php
        try {
            $stmt = $pdo->query(
                'SELECT r.id, r.title, r.description, r.name, r.recorder_id, u.created_at AS registered_at'
                . ' FROM records r'
                . ' LEFT JOIN users u ON r.recorder_id = u.id'
                . ' WHERE r.deleted_at IS NULL'
                . ' ORDER BY r.id ASC'
            );
            $records = $stmt->fetchAll();
        } catch (Exception $e) {
            echo '<div class="error">Error fetching records.</div>';
            $records = [];
        }

        if (empty($records)): ?>
            <div class="no-records">No records found.</div>
        <?php else: ?>
            <table class="records-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Name</th>
                        <th>Recorder ID</th>
                        <th>Created At</th>
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
                            <td><?php echo htmlspecialchars($row['registered_at'] ?? 'N/A'); ?></td>
                            <td><a href="update.php?id=<?php echo htmlspecialchars($row['id']); ?>"><button type="button" id = "update_button"> Update </button></a></td>
                            <td>
                                <form method="POST" action="backend/process_delete.php" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this record? This action cannot be undone.')">
                                    <input type="hidden" name="record_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                    <button type="submit" class="delete-button">Delete</button>
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
