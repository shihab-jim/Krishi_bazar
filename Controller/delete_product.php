<?php
session_start();

// Optional: check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.html");
    exit();
}

if (isset($_GET['id'])) {
    $product_id = intval($_GET['id']); // sanitize input

    // Connect to database
    $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Optional: ensure the product belongs to the logged-in seller
    $seller_username = $_SESSION['username'];

    $stmt = $conn->prepare("DELETE FROM products WHERE id = ? AND seller_username = ?");
    $stmt->bind_param("is", $product_id, $seller_username);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: ../Model/seller_profile.php"); // go back to profile page
        exit();
    } else {
        echo "Error deleting product: " . $conn->error;
    }
} else {
    header("Location: ../Model/seller_profile.php"); // if no id provided, go back
    exit();
}
?>
