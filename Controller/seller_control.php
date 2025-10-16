<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "krishi_bazar");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form values
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $mobile   = $_POST['mobile'];
    $password = $_POST['password'];

    // Insert into database
    $sql = "INSERT INTO seller_registration (username, email, mobile, password) 
            VALUES ('$username', '$email', '$mobile', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Account saved successfully!";
        header("Location: ../Model/admin_seller.php"); // redirect back after saving
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
$conn->close();
?>
