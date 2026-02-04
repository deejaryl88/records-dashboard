<?php
require 'db/db_conn.php';
require 'backend/session_validator.php';
$title = "Create Record";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
    <div class="container">
        <h1>Create Record</h1>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>
        <form action="backend/process_create.php" method="POST">
            <label>Title<br>
                <input type="text" name="title" required>
            </label>
            <br>
            <label>Description<br>
                <textarea name="description" rows="5" required></textarea>
            </label>
            <br>
            <label>Name<br>
                <input type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['user_data']['name'] ?? ''); ?>" required>
            </label>
            <br>
            <label>Recorder ID<br>
                <input type="text" name="recorder_id" value="<?php echo htmlspecialchars($_SESSION['user_data']['id'] ?? ''); ?>" required>
            </label>
            <br>
            <label>Time<br>
                <input type="datetime-local" name="time" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
            </label>
            <br><br>
            <button type="submit">Save</button>
            <a href="dashboard.php"><button type="button">Cancel</button></a>
        </form>
    </div>
</body>
</html>
