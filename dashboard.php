<?php

require 'db/db_conn.php';
require 'backend/session_validator.php';
$title = "Dashboard";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/dashboard.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <div class="welcome-message">
            Good day and welcome, <?php echo ($_SESSION['user_data']['name'] ); ?>!
        </div>
        
        <div class="user-info">
            <p><strong>Email:</strong> <?php echo htmlspecialchars($_SESSION['user_data']['email']); ?></p>
            <p><strong>Account Created:</strong> <?php echo htmlspecialchars($_SESSION['user_data']['created_at'] ?? 'N/A'); ?></p>
        </div>
        
        <div class="actions">
            <form action="create_record.php" method="GET">
                <button type="submit" id = "create_button">Create</button>
            </form>
            <form action="view_records.php" method="GET" >
                <button type="submit" id = "view_records_button">View Records</button>
            </form>
            <form action="recycle_bin.php" method="GET" >
                <button type="submit" id = "recycle_bin_button">Recycle Bin</button>
            </form>
            <form action="backend/process_logout.php" method="POST">
                <button type="submit" id = "logout_button">Logout</button>
            </form>
        </div>
    </div>
</body>
</html>
