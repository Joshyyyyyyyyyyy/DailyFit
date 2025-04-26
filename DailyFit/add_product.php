<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Count total products in the table
  $result = mysqli_query($conn, "SELECT COUNT(*) as total FROM products");
  $data = mysqli_fetch_assoc($result);

  if ($data['total'] >= 4) {
    echo "<script>alert('Limit reached. Only 4 products allowed. Please edit or delete an existing one.'); window.location.href='ProductMGT.php';</script>";
    exit();
  }

  $name = $_POST['name'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];
  $image = $_FILES['image']['name'];
  $target = "image/" . basename($image);

  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    mysqli_query($conn, "INSERT INTO products (name, price, rating, image) VALUES ('$name', '$price', '$rating', '$image')");
    header("Location: ProductMGT.php");
  } else {
    echo "Failed to upload image.";
  }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/add_product.css">
</head>
<body>

<h2>Add New Product</h2>

<form method="post" enctype="multipart/form-data">
  <label for="name">Product Name:</label>
  <input type="text" name="name" required>

  <label for="price">Price:</label>
  <input type="number" step="0.01" name="price" required>

  <label for="rating">Rating:</label>
  <input type="number" step="0.1" name="rating" min="1" max="5" required>

  <label for="image">Image:</label>
  <input type="file" name="image" accept="image/*" required>

  <button type="submit">Add Product</button>
</form>

</body>
</html>
