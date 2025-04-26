
<?php
include('db_conn.php');
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.html");
    exit;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];
  $image = $_FILES['image']['name'];
  $target = "image/" . basename($image);

  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    mysqli_query($conn, "INSERT INTO products (name, price, rating, image) VALUES ('$name', '$price', '$rating', '$image')");
    header("Location: admin_product.php");
  } else {
    echo "Failed to upload image.";
  }
}

if (isset($_POST['submit'])) {
  $title = $_POST['title'];
  $price = $_POST['price'];
  $badge = $_POST['badge'];
  $description = $_POST['description'];
  $color1 = $_POST['color1'];
  $color2 = $_POST['color2'];
  $color3 = $_POST['color3'];
  $category = $_POST['category']; // Get the category from the form

  // Image upload
  $imageName = $_FILES['image']['name'];
  $imageTmp = $_FILES['image']['tmp_name'];
  $target = "image/" . basename($imageName);
  move_uploaded_file($imageTmp, $target);

  // Insert the product along with the category
  $sql = "INSERT INTO allproduct (title, price, badge, description, color1, color2, color3, image, category) 
          VALUES ('$title', '$price', '$badge', '$description', '$color1', '$color2', '$color3', '$target', '$category')";
  $conn->query($sql);

  echo "<script>alert('Product uploaded successfully!'); window.location='admin_product.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Fit</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/upload.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Chart.js for charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="light-mode">
  <div class="admin-container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <div class="logo">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
            <line x1="3" y1="6" x2="21" y2="6"></line>
            <path d="M16 10a4 4 0 0 1-8 0"></path>
          </svg>
          <span class="logo-text">Daily Fit</span>
        </div>
        <button id="sidebar-toggle" class="sidebar-toggle">
          <i class="fas fa-bars"></i>
        </button>
      </div>
      
      <div class="sidebar-content">
        <nav class="sidebar-menu">
          <ul>
            <li class="#">
              <a href="admin.php">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="active">
              <a href="admin_product.php">
                <i class="fas fa-box"></i>
                <span>Products</span>
              </a>
            </li>
            <li>
              <a href="#orders">
                <i class="fas fa-shopping-cart"></i>
                <span>Orders</span>
              </a>
            </li>
            <li>
              <a href="#customers">
                <i class="fas fa-users"></i>
                <span>Customers</span>
              </a>
            </li>
            <li>
              <a href="#analytics">
                <i class="fas fa-chart-line"></i>
                <span>Analytics</span>
              </a>
            </li>
            <li>
              <a href="#inventory">
                <i class="fas fa-boxes"></i>
                <span>Inventory</span>
              </a>
            </li>
            <li>
              <a href="#settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <!-- Top Navigation -->
      <header class="top-nav">
        <div class="search-container">
          <i class="fas fa-search"></i>
          <input type="text" placeholder="Search...">
        </div>
        
        <div class="top-nav-right">
          <div class="theme-toggle">
            <input type="checkbox" id="theme-toggle-checkbox">
            <label for="theme-toggle-checkbox" class="theme-toggle-label">
              <i class="fas fa-sun"></i>
              <i class="fas fa-moon"></i>
              <span class="toggle-ball"></span>
            </label>
          </div>
          
          <div class="user-profile">
            <button class="profile-btn">
              <img src="https://placehold.co/200x200?text=Admin" alt="Admin User">
              <span class="welcome-message">Welcome, <?php echo htmlspecialchars($_SESSION["first_name"]); ?>!</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="profile-dropdown">
              <a href="#profile"><i class="fas fa-user"></i> My Profile</a>
              <a href="#account"><i class="fas fa-cog"></i> Account Settings</a>
              <a href="#help"><i class="fas fa-question-circle"></i> Help Center</a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </div>
        </div>
      </header>

     
      <h2>Add New Product</h2>
  <form method="POST" enctype="multipart/form-data">
    <div>
      <label>Product Title</label>
      <input type="text" name="title" placeholder="Enter product title" required>
    </div>

    <div>
      <label>Price</label>
      <input type="number" step="0.01" name="price" placeholder="Enter price" required>
    </div>

    <div>
      <label>Badge</label>
      <input type="text" name="badge" placeholder="New / Sale / Hot">
    </div>

    <div>
      <label>Description</label>
      <textarea name="description" placeholder="Enter product description" required></textarea>
    </div>

    <div>
      <label>Category</label>
      <select name="category" required>
        <option value="">Select Category</option>
        <option value="T-shirt">T-shirt</option>
        <option value="Hoodie">Hoodie</option>
        <option value="Shorts">Shorts</option>
        <option value="accessories">Accessories</option>
      </select>
    </div>

    <div>
      <label>Image</label>
      <input type="file" name="image" accept="image/*" required>
    </div>

    <div>
      <label>Product Colors</label>
      <div class="color-container">
        <input type="color" name="color1" required>
        <input type="color" name="color2" required>
        <input type="color" name="color3" required>
      </div>
    </div>

    <div style="grid-column: span 2; text-align: center;">
      <button type="submit" name="submit" style="background-color: #ffd300;" >Upload Product</button>
    </div>

    <a href="admin_product.php">← Back to Product List</a>
  </form>
      
    </main>
  </div>

  <script src="js/admin.js"></script>
</body>
</html>