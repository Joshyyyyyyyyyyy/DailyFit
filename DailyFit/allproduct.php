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
  <style>
 .products-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 1.5rem;
}

/* Force consistent height and layout for cards */
.product-card {
  display: flex;
  flex-direction: column;
  height: 100%;
}

/* Stretch product-info to fill remaining space */
.product-info {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.search-bar-container {
  margin-bottom: 2rem;
  display: flex;
  justify-content: center;
}

.search-form {
  display: flex;
  width: 100%;
  border: 1px solid var(--border-color);
  border-radius: var(--radius);
  overflow: hidden;
  background-color: #fff;
}

.search-form input[type="text"] {
  flex: 1;
  padding: 0.5rem 1rem;
  border: none;
  outline: none;
  font-size: 1rem;
  color: var(--text-color);
}

.search-form button {
  background-color: #FFD700;
  border: none;
  padding: 0 1rem;
  cursor: pointer;
  color: #1a1a1a;
  font-size: 1rem;
  transition: background-color 0.3s ease;
}

.search-form button:hover {
  background-color: #e6c200;
}

  </style>
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
            <li><a href="index.php">Gallery</a></li>
            <li><a href="index.php">About</a></li>
            <li><a href="index.php">Contact</a></li>
          </ul>
        </nav>
        <div class="header-buttons">
          <button class="btn btn-outline" onclick="window.location.href='login.html'">Sign In</button>
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

       <!-- Search Bar -->
<div class="search-bar-container">
  <form method="GET" class="search-form">
    <input type="text" name="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit"><i class="fas fa-search"></i></button>
  </form>
</div>


       <!-- Products Grid --> 
<div class="products-grid">
<?php
$conn = new mysqli("localhost", "root", "", "dailyfit");

// Pagination setup
$limit = 16;
$page = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
$search = isset($_GET['search']) ? trim($conn->real_escape_string($_GET['search'])) : '';
$whereClause = $search ? "WHERE title LIKE '%$search%' OR description LIKE '%$search%'" : "";

// Get total rows for pagination
$countResult = $conn->query("SELECT COUNT(*) as total FROM allproduct $whereClause");
$totalRows = $countResult->fetch_assoc()['total'];
$totalPages = max(ceil($totalRows / $limit), 1);
$page = min($page, $totalPages); // Prevent out-of-range pages

$start = ($page - 1) * $limit;

// Fetch products
$sql = "SELECT * FROM allproduct $whereClause ORDER BY id DESC LIMIT $start, $limit";
$result = $conn->query($sql);

// Display products
if ($result->num_rows > 0):
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
      <p class="product-description"><?php echo htmlspecialchars($row['description']); ?></p>
      <div class="product-price">₱<?php echo number_format($row['price'], 2); ?></div>
      <div class="product-colors">
        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($row['color1']); ?>;"></span>
        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($row['color2']); ?>;"></span>
        <span class="color-dot" style="background-color: <?php echo htmlspecialchars($row['color3']); ?>;"></span>
      </div>
      <button class="add-to-cart">Add to Cart</button>
    </div>
  </div>
<?php 
    endwhile; 
else: 
?>
  <p style="color: white; text-align: center; width: 100%;">No products found on this page.</p>
<?php 
endif; 
?>
</div>

<?php
// Pagination links
if ($totalPages > 1) {
  echo '<div class="pagination">';
  $queryString = $search ? '&search=' . urlencode($search) : '';

  if ($page > 1) {
    echo '<a href="?page=' . ($page - 1) . $queryString . '" class="page-link prev"><i class="fas fa-chevron-left"></i></a>';
  }

  for ($i = 1; $i <= $totalPages; $i++) {
    $active = $i == $page ? 'active' : '';
    echo '<a href="?page=' . $i . $queryString . '" class="page-link ' . $active . '">' . $i . '</a>';
  }

  if ($page < $totalPages) {
    echo '<a href="?page=' . ($page + 1) . $queryString . '" class="page-link next"><i class="fas fa-chevron-right"></i></a>';
  }

  echo '</div>';
}
?>



      
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