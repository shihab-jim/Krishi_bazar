<?php
session_start();

// Restore session from cookie if session expired
if (!isset($_SESSION['username']) && isset($_COOKIE['username'])) {
    $_SESSION['username'] = $_COOKIE['username'];
    $_SESSION['role'] = $_COOKIE['role'] ?? 'registration';
}

// Redirect logged-in users
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: Model/admin.php");
    } elseif ($_SESSION['role'] === 'seller_registration') {
        header("Location: Model/seller_product.php");
    } else {
        header("Location: Model/product.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Krishi Bazar - Daily Grocery Needs</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="View/style.css">

    <script>
        // JavaScript function to open the registration page
        function openRegistrationPage() {
            window.location.href = 'View/registration.html'; // Redirect to registration page
        }
        function openLoginPage() {
        window.location.href = 'View/login.html'; // Redirect to login page
    }
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <i class="fas fa-leaf"></i>
                <span onclick="window.location.href='index.php'">Smart Krishi Bazar</span>
            </div>
            <ul class="nav-menu">
                <li><a href="#home">Home</a></li>
                <li><a href="#products">Products</a></li>
                <li><a href="#categories">Categories</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                
            </ul>
            <div class="nav-icons">
                <i class="fas fa-search"></i>
                <i class="fas fa-shopping-cart"></i>
                <button type="log" onclick="openLoginPage()">Login</button>
                
                    <button type="sign" onclick="openRegistrationPage()">Sign Up</button>

                
            </div>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Smart  <span class="highlight">Krishi Bazar</span></h1>
                <p>Discover the finest selection of fresh vegetables, fruits, dairy products, and pantry staples. Quality you can trust, delivered to your doorstep.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="window.location.href='View/login.html';">Shop Now</button>
                    <button class="btn btn-secondary" onclick="window.location.href='#about';"> Learn More</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="photos/market.jpg" alt="Fresh grocery shopping">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features">
        <div class="container">
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-truck"></i>
                    <h3>Free Delivery</h3>
                    <p>Free delivery on orders over ৳2000</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-leaf"></i>
                    <h3>100% Organic</h3>
                    <p>Certified organic products</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-clock"></i>
                    <h3>Same Day Delivery</h3>
                    <p>Order before 2 PM for same day delivery</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-shield-alt"></i>
                    <h3>Quality Guarantee</h3>
                    <p>100% satisfaction guarantee</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section id="categories" class="categories">
        <div class="container">
            <h2 class="section-title">Shop by Category</h2>
            <div class="categories-grid">
                <div class="category-card">
                    <img src="photos/vegetables.jpg" alt="Fresh Vegetables & Fruits">
                    <div class="category-overlay">
                        <h3>Fresh Vegetables & Fruits</h3>
                        <p>Farm-fresh produce daily</p>
                        <button class="btn btn-outline" onclick="window.location.href='View/login.html';">Shop Now</button>
                    </div>
                </div>
                <div class="category-card">
                    <img src="photos/dairy.jpg" alt="Dairy Products">
                    <div class="category-overlay">
                        <h3>Dairy Products</h3>
                        <p>Fresh milk, cheese & yogurt</p>
                        <button class="btn btn-outline" onclick="window.location.href='View/login.html';">Shop Now</button>
                    </div>
                </div>
                <div class="category-card">
                    <img src="photos/pantry.png" alt="Pantry Staples">
                    <div class="category-overlay">
                        <h3>Pantry Staples</h3>
                        <p>Grains, pasta & essentials</p>
                        <button class="btn btn-outline" onclick="window.location.href='View/login.html';">Shop Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section id="products" class="featured-products">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-image">
                        <img src="photos/tomato.jpg" alt="Fresh Tomatoes">
                        <div class="product-badge">Fresh</div>
                    </div>
                    <div class="product-info">
                        <h3>Organic Tomatoes</h3>
                        <p class="product-description">Fresh, juicy organic tomatoes</p>
                        <div class="product-price">
                            <span class="current-price">৳199/kg</span>
                            <span class="original-price">৳279</span>
                        </div>
                        <button class="btn btn-primary" onclick="showLoginMessage()">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="photos/cauliflower.png" alt="cauliflower">
                        <div class="product-badge">Organic</div>
                    </div>
                    <div class="product-info">
                        <h3>Cauliflower</h3>
                        <p class="product-description">Fresh seasonal Cauliflower</p>
                        <div class="product-price">
                            <span class="current-price">৳35/pc</span>
                        </div>
                        <button class="btn btn-primary" onclick="showLoginMessage()">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="photos/milk.jpg" alt="Fresh Milk">
                        <div class="product-badge">Premium</div>
                    </div>
                    <div class="product-info">
                        <h3>Fresh Whole Milk</h3>
                        <p class="product-description">Farm-fresh whole milk</p>
                        <div class="product-price">
                            <span class="current-price">৳139</span>
                        </div>
                        <button class="btn btn-primary" onclick="showLoginMessage()">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="photos/mango.jpg" alt="Fresh Fruits">
                        <div class="product-badge">Sweet</div>
                    </div>
                    <div class="product-info">
                        <h3>Mangoes</h3>
                        <p class="product-description">Hand-picked seasonal fruits</p>
                        <div class="product-price">
                            <span class="current-price">৳70/kg</span>
                            <span class="original-price">৳120/kg</span>
                        </div>
                        <button class="btn btn-primary" onclick="showLoginMessage()">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="photos/yogurt.jpg" alt="Yogurt">
                        <div class="product-badge">Healthy</div>
                    </div>
                    <div class="product-info">
                        <h3>Greek Yogurt</h3>
                        <p class="product-description">Creamy Greek yogurt</p>
                        <div class="product-price">
                            <span class="current-price">৳239</span>
                        </div>
                        <button class="btn btn-primary" onclick="showLoginMessage()">Add to Cart</button>
                    </div>
                </div>

                <div class="product-card">
                    <div class="product-image">
                        <img src="photos/basmati.jpeg" alt="Rice">
                        <div class="product-badge">Staple</div>
                    </div>
                    <div class="product-info">
                        <h3>Basmati Rice</h3>
                        <p class="product-description">Premium long-grain rice</p>
                        <div class="product-price">
                            <span class="current-price">৳250/kg</span>
                        </div>
                        <button class="btn btn-primary" onclick="showLoginMessage()">Add to Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title">What Our Customers Say</h2>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"The freshest groceries I've ever ordered online! Same-day delivery was perfect."</p>
                    <div class="customer">
                        <strong>Shihabjim</strong>
                        <span>Verified Customer</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"Outstanding quality and service. My family loves the organic produce selection."</p>
                    <div class="customer">
                        <strong>Annapurna</strong>
                        <span>Verified Customer</span>
                    </div>
                </div>
                <div class="testimonial-card">
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <p>"Convenient shopping experience with excellent customer service. Highly recommended!"</p>
                    <div class="customer">
                        <strong>Fahim_muntasir</strong>
                        <span>Verified Customer</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h2>About Smart Krishi Bazar</h2>
                    <p>We are passionate about bringing you the freshest, highest-quality groceries right to your doorstep. Our commitment to excellence means we work directly with local farmers and trusted suppliers to ensure every product meets our rigorous standards.</p>
                    <p>From crisp vegetables and sweet fruits to premium dairy products and pantry essentials, we carefully curate our selection to provide you with the best grocery shopping experience possible.</p>
                    <div class="about-stats">
                        <div class="stat">
                            <span class="stat-number">10,000+</span>
                            <span class="stat-label">Happy Customers</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">500+</span>
                            <span class="stat-label">Products</span>
                        </div>
                        <div class="stat">
                            <span class="stat-number">50+</span>
                            <span class="stat-label">Local Farmers</span>
                        </div>
                    </div>
                </div>
                <div class="about-image">
                    <img src="photos/agriculture.jpg" alt="About us">
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <div class="newsletter-content">
                <h2>Stay Fresh with Our Newsletter</h2>
                <p>Get exclusive deals, fresh recipes, and the latest updates on new arrivals</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email address" required>
                    <button type="submit" class="btn btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <h2 class="section-title">Get In Touch</h2>
            <div class="contact-content">
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h3>Address</h3>
                            <p>123 Krishi Street, Dhaka, Bangladesh</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h3>Phone</h3>
                            <p>+880 1724-931119</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h3>Email</h3>
                            <p>hello@smartkrishibazar.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h3>Hours</h3>
                            <p>Mon-Sun: 6:00 AM - 10:00 PM</p>
                        </div>
                    </div>
                </div>
                <form class="contact-form">
                    <input type="text" placeholder="Your Name" required>
                    <input type="email" placeholder="Your Email" required>
                    <textarea placeholder="Your Message" rows="5" required></textarea>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <div class="footer-logo">
                        <i class="fas fa-leaf"></i>
                        <span>Smart Krishi Bazar</span>
                    </div>
                    <p>Your trusted partner for fresh, quality groceries delivered right to your doorstep in Bangladesh.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#home">Home</a></li>
                        <li><a href="#products">Products</a></li>
                        <li><a href="#categories">Categories</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="#">Fruits & Vegetables</a></li>
                        <li><a href="#">Dairy Products</a></li>
                        <li><a href="#">Pantry Staples</a></li>
                        <li><a href="#">Organic Products</a></li>
                        <li><a href="#">Special Offers</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Delivery Info</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Track Order</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Smart Krishi Bazar. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        function showLoginMessage() {
            alert("Please login first!");
        }
    </script>
</body>
</html>


