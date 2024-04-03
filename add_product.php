<?php
require_once 'config.php';

// Define variables to store form data
$name = $description = $price = $category = $image_url = $front_image_url = $back_image_url = $stock_quantity = $weight = $length = $width = $height = $color = $manufacturer = $rating = $product_url = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price']; // You may need additional validation here
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $image_url = mysqli_real_escape_string($conn, $_POST['image_url']);
    $front_image_url = mysqli_real_escape_string($conn, $_POST['front_image_url']);
    $back_image_url = mysqli_real_escape_string($conn, $_POST['back_image_url']);
    $stock_quantity = $_POST['stock_quantity']; // You may need additional validation here
    $weight = $_POST['weight']; // You may need additional validation here
    $length = $_POST['length']; // You may need additional validation here
    $width = $_POST['width']; // You may need additional validation here
    $height = $_POST['height']; // You may need additional validation here
    $color = mysqli_real_escape_string($conn, $_POST['color']);
    $manufacturer = mysqli_real_escape_string($conn, $_POST['manufacturer']);
    $rating = $_POST['rating']; // You may need additional validation here
    $product_url = mysqli_real_escape_string($conn, $_POST['product_url']);

    // Insert the new product into the database
    $sql = "INSERT INTO products (name, description, price, category, image_url, front_image_url, back_image_url, stock_quantity, weight, length, width, height, color, manufacturer, rating, product_url) 
            VALUES ('$name', '$description', '$price', '$category', '$image_url', '$front_image_url', '$back_image_url', '$stock_quantity', '$weight', '$length', '$width', '$height', '$color', '$manufacturer', '$rating', '$product_url')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to a confirmation page or back to the product list
        header("Location: index.php");
        exit();
    } else {
        // Handle any errors that occur during the insertion process
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="assets/style/admin-1.css">
</head>
<body>
    <div class="container">
        <h2>Add Product</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- Form fields for adding a new product -->
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description"></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="category">Category:</label>
                <input type="text" id="category" name="category">
            </div>
            <div class="form-group">
                <label for="image_url">Image URL:</label>
                <input type="text" id="image_url" name="image_url">
            </div>
            <div class="form-group">
                <label for="front_image_url">Front Image URL:</label>
                <input type="text" id="front_image_url" name="front_image_url">
            </div>
            <div class="form-group">
                <label for="back_image_url">Back Image URL:</label>
                <input type="text" id="back_image_url" name="back_image_url">
            </div>
            <div class="form-group">
                <label for="stock_quantity">Stock Quantity:</label>
                <input type="number" id="stock_quantity" name="stock_quantity">
            </div>
            <div class="form-group">
                <label for="weight">Weight:</label>
                <input type="number" id="weight" name="weight">
            </div>
            <div class="form-group">
                <label for="length">Length:</label>
                <input type="number" id="length" name="length">
            </div>
            <div class="form-group">
                <label for="width">Width:</label>
                <input type="number" id="width" name="width">
            </div>
            <div class="form-group">
                <label for="height">Height:</label>
                <input type="number" id="height" name="height">
            </div>
            <div class="form-group">
                <label for="color">Color:</label>
                <input type="text" id="color" name="color">
            </div>
            <div class="form-group">
                <label for="manufacturer">Manufacturer:</label>
                <input type="text" id="manufacturer" name="manufacturer">
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <input type="number" id="rating" name="rating"> 
                <!-- TODO: Add a star rating system here -->
            </div>
            <div class="form-group">
                <label for="product_url">Product URL:</label>
                <input type="text" id="product_url" name="product_url">
            </div>
            <!-- Add other form fields for product details here -->
            <button type="submit" class="submit-button">Add Product</button>
        </form>
    </div>
</body>
</html>
