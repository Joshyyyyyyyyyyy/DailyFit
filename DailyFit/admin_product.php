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
              <span>Admin User</span>
              <i class="fas fa-chevron-down"></i>
            </button>
            <div class="profile-dropdown">
              <a href="#profile"><i class="fas fa-user"></i> My Profile</a>
              <a href="#account"><i class="fas fa-cog"></i> Account Settings</a>
              <a href="#help"><i class="fas fa-question-circle"></i> Help Center</a>
              <div class="dropdown-divider"></div>
              <a href="#logout" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
          </div>
        </div>
      </header>

      <?php
include 'db_conn.php';

// DELETE for client_products table
if (isset($_GET['delete_product'])) {
    $id = $_GET['delete_product'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    header("Location: manage_products.php");
}

// DELETE for allproduct table
if (isset($_GET['delete_allproduct'])) {
    $id = $_GET['delete_allproduct'];
    mysqli_query($conn, "DELETE FROM allproduct WHERE id = $id");
    echo "<script>alert('Product deleted successfully!'); window.location='ProductMGT.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/ProductMGT.css">
</head>
<body>

  <!-- SECTION 1: DAILYFIT PRODUCT MANAGEMENT -->
  <div class="section">
    <h2>DAILY FIT PRODUCT MANAGEMENT</h2>
    <p>FOR BEST SALE ONLY</p>
    <a href="add_product.php" class="btn">Add New Product</a>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Rating</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result1 = mysqli_query($conn, "SELECT * FROM products");
          while ($row = mysqli_fetch_assoc($result1)):
          ?>
          <tr>
            <td><img src="image/<?= $row['image'] ?>" width="80"></td>
            <td><?= $row['name'] ?></td>
            <td>$<?= $row['price'] ?></td>
            <td><?= $row['rating'] ?></td>
            <td class="actions">
              <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
              <a href="?delete_product=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- SECTION 2: FOR ALL PRODUCT -->
  <div class="section">
    <h2>FOR ALL PRODUCT</h2>
    <a href="upload.php" class="btn">Add New Product</a>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Title</th>
            <th>Price</th>
            <th>Badge</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $result2 = mysqli_query($conn, "SELECT * FROM allproduct");
          while ($row = mysqli_fetch_assoc($result2)):
          ?>
          <tr>
            <td><?= $row['title']; ?></td>
            <td>₱<?= number_format($row['price'], 2); ?></td>
            <td><?= $row['badge']; ?></td>
            <td><?= $row['description']; ?></td>
            <td><img src="<?= $row['image']; ?>" width="60" height="60"></td>
            <td class="actions">
              <a href="update.php?id=<?= $row['id']; ?>" class="btn">Update</a>
              <a href="?delete_allproduct=<?= $row['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-danger">Delete</a>
            </td>
          </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>

      
    </main>
  </div>

  <script src="js/admin.js"></script>
</body>
</html>