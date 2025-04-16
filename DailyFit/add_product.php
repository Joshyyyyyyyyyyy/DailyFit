<?php
include 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  $rating = $_POST['rating'];
  $image = $_FILES['image']['name'];
  $target = "image/" . basename($image); // updated to match your actual folder
  
  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
    mysqli_query($conn, "INSERT INTO products (name, price, rating, image) VALUES ('$name', '$price', '$rating', '$image')");
    header("Location: client_products.php");
  } else {
    echo "Failed to upload image.";
  }
}
?>


<h2>Add New Product</h2>
<form method="post" enctype="multipart/form-data">
  <label>Product Name:</label><br>
  <input type="text" name="name" required><br><br>

  <label>Price:</label><br>
  <input type="number" step="0.01" name="price" required><br><br>

  <label>Rating:</label><br>
  <input type="number" step="0.1" name="rating" min="1" max="5" required><br><br>

  <label>Image:</label><br>
  <input type="file" name="image" accept="image/*" required><br><br>

  <button type="submit">Add Product</button>
</form>
