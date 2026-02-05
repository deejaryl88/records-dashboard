<?php
require 'db/db_conn.php';
require 'backend/session_validator.php';

$name = $_SESSION['user_data']['name'] ?? '';
$next_recorder_id = $_SESSION['user_id'];

$title = "Create Record";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/create_record.css">
  
</head>
<body>
    <div class="container">
        <h1>Create Record</h1>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>
        <form action="backend/process_create.php" method="POST">
            <table>
                <tr>
                    <td><label>Title</label></td>
                    <td><input type="text" name="titleInput" id = "title_entry" required></td>
                </tr>
                <tr>
                    <td><label>Description</label></td>
                    <td><input type="text" name="descriptionInput" id = "description_entry" required></td>
                </tr>
                <tr>
                    <td><label>Name</label></td>
                    <td><input readonly type="text" name="nameInput" id = "name_entry" value="<?php echo htmlspecialchars($_SESSION['user_data']['name'] ?? ''); ?>" ></td>
                </tr>
                <tr>
                    <td><label>Recorder ID</label></td>
                    <td><input readonly type="text" name="recorder_idInput" id = "recorder_id_entry" value="<?php echo htmlspecialchars($next_recorder_id); ?>" ></td>
                </tr>
                <tr>
                    <td>
                        <button type="submit" id = "save_button">Save</button>
                        <a href="dashboard.php"><button type="button" id = "cancel_link">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
