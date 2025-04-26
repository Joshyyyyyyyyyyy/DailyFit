
<?php
include 'db_conn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Count total products in the table
  $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
  $data = mysqli_fetch_assoc($result);

  if ($data['total'] >= 4) {
    echo "<script>alert('Limit reached. Only 4 products allowed. Please edit or delete an existing one.'); window.location.href='admin_product.php';</script>";
    exit();
  }

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Fit</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Chart.js for charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
  
  body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

h2 {
  margin-top: 30px;
  text-align: center;
  margin-bottom: 30px;
  font-size: 28px;
}

form {
  padding: 5%;
  border-radius: 16px;
  display: grid;
  gap: 25px 40px;
}

label {
  font-weight: bold;
  display: block;
  margin-bottom: 8px;
  font-size: 15px;
}

input[type="text"],
input[type="number"],
input[type="file"] {
  width: 100%;
  border-color: #333;
  padding: 12px;
  border: none;
  border-radius: 6px;
  font-size: 15px;
}


button {
  grid-column: span 2;
  padding: 14px;
  font-size: 16px;
  border: none;
  font-weight: bold;
  border-radius: 8px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color:rgb(221, 184, 0);
}

@media (max-width: 768px) {
  form {
    grid-template-columns: 1fr;
    padding: 25px;
  }

  button {
    grid-column: span 1;
  }

  h2 {
    font-size: 22px;
  }
}


</style>
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
            <li>
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

      <div class="container">
    <h2>Add New Product</h2>
    <form method="post" enctype="multipart/form-data">
    <form method="post" enctype="multipart/form-data">
  <label for="name">Product Name:</label>
  <input type="text" name="name" placeholder="Enter the name"required>

  <label for="price">Price:</label>
  <input type="number" step="0.01" name="price" placeholder="Enter the price" required>

  <label for="rating">Rating:</label>
  <input type="number" step="0.1" name="rating" min="1" max="5" placeholder="Rate 1-5 "required>

  <label for="image">Image:</label>
  <input type="file" name="image" accept="image/*" required>

  <button type="submit" style="background-color: #ffd300;">Add Product</button>
</form>

    </form>
  </div>
      
    </main>
  </div>

  <script src="js/admin.js"></script>
</body>
</html>
