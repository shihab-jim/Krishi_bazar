<?php

session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['username'])) {
    header("Location: ../View/login.html");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user info
$username = $_SESSION['username'];
$query = "SELECT username, email, mobile FROM registration WHERE username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($db_username, $db_email, $db_mobile);
$stmt->fetch();
$stmt->close();
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Krishi Bazar - Products</title>
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
                <a href="profile.php" class="nav-link">Profile</a>
                <a href="product.php" class="nav-link active">Products</a>
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
                            <i class="fas fa-user"></i>
                            My Profile
                        </a>
                        <a href="cart.php#orders" class="dropdown-item">
                            <i class="fas fa-shopping-bag"></i>
                            My Orders
                        </a>
                        
                        
                        <div class="dropdown-divider"></div>
                        <a href="../Controller/logout.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="container products-container">
        <!-- Products Header -->
        <header class="products-header">
            <h1>Daily Fresh Products</h1>
            <p>Fresh farm products delivered to your doorstep</p>
            <div class="search-bar">
                <input type="text" placeholder="Search for products..." class="search-input">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </header>

        <!-- Category Navigation -->
        <nav class="category-nav">
            <button class="category-btn active" data-category="all">All Products</button>
            <button class="category-btn" data-category="vegetables">Vegetables</button>
            <button class="category-btn" data-category="fruits">Fruits</button>
            <button class="category-btn" data-category="grains">Grains & Cereals</button>
            <button class="category-btn" data-category="dairy">Dairy Products</button>
            <button class="category-btn" data-category="spices">Spices & Herbs</button>
        </nav>

        <!-- Products Grid -->
        <main class="products-main">
            <!-- Vegetables Category -->
        <?php
            $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch only vegetable products
            $sql = "SELECT * FROM products WHERE category='vegetables'";
            $result = $conn->query($sql);
        ?>

            <section class="category-section" id="vegetables">
                <h2 class="category-title">
                    <i class="fas fa-carrot"></i>
                    Fresh Vegetables
                </h2>

                <?php
            $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch only vegetable products
            $sql = "SELECT * FROM products WHERE category='vegetables'";
            $result = $conn->query($sql);
        ?>
                <div class="products-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $badge = !empty($row['badge']) ? $row['badge'] : 'Fresh';
                            
                            // Check if image exists, else use fallback
                            $imagePath = '../photos/' . htmlspecialchars($row['image']);
                            if (!file_exists($imagePath) || empty($row['image'])) {
                                $imagePath = '../photos/default.png'; // default image path
                            }

                            echo '<div class="product-card" data-category="vegetables">';
                            echo '    <div class="product-image">';
                            echo '        <img src="'.$imagePath.'" alt="'.htmlspecialchars($row['product_name']).'">';
                            echo '        <div class="product-badge">'.$badge.'</div>';
                            echo '    </div>';
                            echo '    <div class="product-info">';
                            echo '        <h3>'.htmlspecialchars($row['product_name']).'</h3>';
                            echo '        <p class="product-description">'.htmlspecialchars($row['description']).'</p>';
                            echo '        <div class="product-price">';
                            echo '            <span class="current-price">৳'.htmlspecialchars($row['price']).'/'.htmlspecialchars($row['quantity']). '</span>';
                            echo '        </div>';
                            echo '        <button class="btn btn-primary" onclick="addToCart('
                                        .htmlspecialchars($row['id']).", '".htmlspecialchars($row['product_name'])."', "
                                        .htmlspecialchars($row['price']).", '".$imagePath."'".')">Add to Cart</button>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No Vegetable products found.</p>';
                    }
                    ?>
                </div>
            </section>




            <!-- Fruits Category -->
            <section class="category-section" id="fruits">
                <h2 class="category-title">
                    <i class="fas fa-apple-alt"></i>
                    Fresh Fruits
                </h2>

                <?php
                    $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch only vegetable products
                    $sql = "SELECT * FROM products WHERE category='fruits'";
                    $result = $conn->query($sql);
                ?>
                <div class="products-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $badge = !empty($row['badge']) ? $row['badge'] : 'Organic';
                            
                            // Check if image exists, else use fallback
                            $imagePath = '../photos/' . htmlspecialchars($row['image']);
                            if (!file_exists($imagePath) || empty($row['image'])) {
                                $imagePath = '../photos/default.png'; // default image path
                            }

                            echo '<div class="product-card" data-category="fruits">';
                            echo '    <div class="product-image">';
                            echo '        <img src="'.$imagePath.'" alt="'.htmlspecialchars($row['product_name']).'">';
                            echo '        <div class="product-badge">'.$badge.'</div>';
                            echo '    </div>';
                            echo '    <div class="product-info">';
                            echo '        <h3>'.htmlspecialchars($row['product_name']).'</h3>';
                            echo '        <p class="product-description">'.htmlspecialchars($row['description']).'</p>';
                            echo '        <div class="product-price">';
                            echo '           <span class="current-price">৳' . htmlspecialchars($row['price']) . '/' . htmlspecialchars($row['quantity']) . '</span>';
                            echo '        </div>';
                            echo '        <button class="btn btn-primary" onclick="addToCart('
                                        .htmlspecialchars($row['id']).", '".htmlspecialchars($row['product_name'])."', "
                                        .htmlspecialchars($row['price']).", '".$imagePath."'".')">Add to Cart</button>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No Fruits found.</p>';
                    }
                    ?>
                       
                </div>
            </section>

            <!-- Grains Category -->
            <section class="category-section" id="grains">
                <h2 class="category-title">
                    <i class="fas fa-wheat-awn"></i>
                    Grains & Cereals
                </h2>

                <?php
                    $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Fetch only vegetable products
                    $sql = "SELECT * FROM products WHERE category='grains'";
                    $result = $conn->query($sql);
                ?>
                <div class="products-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $badge = !empty($row['badge']) ? $row['badge'] : 'Organic';
                            
                            // Check if image exists, else use fallback
                            $imagePath = '../photos/' . htmlspecialchars($row['image']);
                            if (!file_exists($imagePath) || empty($row['image'])) {
                                $imagePath = '../photos/default.png';
                            }

                            echo '<div class="product-card" data-category="fruits">';
                            echo '    <div class="product-image">';
                            echo '        <img src="'.$imagePath.'" alt="'.htmlspecialchars($row['product_name']).'">';
                            echo '        <div class="product-badge">'.$badge.'</div>';
                            echo '    </div>';
                            echo '    <div class="product-info">';
                            echo '        <h3>'.htmlspecialchars($row['product_name']).'</h3>';
                            echo '        <p class="product-description">'.htmlspecialchars($row['description']).'</p>';
                            echo '        <div class="product-price">';
                            echo '            <span class="current-price">৳'.htmlspecialchars($row['price']).'/'.htmlspecialchars($row['quantity']). '</span>';
                            echo '        </div>';
                            echo '        <button class="btn btn-primary" onclick="addToCart('
                                        .htmlspecialchars($row['id']).", '".htmlspecialchars($row['product_name'])."', "
                                        .htmlspecialchars($row['price']).", '".$imagePath."'".')">Add to Cart</button>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No Grain products found.</p>';
                    }
                    ?>
                       
                </div>
            </section>

            <!-- Dairy Category -->
            <section class="category-section" id="dairy">
                <h2 class="category-title">
                    <i class="fas fa-cheese"></i>
                    Dairy Products
                </h2>
                <?php
            $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch only vegetable products
            $sql = "SELECT * FROM products WHERE category='dairy'";
            $result = $conn->query($sql);
        ?>
                <div class="products-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $badge = !empty($row['badge']) ? $row['badge'] : 'Organic';
                            
                            // Check if image exists, else use fallback
                            $imagePath = '../photos/' . htmlspecialchars($row['image']);
                            if (!file_exists($imagePath) || empty($row['image'])) {
                                $imagePath = '../photos/default.png'; // default image path
                            }

                            echo '<div class="product-card" data-category="dairy">';
                            echo '    <div class="product-image">';
                            echo '        <img src="'.$imagePath.'" alt="'.htmlspecialchars($row['product_name']).'">';
                            echo '        <div class="product-badge">'.$badge.'</div>';
                            echo '    </div>';
                            echo '    <div class="product-info">';
                            echo '        <h3>'.htmlspecialchars($row['product_name']).'</h3>';
                            echo '        <p class="product-description">'.htmlspecialchars($row['description']).'</p>';
                            echo '        <div class="product-price">';
                            echo '            <span class="current-price">৳'.htmlspecialchars($row['price']).'/'.htmlspecialchars($row['quantity']). '</span>';
                            echo '        </div>';
                            echo '        <button class="btn btn-primary" onclick="addToCart('
                                        .htmlspecialchars($row['id']).", '".htmlspecialchars($row['product_name'])."', "
                                        .htmlspecialchars($row['price']).", '".$imagePath."'".')">Add to Cart</button>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No Dairy products found.</p>';
                    }
                    ?>
                </div>
            </section>

            <!-- Spices Category -->
            <section class="category-section" id="spices">
                <h2 class="category-title">
                    <i class="fas fa-mortar-pestle"></i>
                    Spices & Herbs
                </h2>
                <?php
            $conn = new mysqli('localhost', 'root', '', 'krishi_bazar');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Fetch only vegetable products
            $sql = "SELECT * FROM products WHERE category='spices'";
            $result = $conn->query($sql);
        ?>
                <div class="products-grid">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $badge = !empty($row['badge']) ? $row['badge'] : 'Organic';
                            
                            // Check if image exists, else use fallback
                            $imagePath = '../photos/' . htmlspecialchars($row['image']);
                            if (!file_exists($imagePath) || empty($row['image'])) {
                                $imagePath = '../photos/default.png'; // default image path
                            }

                            echo '<div class="product-card" data-category="spices">';
                            echo '    <div class="product-image">';
                            echo '        <img src="'.$imagePath.'" alt="'.htmlspecialchars($row['product_name']).'">';
                            echo '        <div class="product-badge">'.$badge.'</div>';
                            echo '    </div>';
                            echo '    <div class="product-info">';
                            echo '        <h3>'.htmlspecialchars($row['product_name']).'</h3>';
                            echo '        <p class="product-description">'.htmlspecialchars($row['description']).'</p>';
                            echo '        <div class="product-price">';
                            echo '            <span class="current-price">৳'.htmlspecialchars($row['price']).'/'.htmlspecialchars($row['quantity']). '</span>';
                            echo '        </div>';
                            echo '        <button class="btn btn-primary" onclick="addToCart('
                                        .htmlspecialchars($row['id']).", '".htmlspecialchars($row['product_name'])."', "
                                        .htmlspecialchars($row['price']).", '".$imagePath."'".')">Add to Cart</button>';
                            echo '    </div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No Spices and Herbs found.</p>';
                    }
                    ?>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Category filtering functionality
        const categoryButtons = document.querySelectorAll('.category-btn');
        const productCards = document.querySelectorAll('.product-card');
        const categorySections = document.querySelectorAll('.category-section');

        categoryButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetCategory = button.getAttribute('data-category');
                
                // Remove active class from all buttons
                categoryButtons.forEach(btn => btn.classList.remove('active'));
                
                // Add active class to clicked button
                button.classList.add('active');
                
                // Show/hide products based on category
                if (targetCategory === 'all') {
                    categorySections.forEach(section => {
                        section.style.display = 'block';
                    });
                } else {
                    categorySections.forEach(section => {
                        if (section.id === targetCategory) {
                            section.style.display = 'block';
                        } else {
                            section.style.display = 'none';
                        }
                    });
                }
            });
        });

        // Add to cart functionality
        const addToCartButtons = document.querySelectorAll('.add-to-cart');
        
        addToCartButtons.forEach(button => {
            button.addEventListener('click', () => {
                button.textContent = 'Added!';
                button.style.background = '#1a5d2e';
                
                setTimeout(() => {
                    button.textContent = 'Add to Cart';
                    button.style.background = '';
                }, 2000);
            });
        });

        // Search functionality
        const searchInput = document.querySelector('.search-input');
        const searchBtn = document.querySelector('.search-btn');

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            
            productCards.forEach(card => {
                const productName = card.querySelector('h3').textContent.toLowerCase();
                const productDescription = card.querySelector('.product-description').textContent.toLowerCase();
                
                if (productName.includes(searchTerm) || productDescription.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        searchBtn.addEventListener('click', performSearch);
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                performSearch();
            }
        });


        // Add product to localStorage
        function addToCart(id, name, price, image) {
            const product = { id, name, price, image };

            // Check if cart already exists in localStorage
            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            // Add the product to the cart
            cart.push(product);

            // Save the cart back to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Optionally, give feedback that the product was added
            alert(`${name} has been added to your cart.`);


            window.onload = function() {
        // Retrieve the username from localStorage
        const username = localStorage.getItem('username');

        // If username exists, display it in the profile section
        if (username) {
            const profileName = document.querySelector('.profile-name-mini');
            profileName.textContent = username;
        }
    };
        }


        window.onload = function() {
        // Retrieve the username from localStorage
        const username = localStorage.getItem('username');

        // If username exists, display it in the profile section
        if (username) {
            const profileName = document.querySelector('.profile-name-mini');
            profileName.textContent = username;  // This will show the username
        }
    };
    </script>
</body>
</html>