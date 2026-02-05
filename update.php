<?php
require 'db/db_conn.php';
require 'backend/session_validator.php';

// Get record ID from URL mismo
$record_id = $_GET['id'] ?? null;

if (!$record_id) {
    header('Location: view_records.php?error=' . urlencode('No record specified'));
    exit;
}

// i-feFetch yung record
try {
    $stmt = $pdo->prepare('SELECT * FROM records WHERE id = ?');
    $stmt->execute([$record_id]);
    $record = $stmt->fetch();
    
    if (!$record) {
        header('Location: view_records.php?error=' . urlencode('Record not found'));
        exit;
    }
} catch (Exception $e) {
    header('Location: view_records.php?error=' . urlencode('Error fetching record'));
    exit;
}

$title = "Update Record";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/update.css">
  
</head>
<body>
    <div class="container">
        <h1>Update Record</h1>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>
        <form action="backend/process_update.php" method="POST">
            <table>
                <tr>
                    <td><label>Record ID</label></td>
                    <td><input readonly type="text" value="<?php echo htmlspecialchars($record['id']); ?>" ></td>
                </tr>
                <tr>
                    <td><label>Title</label></td>
                    <td><input type="text" name="titleInput" id = "title_entry" value="<?php echo htmlspecialchars($record['title']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Description</label></td>
                    <td><input type="text" name="descriptionInput" id = "description_entry" value="<?php echo htmlspecialchars($record['description']); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Name</label></td>
                    <td><input readonly type="text" value="<?php echo htmlspecialchars($record['name']); ?>" ></td>
                </tr>
                <tr>
                    <td><label>Created At</label></td>
                    <td><input readonly type="text" value="<?php echo htmlspecialchars($record['created_at']); ?>" ></td>
                </tr>
                <tr>
                    <td>
                        <input type="hidden" name="record_id" value="<?php echo htmlspecialchars($record['id']); ?>">
                        <button type="submit" id = "save_button">Save</button>
                        <a href="view_records.php"><button type="button" id = "cancel_link">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
