<?php

session_start();
require '../db/db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = $_POST['emailInput'];
	$password = $_POST['passwordInput'];

	$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
	$stmt->execute([$email]);
	$user = $stmt->fetch();

	if ($user && password_verify($password, $user['password'])) {
		$_SESSION['user_id'] = $user['id'];
		// store all user data in session
		//full user data
		$_SESSION['user_data'] = $user;
		header('Location: ../dashboard.php');
		exit();
	} else {
		header('Location: ../index.php?error=Invalid email or password');
		exit();
	}
} else {
	echo 'Invalid request method';
}
