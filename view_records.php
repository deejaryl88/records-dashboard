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
        $records_per_page = 10;
        $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        
        try {
            // Get total count of records
            $count_stmt = $pdo->query(
                'SELECT COUNT(*) as total'
                . ' FROM records r'
                . ' WHERE r.deleted_at IS NULL'
            );
            $total_records = $count_stmt->fetch()['total'];
            $total_pages = ceil($total_records / $records_per_page);
            
            // Ensure current page doesn't exceed total pages
            if ($current_page > $total_pages && $total_pages > 0) {
                $current_page = $total_pages;
            }
            
            $offset = ($current_page - 1) * $records_per_page;
            
            $stmt = $pdo->query(
                'SELECT r.id, r.title, r.description, r.name, r.recorder_id, u.created_at AS registered_at'
                . ' FROM records r'
                . ' LEFT JOIN users u ON r.recorder_id = u.id'
                . ' WHERE r.deleted_at IS NULL'
                . ' ORDER BY r.id ASC'
                . ' LIMIT ' . $records_per_page . ' OFFSET ' . $offset
            );
            $records = $stmt->fetchAll();
        } catch (Exception $e) {
            echo '<div class="error">Error fetching records.</div>';
            $records = [];
            $total_records = 0;
            $total_pages = 0;
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
            
            <!-- Pagination Controls -->
            <div class="pagination">
                <?php if ($current_page > 1): ?>
                    <a href="?page=1" class="pagination-btn">« First</a>
                    <a href="?page=<?php echo $current_page - 1; ?>" class="pagination-btn">← Previous</a>
                <?php else: ?>
                    <span class="pagination-btn disabled">« First</span>
                    <span class="pagination-btn disabled">← Previous</span>
                <?php endif; ?>
                
                <span class="pagination-info">Page <?php echo $current_page; ?> of <?php echo $total_pages; ?></span>
                
                <?php if ($current_page < $total_pages): ?>
                    <a href="?page=<?php echo $current_page + 1; ?>" class="pagination-btn">Next →</a>
                    <a href="?page=<?php echo $total_pages; ?>" class="pagination-btn">Last »</a>
                <?php else: ?>
                    <span class="pagination-btn disabled">Next →</span>
                    <span class="pagination-btn disabled">Last »</span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
