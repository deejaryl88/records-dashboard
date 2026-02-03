<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['nameInput'];
    $email = $_POST['emailInput'];
    $password = $_POST['passwordInput'];
    $confirm_password = $_POST['confirm_passwordInput'];

    // pang validation ng inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        header('Location: ../register.php?error=Fill out all fields');
        exit();
    }

    //double checking if nag mmatch ang pass
    if ($password !== $confirm_password) {
        header('Location: ../register.php?error=Passwords do not match');
        exit();
    }

    // Check if email already exists
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $existing_user = $stmt->fetch();

    if ($existing_user) {
        header('Location: ../register.php?error=Email already registered');
        exit();
    }

    // for Hash password and insert user
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
    $stmt->execute([$name, $email, $hashed_password]);

    // Display success message and show login page
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration Successful</title>
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                min-height: 100vh;
                margin: 0;
                background: #f5f5f5;
            }
            
            .container {
                background: white;
                padding: 30px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 400px;
                text-align: center;
            }
            
            .success-message {
                color: #4caf50;
                font-size: 18px;
                margin-bottom: 20px;
                font-weight: bold;
            }
            
            .info-text {
                color: #666;
                margin-bottom: 30px;
                font-size: 14px;
            }
            
            a {
                display: block;
                padding: 10px;
                background: #667eea;
                color: white;
                text-decoration: none;
                border-radius: 4px;
                cursor: pointer;
                font-size: 14px;
                margin-top: 10px;
            }
            
            a:hover {
                background: #5568d3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="success-message">Success</div>
            <div class="info-text">Account Created. Now login with your credentials.</div>
            <a href="../index.php">Go to Login Page</a>
        </div>
    </body>
    </html>
    <?php
    exit();
} else {
    echo 'Invalid request method';
}

