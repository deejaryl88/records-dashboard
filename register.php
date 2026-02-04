<?php
require 'db/db_conn.php';
$title = "Register";
require 'components/header.php';
?>
	<link rel="stylesheet" href="styles/register.css">
</head>

<body>
	<form action="backend/process_register.php" method="POST">
		<div id="error-message"><?php if (isset($_GET['error'])) { echo htmlspecialchars($_GET['error']); } ?></div>
		<div>
			<label for="name">Enter your name</label>
			<input type="text" id="nameInput" name="nameInput" value="<?php echo htmlspecialchars($_GET['name'] ?? ''); ?>">
		</div>
		<div>
			<label for="email">Enter your email</label>
			<input type="email" id="emailInput" name="emailInput" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
		</div>
		<div>
			<label for="password">Enter your password</label>
			<input type="password" id="passwordInput" name="passwordInput">
		</div>
		<div>
			<label for="confirm_password">Re-enter your password</label>
			<input type="password" id="confirm_passwordInput" name="confirm_passwordInput">
		</div>
		<button type="submit" id = "register_button">Register</button>
		<a href="index.php" id="login_link">Login</a>
	</form>
	<script src="script/register.js"></script>
</body>

</html>