<?php
include 'db_conn.php';

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
  header("Location: client_products.php");
}
?>

<h2>Edit Product</h2>
<form method="post" enctype="multipart/form-data">
  <label>Product Name:</label><br>
  <input type="text" name="name" value="<?= $product['name'] ?>" required><br><br>

  <label>Price:</label><br>
  <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required><br><br>

  <label>Rating:</label><br>
  <input type="number" step="0.1" name="rating" value="<?= $product['rating'] ?>" required><br><br>

  <label>Image:</label><br>
  <img src="uploads/<?= $product['image'] ?>" width="100"><br>
  <input type="file" name="image" accept="image/*"><br><br>

  <button type="submit">Update Product</button>
</form>
