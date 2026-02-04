<?php
require 'db/db_conn.php';
$title = "Login";
require 'components/header.php';
?>
	<link rel="stylesheet" href="styles/index.css">
</head>

<body>
	<form action="backend/process_login.php" method="POST">
		<div id="error-message"><?php if (isset($_GET['error'])) { echo htmlspecialchars($_GET['error']); } ?></div>
		<div>
			<label for="email">Enter your email</label>
			<input type="email" id="emailInput" name="emailInput" value="<?php echo htmlspecialchars($_GET['email'] ?? ''); ?>">
		</div>
		<div>
			<div class="password-label-container">
				<label for="password">Enter password</label>
				<button onclick="togglePassword()" type="button" id="pass_visibility">👁️</button>
			</div>
			<input type="password" id="passwordInput" name="passwordInput">
		</div>
		<button type="submit" id = "login_button">Login</button>
		<a href="register.php" id = "register_link">Register</a>
	</form>
	<script src="script/login.js"></script>
</body>

</html>