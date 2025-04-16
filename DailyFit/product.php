<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Fit</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/product.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap">
  <script src="js/product.js" defer></script>
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
            <li><a href="index.php">Home</a></li>
            <li class="dropdown">
             <a href="#products" class="dropdown-toggle" onclick="toggleDropdown(event)">
              Products
             <svg style="margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <polyline points="6 9 12 15 18 9" />
             </svg>
            </a>
            <ul class="dropdown-menu">
          <li><a href="product.php">All Products</a></li>
          <li><a href="#tshirt">T-Shirts</a></li>
          <li><a href="#shorts">Shorts</a></li>
          <li><a href="#hoodies">Hoodies</a></li>
        </ul>
      </li>
            <li><a href="index.php" class="active">Products</a></li>
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

  <!-- Products Page -->
  <section class="products-page">
    <div class="container">
      <div class="products-header">
        <h1>All Products</h1>
        <p>Discover our collection of premium clothing</p>
      </div>

      <!-- Filters and Sort -->
      <div class="products-toolbar">
        <div class="filters">
          <div class="filter-group">
            <label for="category-filter">Category:</label>
            <div class="filter-buttons" id="category-filter">
              <button class="filter-btn active" data-category="all">All</button>
              <button class="filter-btn" data-category="tshirt">T-shirts</button>
              <button class="filter-btn" data-category="hoodie">Hoodies</button>
              <button class="filter-btn" data-category="short">Shorts</button>
            </div>
          </div>
          
          <div class="filter-group">
            <label for="price-filter">Price Range:</label>
            <select id="price-filter" class="filter-select">
              <option value="all">All Prices</option>
              <option value="0-25">Under $25</option>
              <option value="25-50">$25 - $50</option>
              <option value="50-100">$50 - $100</option>
              <option value="100+">$100+</option>
            </select>
          </div>
        </div>
        
        <div class="sort">
          <label for="sort-select">Sort by:</label>
          <select id="sort-select" class="filter-select">
            <option value="featured">Featured</option>
            <option value="price-low">Price: Low to High</option>
            <option value="price-high">Price: High to Low</option>
            <option value="newest">Newest</option>
          </select>
        </div>
      </div>

      <!-- Active Filters -->
      <div class="active-filters" id="active-filters">
        <!-- Active filters will be added here by JavaScript -->
      </div>

      <!-- Products Grid -->
      <div class="products-grid" id="products-grid">
      <div class="product-card">
      <div class="product-image">
        <img src="image/3.jpg" alt="Vintage Wash T-Shirt" />
      </div>
      <div class="product-info">
        <div class="product-name">Vintage Wash T-Shirt</div>
        <div class="product-price">$34.99</div>
        <div class="product-rating">Rating: ★★★★☆ (4.7)</div>
        <div class="product-colors">
          <div class="color-dot" style="background-color: #000000;"></div>
          <div class="color-dot" style="background-color: #6B7280;"></div>
          <div class="color-dot" style="background-color: #F59E0B;"></div>
        </div>
        <div class="product-description">
          Our vintage wash t-shirt has a lived-in feel from the first wear with a perfectly faded look.
        </div>
      </div>

      <!-- Pagination -->
      <div class="pagination" id="pagination">
        <!-- Pagination will be added here by JavaScript -->
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
          <p>Premium clothing for the modern individual.</p>
        </div>

        <div class="footer-column">
          <h3>Shop</h3>
          <ul>
            <li><a href="#">New Arrivals</a></li>
            <li><a href="#">Best Sellers</a></li>
            <li><a href="#">Sale</a></li>
            <li><a href="#">Collections</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Company</h3>
          <ul>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Sustainability</a></li>
            <li><a href="#">Careers</a></li>
            <li><a href="#">Press</a></li>
          </ul>
        </div>

        <div class="footer-column">
          <h3>Customer Service</h3>
          <ul>
            <li><a href="#">Contact Us</a></li>
            <li><a href="#">Shipping & Returns</a></li>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">Size Guide</a></li>
          </ul>
        </div>
      </div>

      <div class="footer-bottom">
        <p>© 2024 ELEGANCE. All rights reserved.</p>
        <div class="social-links">
          <a href="#" aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
            </svg>
          </a>
          <a href="#" aria-label="Instagram">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
              <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
              <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
            </svg>
          </a>
          <a href="#" aria-label="Twitter">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
              <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
            </svg>
          </a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Quick View Modal -->
  <div class="modal" id="quick-view-modal">
    <div class="modal-content">
      <button class="modal-close" id="modal-close">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
      </button>
      <div class="modal-body" id="modal-body">
        <!-- Product details will be added here by JavaScript -->
      </div>
    </div>
  </div>
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