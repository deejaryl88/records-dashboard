<?php
require 'db/db_conn.php';
require 'backend/session_validator.php';
$title = "Create Record";
require 'components/header.php';
?>
    <link rel="stylesheet" href="styles/index.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 18px;
        }
        td {
            padding: 20px;
            border: 1px solid #ccc;
        }
        label {
            font-weight: bold;
            font-size: 18px;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            padding: 12px 24px;
            font-size: 16px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Record</h1>
        <?php if (!empty($_SESSION['flash_error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['flash_error']); unset($_SESSION['flash_error']); ?></div>
        <?php endif; ?>
        <form action="backend/process_create.php" method="POST">
            <table border="1" cellpadding="15" cellspacing="0">
                <tr>
                    <td style="width: 20%;"><label>Title</label></td>
                    <td><input type="text" name="title" required></td>
                </tr>
                <tr>
                    <td><label>Description</label></td>
                    <td><input type="text" name="description" required></td>
                </tr>
                <tr>
                    <td><label>Name</label></td>
                    <td><input disabled type="text" name="name" value="<?php echo htmlspecialchars($_SESSION['user_data']['name'] ?? ''); ?>" required></td>
                </tr>
                <tr>
                    <td><label>Recorder ID</label></td>
                    <td><input disabled type="text" name="recorder_id" value="<?php echo htmlspecialchars($_SESSION['user_data']['id'] ?? ''); ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center; padding: 20px;">
                        <button type="submit" style="padding: 15px 40px; font-size: 18px;">Save</button>
                        <a href="dashboard.php"><button type="button" style="padding: 15px 40px; font-size: 18px;">Cancel</button></a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
