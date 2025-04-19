<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Fit</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <script src="js/script.js" defer></script>
</head>
<body>
  <!-- Navigation -->
  <header class="header">
    <div class="container">
      <div class="header-content">
        <div class="logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <path d="M16 10a4 4 0 0 1-8 0"></path>
          </svg>
          <span>Daily Fit</span>
        </div>
        <nav class="nav-desktop">
          <ul>
            <li><a href="index.php" class="active">Home</a></li>
             <li class="dropdown">
             <a href="#products" class="dropdown-toggle" onclick="toggleDropdown(event)">
              Products
             <svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <polyline points="6 9 12 15 18 9" />
             </svg>
            </a>
            <ul class="dropdown-menu">
          <li><a href="allproduct.php">All Products</a></li>
          <li><a href="">T-Shirts</a></li>
          <li><a href="#shorts">Shorts</a></li>
          <li><a href="#hoodies">Hoodies</a></li>
        </ul>
      </li>
      <li><a href="#about">About</a></li>
      <li><a href="#contact">Contact</a></li>
  
      <li class="search">
        <input type="text" placeholder="Search..." />
      </li>         
          </ul>
        </nav>
        <div class="header-buttons">
          <button class="btn btn-outline" ><a href="login.php">Signup</a></button>
          <button class="btn btn-primary">Shop Now</button>
        </div>
        <button class="mobile-menu-btn" id="mobile-menu-btn">
          <span></span>
          <span></span>
          <span></span>
        </button>
      </div>
    </div>
    <nav class="nav-mobile" id="nav-mobile">
      <ul>
        <li><a href="#" class="active">Home</a></li>
        <li><a href="#products">Products</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
      <div class="mobile-buttons">
        <button class="btn btn-outline">Sign In</button>
        <button class="btn btn-primary">Shop Now</button>
      </div>
    </nav>
  </header>

  <!-- Hero Section -->
  <section class="hero">
    <div class="container">
      <div class="hero-content">
        <div class="hero-text">
          <h1>Elevate Your Everyday Style</h1>
          <p>A streetwear brand that focuses on bold and fresh designs to elevate everyday fashion.</p>
          <div class="hero-buttons">
            <button class="btn btn-primary btn-lg">
              Shop Collection
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="9 18 15 12 9 6"></polyline>
              </svg>
            </button>
            <button class="btn btn-outline btn-lg">Learn More</button>
          </div>
        </div>
        <div class="hero-image">
          <img src="image/1.png" alt="Fashion model wearing latest collection">
        </div>
      </div>
    </div>
  </section>

  <!-- Featured Products -->
<section id="products" class="products">
    <div class="container">
      <div class="section-header">
        <h2>Featured Collection</h2>
        <p>Discover our handpicked selection of this season's most stylish and comfortable pieces.</p>
      </div>
  
      <div class="product-grid">
        <?php
          include 'db_conn.php'; // database connection
  
          $sql = "SELECT * FROM products LIMIT 4";
          $result = mysqli_query($conn, $sql);
  
          while($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="product-card">
          <div class="product-image">
            <img src="image/<?php echo $row['image']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
          </div>
          <div class="product-info">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <div class="product-meta">
              <p class="product-price">$<?php echo $row['price']; ?></p>
              <div class="product-rating">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
                <span><?php echo $row['rating']; ?></span>
              </div>
            </div>
            <button class="btn btn-primary btn-sm">Add to Cart</button>
          </div>
        </div>
        <?php } ?>
      </div>
  
      <div class="view-all">
        <button class="btn btn-outline btn-lg"><a href="allproduct.php">
        View All Products
        </a>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="9 18 15 12 9 6"></polyline>
          </svg>
        </button>
      </div>
    </div>
  </section>
  
  <!-- About Section -->
  <section id="about" class="about">
    <div class="container">
      <div class="about-content">
        <div class="about-image">
          <img src="image/logo.jpg" alt="Our store">
        </div>
        <div class="about-text">
          <h2>Our Story</h2>
          <p>Founded in 2010, ELEGANCE has been dedicated to providing high-quality, stylish clothing that combines comfort with contemporary design. Our team of experienced designers works tirelessly to create pieces that help you express your unique style.</p>
          <p>We believe in sustainable fashion and ethical manufacturing. All our garments are produced using eco-friendly materials and processes, ensuring that we minimize our environmental impact while maximizing style and comfort.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Contact Section -->
  <section id="contact" class="contact">
    <div class="container">
      <div class="section-header">
        <h2>Get In Touch</h2>
        <p>Have questions about our products or services? We'd love to hear from you!</p>
      </div>
      <div class="contact-form-container">
        <form id="contact-form" class="contact-form">
          <div class="form-row">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" placeholder="Your name" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" placeholder="Your email" required>
            </div>
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" placeholder="How can we help?" required>
          </div>
          <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" placeholder="Your message" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary btn-block">Send Message</button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-column">
          <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span>Daily Fit</span>
          </div>
          <p>A streetwear brand that focuses on bold and fresh designs to elevate everyday fashion.</p>
        </div>

        <div class="footer-column">
          <h3>Shop</h3>
          <ul>
            <li><a href="product.php">New Arrivals</a></li>
            <li><a href="product.php">Best Sellers</a></li>
            <li><a href="product.php">Sale</a></li>
            <li><a href="product.php">Collections</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Company</h3>
          <ul>
            <li><a href="#about">About Us</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Customer Service</h3>
          <ul>
            <li><a href="#">Contact Us</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2025 Joshua Suruiz</p>
        <div class="social-links">
          <a href="https://www.facebook.com/profile.php?id=61575123990614" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </footer>
  <script>
    function toggleDropdown(event) {
      event.preventDefault();
      const dropdown = event.currentTarget.nextElementSibling;
  
      // Toggle show class
      dropdown.classList.toggle('show');
  
      // Close when clicking outside
      document.addEventListener('click', function outsideClick(e) {
        if (!event.currentTarget.parentElement.contains(e.target)) {
          dropdown.classList.remove('show');
          document.removeEventListener('click', outsideClick);
        }
      });
    }
  </script>
  
</body>
</html>