<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Fit </title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/product.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <!-- Header -->
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
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
             <a href="#products" class="dropdown-toggle" onclick="toggleDropdown(event)">
              Products
             <svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <polyline points="6 9 12 15 18 9" />
             </svg>
            </a>
            <ul class="dropdown-menu">
          <li><a href="allproduct.php">All Products</a></li>
          <li><a href="#tshirt">T-Shirts</a></li>
          <li><a href="#shorts">Shorts</a></li>
          <li><a href="#hoodies">Hoodies</a></li>
        </ul>
      </li>
            <li><a href="index.php">About</a></li>
            <li><a href="index.php">Contact</a></li>
          </ul>
        </nav>
        <div class="header-buttons">
          <button class="btn btn-outline" onclick="window.location.href='login.php'">Sign In</button>
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
        <li><a href="index.php">Home</a></li>
        <li><a href="products.html" class="active">Products</a></li>
        <li><a href="index.php">About</a></li>
        <li><a href="index.php">Contact</a></li>
      </ul>
      <div class="mobile-buttons">
        <button class="btn btn-outline" onclick="window.location.href='login.html'">Sign In</button>
        <button class="btn btn-primary">Shop Now</button>
      </div>
    </nav>
  </header>

  <!-- Main Content -->
  <main>
    <section class="products-page">
      <div class="container">
        <div class="products-header">
          <h1>All Products</h1>
          <p>Browse our collection of premium clothing</p>
        </div>

        <!-- Filters -->
        <div class="filter-container">
          <div class="filter-title">Filter by:</div>
          <div class="filter-options">
            <a href="#" class="filter-btn active">All</a>
            <a href="#" class="filter-btn">T-shirts</a>
            <a href="#" class="filter-btn">Hoodies</a>
            <a href="#" class="filter-btn">Shorts</a>
          </div>
        </div>

        <!-- Products Grid -->
        <div class="products-grid">
        <?php
$conn = new mysqli("localhost", "root", "", "dailyfit");

// Pagination setup
$limit = 16;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Fetch products
$sql = "SELECT * FROM allproduct ORDER BY id DESC LIMIT $start, $limit";
$result = $conn->query($sql);

// Display product cards
while ($row = $result->fetch_assoc()):
?>
  <div class="product-card">
    <div class="product-badge <?php echo strtolower(htmlspecialchars($row['badge'])); ?>">
      <?php echo htmlspecialchars($row['badge']); ?>
    </div>
    <div class="product-image">
      <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['title']); ?>">
      <div class="product-actions">
        <button class="action-btn"><i class="fas fa-heart"></i></button>
        <button class="action-btn"><i class="fas fa-eye"></i></button>
      </div>
    </div>
    <div class="product-info">
      <h3 class="product-title"><?php echo htmlspecialchars($row['title']); ?></h3>
      
      <p class="product-description">   
        <?php echo htmlspecialchars($row['description']); ?>
      </p>

      <div class="product-price">₱<?php echo number_format($row['price'], 2); ?></div>

      <div class="product-colors">
        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($row['color1']); ?>;"></span>
        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($row['color2']); ?>;"></span>
        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($row['color3']); ?>;"></span>
      </div>

      <button class="add-to-cart">Add to Cart</button>
    </div>
  </div>
<?php endwhile; ?>


        <!-- Pagination -->
        <div class="pagination">
          <a href="#" class="page-link prev" aria-label="Previous page">
            <i class="fas fa-chevron-left"></i>
          </a>
          <a href="#" class="page-link active">1</a>
          <a href="#" class="page-link">2</a>
          <a href="#" class="page-link">3</a>
          <a href="#" class="page-link">4</a>
          <span class="page-ellipsis">...</span>
          <a href="#" class="page-link">10</a>
          <a href="#" class="page-link next" aria-label="Next page">
            <i class="fas fa-chevron-right"></i>
          </a>
        </div>
      </div>
    </section>
  </main>

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
  <script src="js/product.js"></script>
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