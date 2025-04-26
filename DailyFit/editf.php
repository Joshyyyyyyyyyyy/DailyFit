<?php
include 'db_conn.php';
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.html");
    exit;
}

$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = $id"));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];
  $image = $product['image'];

  if (!empty($_FILES['image']['name'])) {
    $image = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $image);
  }

  mysqli_query($conn, "UPDATE products SET name='$name', price='$price', rating='$rating', image='$image' WHERE id=$id");
  header("Location: admin_product.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Fit</title>
  <link rel="stylesheet" href="css/admin.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Chart.js for charts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    
    body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  padding: 30px;
}

h2 {
  margin-top: 20px;
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
}

form {
  max-width: 1000px;
  margin: auto;
  padding: 30px;
  border-radius: 15px;
}

.form-row {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.form-column {
  flex: 1;
  min-width: 300px;
}

label {
  font-weight: 500;
  margin-top: 10px;
  display: block;
}

input[type="text"],
input[type="number"],
input[type="file"] {
  width: 100%;
  padding: 12px;
  margin-top: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 8px;
}


img {
  display: block;
  margin: 10px 0;
  border-radius: 8px;
  max-width: 100%;
  height: auto;
}

button {
  margin-top: 20px;
  padding: 12px 20px;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s ease;
  width: fit-content;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

button:hover {
  background-color: #355edc;
}

@media (max-width: 768px) {
  .form-row {
    flex-direction: column;
  }

  button {
    width: 100%;
  }
}

@media (max-width: 480px) {
  form {
    padding: 20px;
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
    <h2> Edit Product</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-column">
          <label>Product Name: </label>
          <input type="text" name="name" value="<?= $product['name'] ?>" required>

          <label>Price:</label>
          <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

          <label>Rating:</label>
          <input type="number" step="0.1" name="rating" value="<?= $product['rating'] ?>" required>
        </div>

        <div class="form-column">
          <label>Current Image:</label>
          <img src="uploads/<?= $product['image'] ?>" alt="Product Image">

          <label>Upload New Image (Optional):</label>
          <input type="file" name="image" accept="image/*">
        </div>
      </div>

      <button type="submit" style="background-color: #ffd300;">Update Product</button>
    </form>
  </div>
      
    </main>
  </div>

  <script src="js/admin.js"></script>
</body>
</html>