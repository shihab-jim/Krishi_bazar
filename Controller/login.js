function validateForm(event) {
    // Get form values
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();

    // Check if fields are empty
    if (username === "" || password === "") {
        alert("Please fill in both fields.");
        event.preventDefault(); // Stop form submission
        return false;
    }

    // Add password length check (optional)
    if (password.length < 5) {
        alert("Password must be at least 5 characters long.");
        event.preventDefault();
        return false;
    }

    // If everything is valid
    return true;
}
