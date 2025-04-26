<?php
$conn = new mysqli("localhost", "root", "", "dailyfit");

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
  <title>Add New Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/upload.css">
</head>
<body>
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
      <button type="submit" name="submit">Upload Product</button>
    </div>

    <a href="admin_product.php">← Back to Product List</a>
  </form>
</body>
</html>
