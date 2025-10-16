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
    <title>Smart Krishi Bazar - Cart</title>
    <link rel="stylesheet" href="../View/cart.css">
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
                <a href="product.php" class="nav-link">Products</a>
                <a href="cart.php" class="nav-link active">Cart</a>
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

    <div class="container cart-container">
        <!-- Cart Header -->
        <header class="cart-header">
            <h1>Your Shopping Cart</h1>
            <p>Review your selected items</p>
        </header>

        <!-- Cart Items -->
        <main class="cart-main">
            <div id="cart-items" class="cart-items">
                <!-- Dynamically populated cart items will appear here -->
            </div>

            <div class="cart-summary">
                <h3>Order Summary</h3>
                <div class="summary-row">
                    <span>Total Items:</span>
                    <span id="total-items">0</span>
                </div>
                <div class="summary-row">
                    <span>Total Price:</span>
                    <span id="total-price">৳0</span>
                </div>
                <button class="btn btn-primary" id="checkout-btn" onclick="window.location.href='../View/payment.html';">Proceed to Checkout</button>
            </div>
        </main>
    </div>

    <script>
        // Retrieve cart data from localStorage and update the cart display
function updateCartDisplay() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear the cart items section

    let totalPrice = 0;
    let totalItems = 0;

    // Loop through the cart to display the products
    cart.forEach(product => {
        totalPrice += product.price;
        totalItems++;

        // Create the HTML structure for each cart item
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <div class="cart-item-image">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="cart-item-info">
                <h4>${product.name}</h4>
                <p>৳${product.price}</p>
            </div>
            <button class="btn btn-danger" data-id="${product.id}">Remove</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    // Update the total price and total items count
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('total-price').textContent = `৳${totalPrice}`;

    // Add event listener to each "Remove" button
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function () {
            const productId = parseInt(button.getAttribute('data-id'));
            removeFromCart(productId);
        });
    });
}

// Remove product from cart by id
function removeFromCart(productId) {
    // Get the cart from localStorage
    let cart = JSON.parse(localStorage.getItem('cart')) || [];

    // Filter out the product with the matching ID
    cart = cart.filter(product => product.id !== productId);

    // Save the updated cart back to localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

    // Update the cart display after removal
    updateCartDisplay();
}

// Initial cart display update when the page loads
  updateCartDisplay();







  document.addEventListener("DOMContentLoaded", function() {
      // Get stored values
      const username = localStorage.getItem("username");
      const email = localStorage.getItem("email");
      const mobile = localStorage.getItem("mobile");

      // Replace placeholders in profile header
      if (username) {
          document.querySelector(".profile-name").textContent = username;
          document.getElementById("firstName").value = username;
      }
      if (email) {
          document.querySelector(".profile-email").textContent = email;
          document.getElementById("email").value = email;
      }
      if (mobile) {
          document.getElementById("phone").value = mobile;
      }
  });

  window.onload = function() {
        // Retrieve the username from localStorage
        const username = localStorage.getItem('username');

        // If username exists, display it in the profile section
        if (username) {
            const profileName = document.querySelector('.profile-name-mini');
            profileName.textContent = username;  // This will show the username
        }
    };

    window.onload = function() {
    // Retrieve the username from localStorage
    const username = localStorage.getItem('username');

    // If username exists, display it in the profile section and the shipping address
    if (username) {
        document.querySelector('.profile-name-mini').textContent = username;
        document.getElementById('username-placeholder').textContent = username;
    }
};



// Inside your existing updateCartDisplay function in cart.html
function updateCartDisplay() {
    const cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartItemsContainer = document.getElementById('cart-items');
    cartItemsContainer.innerHTML = ''; // Clear the cart items section

    let totalPrice = 0;
    let totalItems = 0;

    // Loop through the cart to display the products
    cart.forEach(product => {
        totalPrice += product.price;
        totalItems++;

        // Create the HTML structure for each cart item
        const cartItem = document.createElement('div');
        cartItem.classList.add('cart-item');
        cartItem.innerHTML = `
            <div class="cart-item-image">
                <img src="${product.image}" alt="${product.name}">
            </div>
            <div class="cart-item-info">
                <h4>${product.name}</h4>
                <p>৳${product.price}</p>
            </div>
            <button class="btn btn-danger" data-id="${product.id}">Remove</button>
        `;
        cartItemsContainer.appendChild(cartItem);
    });

    // Update the total price and total items count
    document.getElementById('total-items').textContent = totalItems;
    document.getElementById('total-price').textContent = `৳${totalPrice}`;

    // Store the total price in localStorage
    localStorage.setItem('totalPrice', totalPrice);

    // Add event listener to each "Remove" button
    document.querySelectorAll('.btn-danger').forEach(button => {
        button.addEventListener('click', function () {
            const productId = parseInt(button.getAttribute('data-id'));
            removeFromCart(productId);
        });
    });
}



 </script>
</body>
</html>
