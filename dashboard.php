<?php

require 'db/db_conn.php';
require 'backend/session_validator.php';
$title = "Dashboard";
require 'components/header.php';
?>


    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .container {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: left;
        }
        h1 {
            color: #333;
        }
        .welcome-message {
            font-size: 24px;
            color: #667eea;
            margin: 20px 0;
        }
        .user-info {
            margin-top: 30px;
            text-align: left;
            background: #f5f5f5;
            padding: 20px;
            border-radius: 5px;
        }
        .logout-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .logout-btn:hover {
            background: #764ba2;
        }
    </style>
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
