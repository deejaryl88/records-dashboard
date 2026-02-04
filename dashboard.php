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
        
        <form action="backend/process_logout.php" method="POST">
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>
</body>
</html>
