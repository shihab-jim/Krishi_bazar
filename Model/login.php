<?php
// Session configuration: expires when browser closes
session_set_cookie_params([
    'lifetime' => 3600,     // 1 hour
    'path' => '/',
    'domain' => '',
    'secure' => false,   // true if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Admin login
    if ($username === "admin" && $password === "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['role'] = 'admin';
        header("Location: admin.php");
        exit();
    }

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Function to check login
    function checkLogin($conn, $table, $username, $password) {
        $stmt = $conn->prepare("SELECT id, username, password FROM $table WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $storedUsername, $storedPassword);
            $stmt->fetch();

            if ($password === $storedPassword) {
                $_SESSION['username'] = $storedUsername;
                $_SESSION['role'] = $table;

                if ($table === 'registration') {
                    header("Location: product.php");
                } else if ($table === 'seller_registration') {
                    header("Location: seller_product.php");
                }
                exit();
            } else {
                echo "<script>alert('Invalid username or password.'); window.history.back();</script>";
                exit();
            }
        }

        $stmt->close();
    }

    checkLogin($conn, 'registration', $username, $password);
    checkLogin($conn, 'seller_registration', $username, $password);

    echo "<script>alert('No user found with that username.'); window.history.back();</script>";
    $conn->close();
}
?>
