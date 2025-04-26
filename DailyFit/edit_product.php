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
  header("Location: add_product.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Product</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    
    body {
  margin: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-image: linear-gradient(109.6deg, #1a1a1a 71.8%, #2b2b2b 71.8%);
  color: #fff;
  padding: 30px;
}

h2 {
  text-align: center;
  font-size: 28px;
  margin-bottom: 20px;
}

form {
  max-width: 1000px;
  margin: auto;
  padding: 30px;
  border-radius: 15px;
}

.form-row {
  display: flex;
  gap: 30px;
  flex-wrap: wrap;
}

.form-column {
  flex: 1;
  min-width: 300px;
}

label {
  font-weight: 500;
  margin-top: 10px;
  display: block;
}

input[type="text"],
input[type="number"],
input[type="file"] {
  width: 100%;
  padding: 12px;
  margin-top: 10px;
  margin-bottom: 20px;
  border: none;
  border-radius: 8px;
  background-color: #333;
  color: #fff;
}

input[type="file"] {
  background-color: #2a2a2a;
}

img {
  display: block;
  margin: 10px 0;
  border-radius: 8px;
  max-width: 100%;
  height: auto;
}

button {
  margin-top: 20px;
  padding: 12px 20px;
  background-color: #1b3ba3;
  color: white;
  font-weight: bold;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  transition: background 0.3s ease;
  width: fit-content;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

button:hover {
  background-color: #355edc;
}

@media (max-width: 768px) {
  .form-row {
    flex-direction: column;
  }

  button {
    width: 100%;
  }
}

@media (max-width: 480px) {
  form {
    padding: 20px;
  }

  h2 {
    font-size: 22px;
  }
}

  </style>
</head>
<body>
<body>
  <div class="container">
    <h2> Edit Product</h2>
    <form method="post" enctype="multipart/form-data">
      <div class="form-row">
        <div class="form-column">
          <label>Product Name: </label>
          <input type="text" name="name" value="<?= $product['name'] ?>" required>

          <label>Price:</label>
          <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" required>

          <label>Rating:</label>
          <input type="number" step="0.1" name="rating" value="<?= $product['rating'] ?>" required>
        </div>

        <div class="form-column">
          <label>Current Image:</label>
          <img src="uploads/<?= $product['image'] ?>" alt="Product Image">

          <label>Upload New Image (Optional):</label>
          <input type="file" name="image" accept="image/*">
        </div>
      </div>

      <button type="submit">Update Product</button>
    </form>
  </div>
</body>

</body>
</html>
