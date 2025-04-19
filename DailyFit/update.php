<?php
$conn = new mysqli("localhost", "root", "", "dailyfit");

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

    if ($_FILES['image']['name']) {
        $imageName = $_FILES['image']['name'];
        $imageTmp = $_FILES['image']['tmp_name'];
        $target = "image/" . basename($imageName);
        move_uploaded_file($imageTmp, $target);
        $imageQuery = ", image='$target'";
    } else {
        $imageQuery = "";
    }

    $sql = "UPDATE allproduct SET title='$title', price='$price', badge='$badge', description='$description', color1='$color1', color2='$color2', color3='$color3' $imageQuery WHERE id=$id";
    $conn->query($sql);
    echo "<script>alert('Product updated successfully!'); window.location='ProductMGT.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Update Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="css/update.css">
</head>
<body>

  <h2>Update Product</h2>
  <form method="POST" enctype="multipart/form-data">
    <label>Title:</label>
    <input type="text" name="title" value="<?php echo $product['title']; ?>" required>

    <label>Price:</label>
    <input type="number" step="0.01" name="price" value="<?php echo $product['price']; ?>" required>

    <label>Badge:</label>
    <input type="text" name="badge" value="<?php echo $product['badge']; ?>" placeholder="Badge">

    <label>Description:</label>
    <textarea name="description" rows="4" required><?php echo $product['description']; ?></textarea>

    <label>Image:</label>
    <input type="file" name="image">

    <label>Color 1:</label>
    <input type="color" name="color1" value="<?php echo $product['color1']; ?>" required>

    <label>Color 2:</label>
    <input type="color" name="color2" value="<?php echo $product['color2']; ?>" required>

    <label>Color 3:</label>
    <input type="color" name="color3" value="<?php echo $product['color3']; ?>" required>

    <button type="submit" name="update">Update Product</button>
  </form>

  <a href="ProductMGT.php">← Back to Product List</a>

</body>
</html>
