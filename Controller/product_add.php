<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.html");
    exit();
}

$username = $_SESSION['username'];
$conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch seller info for display
$db_username = $username; // fallback if query fails
$stmt = $conn->prepare("SELECT username FROM seller_registration WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($db_username);
$stmt->fetch();
$stmt->close();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $category     = $_POST['category'];
    $price        = $_POST['price'];
    $description  = $_POST['description'];
    $quantity     = $_POST['quantity'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp  = $_FILES['image']['tmp_name'];
        $image_folder = "../photos/" . basename($image_name); 

        if (move_uploaded_file($image_tmp, $image_folder)) {
            $insert_stmt = $conn->prepare("INSERT INTO products (seller_username, product_name, category, price, description, image, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insert_stmt->bind_param("sssisss", $username, $product_name, $category, $price, $description, $image_name, $quantity);

            if ($insert_stmt->execute()) {
                echo "<script>alert('Product added successfully!'); window.location.href='../Model/seller_product.php';</script>";
                exit();
            } else {
                echo "<script>alert('Failed to add product.'); window.history.back();</script>";
            }
            $insert_stmt->close();
        } else {
            echo "<script>alert('Failed to upload image.'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Please select a valid image.'); window.history.back();</script>";
    }
}

$conn->close();
?>
