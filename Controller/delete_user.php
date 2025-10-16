<?php
// admin.php

// 1. Connect to the database
$conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 2. Check if 'id' is passed
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // sanitize input

    // 3. Delete the record
    $sql = "DELETE FROM registration WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: ../Model/admin.php"); // Redirect back to admin page
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
?>
