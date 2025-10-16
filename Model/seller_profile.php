<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.html"); 
    exit();
}

$username = $_SESSION['username'];

// Connect to database
$conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch seller info
$query = "SELECT username, email, mobile FROM seller_registration WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($db_username, $db_email, $db_mobile);
$stmt->fetch();
$stmt->close();

// Fetch seller products
$product_query = $conn->prepare("SELECT id, product_name, category, price FROM products WHERE seller_username = ?");
$product_query->bind_param("s", $db_username);
$product_query->execute();
$product_result = $product_query->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Smart Krishi Bazar - My Account</title>
<link rel="stylesheet" href="../View/product.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<style>
    .product-table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    .product-table th, .product-table td { padding: 10px; border: 1px solid #ddd; text-align: left; }
    .product-table th { background-color: #f4f4f4; }
    .btn-danger { color: white; background-color: #e74c3c; padding: 5px 10px; text-decoration: none; border-radius: 4px; }
    .btn-danger:hover { background-color: #c0392b; }
    .content-card { margin-top: 20px; padding: 15px; background: #fff; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
</style>
</head>
<body>

<!-- Site Navigation Header -->
<nav class="site-header">
    <div class="site-nav-container">
        <div class="site-logo">
            <h2 onclick="window.location.href='seller_product.php'"><i class="fas fa-leaf"></i> Smart Krishi Bazar</h2>
        </div>
        <div class="site-nav-links">
            <a href="" class="nav-link active">Profile</a>
            <a href="seller_product.php" class="nav-link">Add Products</a>
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

<div class="container">

    <!-- Header Section -->
    <header class="profile-header"> 
        <div class="profile-banner"> 
            <div class="profile-image-container"> 
                <div class="profile-image"> <i class="fas fa-user"></i> </div> 
                <button class="edit-photo-btn"> <i class="fas fa-camera"></i> </button> 
            </div> 
            <div class="profile-info"> 
                <h1 class="profile-name"></h1> 
                <p class="profile-title"><?php echo $db_username; ?> </p> 
                <p class="profile-email"><?php echo $db_email; ?></p> 
                <div class="profile-badges"> 
                    <span class="badge verified">✓ Verified</span> 
                    <span class="badge premium">Seller</span> 
                </div> 
            </div> 
            <div class="profile-actions"> 
                <button class="btn btn-primary"> <i class="fas fa-edit"></i> Edit Profile </button> 
                <button class="btn btn-secondary"> <i class="fas fa-cog"></i> Settings </button> 
            </div> 
        </div> 
    </header>

    <!-- Navigation Tabs -->
    <nav class="profile-nav">
        <button class="nav-btn active" data-tab="personal">Personal Info</button>
        <button class="nav-btn" data-tab="orders">Order History</button>
        <button class="nav-btn" data-tab="addresses">Addresses</button>
    </nav>

    <!-- Content Sections -->
    <main class="profile-content">

        <!-- Personal Info Tab (unchanged) -->
        <section id="personal" class="tab-content active">
            <div class="content-card">
                <div class="card-header">
                    <div class="card-title">
                        <i class="fas fa-user-edit"></i>
                        <h2>Personal Information</h2>
                    </div>
                    <p class="card-subtitle">Manage your account details and personal information.</p>
                </div>
                <div class="form-section">
                    <h3 class="section-title">Basic Information</h3>
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="username">Username *</label>
                            <input type="text" id="username" value="<?php echo $db_username; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" value="<?php echo $db_email; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" value="<?php echo $db_mobile; ?>" disabled>
                        </div>
                    </div>
                    
                </div>
            </section>

            <!-- My Products Table (added at bottom) -->
            <section class="content-card">
                <div class="card-header">
                    <div class="card-title"><i class="fas fa-box"></i><h2>My Products</h2></div>
                    <p class="card-subtitle">View and manage your products.</p>
                </div>

                <?php if ($product_result->num_rows > 0): ?>
                    <table class="product-table">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Price (৳)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $product_result->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                                    <td><?php echo $row['price']; ?></td>
                                    <td>
                                        <a href="../Controller/delete_product.php?id=<?php echo $row['id']; ?>" 
                                           onclick="return confirm('Are you sure you want to delete this product?');" 
                                           class="btn btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </section>

    </main>
</div>
</body>
</html>
