function togglePassword() {

	var passInput = document.getElementById("passwordInput");
	var passIcon = document.getElementById("pass_visibility");
	if (passInput.type === "password") {
		passInput.type = "text";
		passIcon.innerHTML = "️❌"
	} else {
		passInput.type = "password";
		passIcon.innerHTML = "👁️"
	}

}
