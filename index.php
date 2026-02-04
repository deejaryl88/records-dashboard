<?php
require 'db/db_conn.php';
$title = "Login";
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
			padding: 30px;
			border-radius: 8px;
			width: 100%;
			max-width: 400px;
		}
		
		div {
			margin-bottom: 20px;
		}
		
		.password-label-container {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 5px;
		}
		
		input[type="email"],
		input[type="password"] {
			width: 100%;
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 4px;
			font-size: 14px;
			box-sizing: border-box;
		}
		
		#pass_visibility {
			background: none;
			border: none;
			cursor: pointer;
			font-size: 18px;
			padding: 0;
			margin-left: 10px;
		}
		
		button[type="submit"], a {
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
	<form action="backend/process_login.php" method="POST">
		<div>
			<label for="email">Enter your email</label>
			<input type="email" id="emailInput" name="emailInput">
		</div>
		<div>
			<div class="password-label-container">
				<label for="password">Enter password</label>
				<button onclick="togglePassword()" type="button" id="pass_visibility">❌</button>
			</div>
			<input type="password" id="passwordInput" name="passwordInput">
		</div>
		<button type="submit">Login</button>
		<a href="register.php">Register</a>
	</form>
	<script src="script/login.js"></script>
</body>

</html>