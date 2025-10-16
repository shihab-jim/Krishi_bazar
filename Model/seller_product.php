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

$db_username = $username; // fallback
$stmt = $conn->prepare("SELECT username FROM seller_registration WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($db_username);
$stmt->fetch();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Krishi Bazar - Add Products</title>
<link rel="stylesheet" href="../View/product.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
<nav class="site-header">
    <div class="site-nav-container">
        <div class="site-logo">
            <h2 onclick="window.location.href='seller_product.php'"><i class="fas fa-leaf"></i> Smart Krishi Bazar</h2>
        </div>
        <div class="site-nav-links">
            <a href="seller_profile.php" class="nav-link">Profile</a>
            <a href="" class="nav-link active">Add Products</a>
        </div>
        <div class="site-profile-icon">
            <div class="profile-dropdown">
                <button class="profile-icon-btn">
                    <i class="fas fa-user-circle"></i>
                    <span class="profile-name-mini"><?php echo $db_username; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="seller_profile.php" class="dropdown-item"><i class="fas fa-user"></i> My Profile</a>
                    <a href="../Controller/logout.php" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container products-container">
    <header class="products-header">
        <h1>Add Your Products</h1>
        <p>Fill in the details of the product you want to sell</p>
    </header>

    <!-- Add Product Form -->
    <main class="profile-content">
            <!-- Personal Info Tab -->
            <section id="personal" class="tab-content active">
                <div class="content-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-user-edit"></i>
                            <h2>Product Information</h2>
                        </div>
                        <p class ="card-subtitle">Manage your product details and information.</p>
                    </div>
                    <div class="form-section">
                        <h3 class="section-title">Basic Information</h3>
                        <form action="../Controller/product_add.php" method="POST" enctype="multipart/form-data"  class="form-grid">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="product_name">Product name *</label>
                                <input type="text" id="product_name" name="product_name"  required>
                            </div>
                            <div class="form-group">
                                <label for="category">Category*</label>
                                <select name="category" id="category" required>
                                <option value="vegetables">Vegetables</option>
                                <option value="fruits">Fruits</option>
                                <option value="grains">Grains</option>
                                <option value="dairy">Dairy</option>
                                <option value="spices">Spices & Herbs</option>
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="price">Price (৳) *</label>
                                <input type="number" id="price" name="price" required>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Amount*</label>
                                <select name="quantity" id="quantity" required>
                                <option value="kg">kg</option>
                                <option value="5kg">5kg</option>
                                <option value="500g">500g</option>
                                <option value="250g">250g</option>
                                <option value="100g">100g</option>
                                <option value="dozen">dozen</option>
                                <option value="piece">piece</option>
                                <option value="500ml">500ml</option>
                                <option value="liter">liter</option>
                                <option value="5 liters">5 liters</option>
                                <option value="pcs">pcs</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="image">Product Image *</label>
                                <input type="file" id="image" name="image" required>
                            </div>

                            <div class="form-group">
                                <label for="description">Product Description *</label>
                                <textarea name="description" id="description" rows="4" required></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="form-actions">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Add Product
                        </button>
                    </div>
                    </form>
                </div>
            </section>

            <!-- Other sections like Orders, Addresses, etc., can be added here -->
        </main>
</div>
</body>
</html>
