<?php
require 'db/db_conn.php';
$title = "Register";
require 'components/header.php';
?>

	<link rel="stylesheet" href="styles/register.css">
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