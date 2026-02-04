<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = $_POST['emailInput'];
	$password = $_POST['passwordInput'];

	 if (empty($email) || empty($password)) {
        $error = 'Fill out all fields';
    } else {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            // store all user data in session
            //full user data
            $_SESSION['user_data'] = $user;
            $success = true;
        } else {
            $error = 'Invalid email or password';
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
            header('Location: ../dashboard.php');
        } else {
            header('Location: ../index.php?error=' . urlencode($error) . '&email=' . urlencode($email));
        }
        exit();
    }
} else {
	echo 'Invalid request method';
}
