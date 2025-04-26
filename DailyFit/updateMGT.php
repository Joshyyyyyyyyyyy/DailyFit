<?php 
include 'db_conn.php';
// Initialize the session
session_start();

if (!isset($_GET['id'])) {
    echo "No product selected!";
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM allproduct WHERE id=$id");
$product = $result->fetch_assoc();

if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $price = $_POST['price'];
    $badge = $_POST['badge'];
    $description = $_POST['description'];
    $color1 = $_POST['color1'];
    $color2 = $_POST['color2'];
    $color3 = $_POST['color3'];
    $category = $_POST['category']; // Get the selected category from the form

    if ($_FILES['image']['name']) {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $target = "image/" . basename($imageName);
        move_uploaded_file($imageTmp, $target);
        $imageQuery = ", image='$target'";
    } else {
        $imageQuery = "";
    }

    // Update the product along with the category
    $sql = "UPDATE allproduct SET title='$title', price='$price', badge='$badge', description='$description', color1='$color1', color2='$color2', color3='$color3', category='$category' $imageQuery WHERE id=$id";
    $conn->query($sql);
    echo "<script>alert('Product updated successfully!'); window.location='admin_product.php';</script>";
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
  padding: 40px 20px;
}

h2 {
  text-align: center;
  margin-bottom: 30px;
  font-size: 28px;
}

form {
  max-width: 1200px;
  margin: auto;
  padding: 30px;
  border-radius: 15px;
  display: flex;
  flex-direction: column;
  gap: 30px;
}

.form-row {
  display: flex;
  flex-wrap: nowrap;
  gap: 20px;
  justify-content: space-between;
}

.form-group {
  flex: 1;
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 6px;
  font-weight: 500;
}

input[type="text"],
input[type="number"],
input[type="file"],
input[type="color"],
textarea,
select {
  padding: 12px;
  border-radius: 8px;
  border: none; 
  font-size: 16px;
}

input[type="color"] {
  padding: 4px;
  height: 50px;
}

textarea {
  resize: vertical;
}

button {
  align-self: center;
  width: 200px;
  padding: 14px;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s ease;
}

button:hover {
  background-color:rgb(192, 160, 0);
}

a {
  display: block;
  text-align: center;
  margin-top: 20px;
}

/* Responsive adjustments */
@media (max-width: 992px) {
  .form-row {
    flex-direction: column;
  }

  button {
    width: 100%;
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
      <form method="POST" enctype="multipart/form-data">
  <div class="form-row">
    <div class="form-group">
      <label>Title:</label>
      <input type="text" name="title" value="<?php echo $product['title']; ?>" required>
    </div>
    <div class="form-group">
      <label>Price:</label>
      <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>
    </div>
    <div class="form-group">
      <label>Badge:</label>
      <input type="text" name="badge" value="<?php echo $product['badge']; ?>" placeholder="Badge">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label>Description:</label>
      <textarea name="description" rows="4" required><?php echo $product['description']; ?></textarea>
    </div>
    <div class="form-group">
      <label>Category:</label>
      <select name="category" required>
        <option value="T-shirt" <?php echo $product['category'] == 'T-shirt' ? 'selected' : ''; ?>>T-shirt</option>
        <option value="Hoodie" <?php echo $product['category'] == 'Hoodie' ? 'selected' : ''; ?>>Hoodie</option>
        <option value="Shorts" <?php echo $product['category'] == 'Shorts' ? 'selected' : ''; ?>>Shorts</option>
      </select>
    </div>
  </div>

  <div class="form-row">
    <div class="form-group">
      <label>Image:</label>
      <input type="file" name="image">
    </div>
    <div class="form-group">
      <label>Color 1:</label>
      <input type="color" name="color1" value="<?php echo $product['color1']; ?>" required>
    </div>
    <div class="form-group">
      <label>Color 2:</label>
      <input type="color" name="color2" value="<?php echo $product['color2']; ?>" required>
    </div>
    <div class="form-group">
      <label>Color 3:</label>
      <input type="color" name="color3" value="<?php echo $product['color3']; ?>" required>
    </div>
  </div>

  <button type="submit" name="update" style="background-color: #FFD300;">Update Product</button>
</form>

    </main>
  </div>

  <script src="js/admin.js"></script>
</body>
</html>