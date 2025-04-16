<?php
include 'db_conn.php';

// Delete product if delete button clicked
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM products WHERE id = $id");
  header("Location: client_products.php");
}

// Fetch all products
$result = mysqli_query($conn, "SELECT * FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Products</title>
  <style>
    body { font-family: Arial; padding: 20px; }
    table { border-collapse: collapse; width: 100%; margin-bottom: 20px; }
    th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
    .btn { padding: 6px 12px; text-decoration: none; margin-right: 5px; background-color: #007bff; color: white; border-radius: 4px; }
    .btn:hover { background-color: #0056b3; }
    .btn-danger { background-color: #dc3545; }
    .btn-danger:hover { background-color: #b02a37; }
  </style>
</head>
<body>

  <h2>DailyFit Product Management</h2>
  <a href="add_product.php" class="btn">Add New Product</a>

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
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <tr>
          <td><img src="image/<?= $row['image'] ?>" width="80"></td>
          <td><?= $row['name'] ?></td>
          <td>$<?= $row['price'] ?></td>
          <td><?= $row['rating'] ?></td>
          <td>
            <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
            <a href="client_products.php?delete=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

</body>
</html>
