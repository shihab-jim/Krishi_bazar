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
                <a href="admin.php" class="nav-link active">Users</a>
                <a href="admin_seller.php" class="nav-link">Sellers</a>
                <a href="seller_registration.php" class="nav-link">Seller registration</a>
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
                        $sql = "SELECT COUNT(id) AS total_users FROM registration";
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
            <button class="nav-btn active">Users</button>
            <button class="nav-btn" onclick="window.location.href='admin_seller.php'">Seller</button>
            <button class="nav-btn" onclick="window.location.href='seller_registration.php'">Seller registration </button>
        </div>

        <div class="profile-content">
            <!-- Add sections here as needed -->
            <div class="content-card">
            

                <div class="content-card">
            <h2>Registered Users</h2>
            <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Connect to the database
            $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Get users from the database
            $sql = "SELECT id, username, email, mobile FROM registration";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $id = $row['id'];
                    echo "<tr>
                            <td>".$row["id"]."</td>
                            <td>".$row["username"]."</td>
                            <td>".$row["email"]."</td>
                            <td>".$row["mobile"]."</td>
                            <td>
                            <a href='../Controller/delete_user.php?id={$id}' class='delete-btn' 
                               onclick=\"return confirm('Are you sure you want to delete this user?');\">
                               Delete
                            </a>
                        </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
                <!-- Orders Table or Information -->
            </div>

            
        </div>
    </div>
</body>
</html>
