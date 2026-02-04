<?php
require 'db/db_conn.php';
$title = "Login";
require 'components/header.php';
?>

	<link rel="stylesheet" href="styles/index.css">
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