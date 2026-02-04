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
        $error = 'Fill out all fields';
    } elseif ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else {
        // Check if email already exists
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $existing_user = $stmt->fetch();

        if ($existing_user) {
            $error = 'Email already registered';
        } else {
            // for Hash password and insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, $hashed_password]);

            $success = true;
        }
    }

    // Check if request is AJAX
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        if (isset($success)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => $error]);
        }
        exit();
    } else {
        // Fallback for non-AJAX
        if (isset($success)) {
            header('Location: ../register_success.php');
            exit();
        } else {
            header('Location: ../register.php?error=' . urlencode($error) . '&name=' . urlencode($name) . '&email=' . urlencode($email));
            exit();
        }
    }
} else {
    echo 'Invalid request method';
}

