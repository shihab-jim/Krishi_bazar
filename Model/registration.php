<?php
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Check if passwords match
    if ($password != $confirmPassword) {
        die("Passwords do not match.");
    }

    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $stmt = $conn->prepare("INSERT INTO registration (username, email, mobile, password) VALUES (?, ?, ?, ?)");
    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $username, $email, $mobile, $password);

    // Execute the query
    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        echo "<script>alert('Registration successful!'); window.location.href='../View/login.html';</script>";
        exit();  // Make sure no further code is executed
    } else {
        echo "<script>alert('There was an error. Please try again later.'); window.history.back();</script>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
