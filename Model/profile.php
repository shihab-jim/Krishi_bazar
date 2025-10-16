<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.html"); // Redirect to login if not logged in
    exit();
}

$username = $_SESSION['username'];
// Fetch user data from the database
$conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT username, email, mobile FROM registration WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($db_username, $db_email, $db_mobile);
$stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Krishi Bazar - My Account</title>
    <link rel="stylesheet" href="../View/product.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Site Navigation Header -->
    <nav class="site-header">
        <div class="site-nav-container">
            <div class="site-logo">
                <h2 onclick="window.location.href='product.php'"><i class="fas fa-leaf"></i> Smart Krishi Bazar</h2>
            </div>
            <div class="site-nav-links">
                <a href="profile.php" class="nav-link active">Profile</a>
                <a href="product.php" class="nav-link">Products</a>
                <a href="cart.php" class="nav-link">Cart</a>
            </div>
            <div class="site-profile-icon">
                <div class="profile-dropdown">
                    <button class="profile-icon-btn">
                        <i class="fas fa-user-circle"></i>
                        <span class="profile-name-mini"><?php echo $db_username; ?></span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-menu">
                        <a href="profile.php" class="dropdown-item">
                            <i class="fas fa-user"></i> My Profile
                        </a>
                        <a href="../Controller/logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <!-- Dashboard Overview -->
        <section class="dashboard-overview">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="stat-content">
                        <h3>12</h3>
                        <p>Total Orders</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-content">
                        <h3>8</h3>
                        <p>Wishlist Items</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="stat-content">
                        <h3>2</h3>
                        <p>Saved Addresses</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Header Section -->
        <header class="profile-header"> 
            <div class="profile-banner"> 
                <div class="profile-image-container"> 
                    <div class="profile-image"> 
                        <i class="fas fa-user"></i> 
                    </div> <button class="edit-photo-btn"> 
                        <i class="fas fa-camera"></i> 
                    </button> 
                </div> 
                <div class="profile-info"> 
                    <h1 class="profile-name"></h1> 
                    <p class="profile-title"><?php echo $db_username; ?> </p> 
                    <p class="profile-email"><?php echo $db_email; ?></p> 
                    <div class="profile-badges"> 
                        <span class="badge verified">✓ Verified</span> 
                        <span class="badge premium">★ Premium</span> 
                    </div> 
                </div> 
                <div class="profile-actions"> 
                    <button class="btn btn-primary"> 
                        <i class="fas fa-edit"></i> Edit Profile 
                    </button> 
                    <button class="btn btn-secondary"> 
                        <i class="fas fa-cog"></i> Settings 
                    </button> 
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
            <!-- Personal Info Tab -->
            <section id="personal" class="tab-content active">
                <div class="content-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-user-edit"></i>
                            <h2>Personal Information</h2>
                        </div>
                        <p class ="card-subtitle">Manage your account details and personal information.</p>
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
                    <div class="form-actions">
                        <button class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Changes
                        </button>
                    </div>
                </div>
            </section>

            <!-- Other sections like Orders, Addresses, etc., can be added here -->
        </main>
    </div>
</body>
</html>
