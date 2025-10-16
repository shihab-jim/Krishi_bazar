<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../View/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <nav class="site-header">
        <div class="site-nav-container">
            <div class="site-logo">
                <h2><i class="fas fa-leaf"></i> Smart Krishi Bazar - Admin</h2>
            </div>
            <div class="site-nav-links">
                <a href="admin.php" class="nav-link">Users</a>
                <a href="admin_seller.php" class="nav-link">Sellers</a>
                <a href="seller_registration.php" class="nav-link active">Seller registration</a>
                <a href="../Controller/logout.php" class="nav-link">Logout</a>
            </div>
        </div>
    </nav>

    <div class="container">
        <section class="profile-header">
            <div class="profile-banner">
                <div class="profile-image-container">
                    <div class="profile-image">
                        <i class="fas fa-user"></i> <!-- Profile image icon -->
                        
                    </div>
                    <button class="edit-photo-btn"><i class="fas fa-camera"></i></button>
                </div>
                <div class="profile-info">
                    <h1 class="profile-name">Admin </h1>
                    <p class="profile-title">Administrator</p>
                    <p class="profile-email">admin@gmail.com</p>
                    <div class="profile-badges">
                        <span class="badge verified">Verified</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- Dashboard Overview -->
        <section class="dashboard-overview">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">

                        <?php
                        // Connect to the database
                        $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Get the total number of users
                        $sql = "SELECT COUNT(id) AS total_users FROM seller_registration";
                        $result = $conn->query($sql);
                        $total_users = 0;

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_users = $row['total_users'];
                        }

                        $conn->close();
                        ?>
                        <h3><?php echo $total_users; ?></h3>
                        
                        <p>Users</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-content">
                        <?php
                        // Connect to the database
                        $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');

                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // Get the total number of users
                        $sql = "SELECT COUNT(id) AS total_product FROM products";
                        $result = $conn->query($sql);
                        $total_product = 0;

                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $total_product = $row['total_product'];
                        }

                        $conn->close();
                        ?>
                        <h3><?php echo $total_product; ?></h3>
                        <p>Products</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="stat-content">
                        <h3>210</h3>
                        <p>Orders</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Navigation Tabs -->
        <div class="profile-nav">
            <button class="nav-btn" onclick="window.location.href='admin.php'">Users</button>
            <button class="nav-btn" onclick="window.location.href='admin_seller.php'">Seller</button>
            <button class="nav-btn active" onclick="window.location.href='seller_registration.php'">Seller registration </button>
        </div>


        


        <!-- Content Sections -->
        <main class="profile-content">
            <!-- Personal Info Tab -->
            <section id="personal" class="tab-content active">
                <div class="content-card">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fas fa-user-edit"></i>
                            <h2>Create seller acount</h2>
                        </div>
                        <p class ="card-subtitle">Manage seller account details and personal information.</p>
                    </div>
                    <div class="form-section">
                        <form method="POST" action="../Controller/seller_control.php">
                        <h3 class="section-title">Basic Information</h3>
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="username">Username *</label>
                                <input type="text" id="username" name= "username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email Address *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Phone number *</label>
                                <input type="tel" id="mobile" name="mobile" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="password">Password *</label>
                                <input type="password" id="password" name="password" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Account
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
