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

    // Image upload
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $target = "image/" . basename($imageName);
    move_uploaded_file($imageTmp, $target);

    $sql = "INSERT INTO allproduct (title, price, badge, description, color1, color2, color3, image) 
            VALUES ('$title', '$price', '$badge', '$description', '$color1', '$color2', '$color3', '$target')";
    $conn->query($sql);

    echo "<script>alert('Product uploaded successfully!'); window.location='ProductMGT.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Upload Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/upload.css">
</head>
<body>
  <h2>🛍️ Upload New Product</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Product Title</label>
    <input type="text" name="title" placeholder="Enter product title" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price" placeholder="Enter price" required>

    <label>Badge</label>
    <input type="text" name="badge" placeholder="New / Sale / Hot">

    <label>Description</label>
    <textarea name="description" placeholder="Enter product description" required></textarea>

    <label>Image</label>
    <input type="file" name="image" accept="image/*" required>

    <label>Product Colors</label>
    <div class="color-container">
      <input type="color" name="color1" required>
      <input type="color" name="color2" required>
      <input type="color" name="color3" required>
    </div>

    <br>
    <button type="submit" name="submit">Upload Product</button>
    <a href="ProductMGT.php" style="text-align: center;">← Back to Product List</a>
  </form>
</body>
</html>
