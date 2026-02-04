<?php
require 'db/db_conn.php';
$title = "Register";
require 'components/header.php';
?>

	<style>
		body {
			display: flex;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			margin: 0;
		}
		
		form {
			background: white;
			padding: 30px;
			border-radius: 8px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
			width: 100%;
			max-width: 400px;
		}
		
		div {
			margin-bottom: 20px;
		}
		
		input[type="text"],
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
			box-sizing: border-box;
		}
		
		button, a {
			width: 100%;
			padding: 10px;
			margin-top: 10px;
			background: #667eea;
			color: white;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			font-size: 14px;
			text-align: center;
			text-decoration: none;
			display: block;
			box-sizing: border-box;
		}
	</style>
</head>

<body>
	<form action="backend/process_register.php" method="POST">
		<div id="error-message"><?php if (isset($_GET['error'])) { echo $_GET['error']; } ?></div>
		<div>
			<label for="name">Enter your name</label>
			<input type="text" id="nameInput" name="nameInput">
		</div>
		<div>
			<label for="email">Enter your email</label>
			<input type="email" id="emailInput" name="emailInput">
		</div>
		<div>
			<label for="password">Enter your password</label>
			<input type="password" id="passwordInput" name="passwordInput">
		</div>
		<div>
			<label for="confirm_password">Re-enter your password</label>
			<input type="password" id="confirm_passwordInput" name="confirm_passwordInput">
		</div>
		<button type="submit">Register</button>
		<a href="index.php">Login</a>
	</form>

</body>

</html>