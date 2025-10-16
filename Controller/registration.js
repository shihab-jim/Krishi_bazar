function validateForm() {
    // Get form data
    var username = document.forms["registerForm"]["username"].value;
    var email = document.forms["registerForm"]["email"].value;
    var mobile = document.forms["registerForm"]["mobile"].value;
    var password = document.forms["registerForm"]["password"].value;
    var confirmPassword = document.forms["registerForm"]["confirm-password"].value;

    // Check if all fields are filled
    if (username == "" || email == "" || mobile == "" || password == "" || confirmPassword == "") {
        alert("All fields must be filled out!");
        return false;
    }

    // Simple Email Validation (regex)
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Simple Mobile Validation (basic pattern for 10 digits)
    var mobilePattern = /^01\d{9}$/;
    if (!mobilePattern.test(mobile)) {
        alert("Please enter a valid mobile number.");
        return false;
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    // Check password length (minimum 6 characters)
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }
    

    // The form will submit if everything is valid
    return true;
}
