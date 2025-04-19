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
    <h2>DAILYFIT PRODUCT MANAGEMENT</h2>
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
