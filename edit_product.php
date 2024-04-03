<?php
require_once 'config.php';

// Function to get product details by ID
function getProductById($product_id) {
    global $conn;
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

// Function to update product details
function updateProduct($product_id, $name, $description, $price, $category, $image_url, $front_image_url, $back_image_url, $stock_quantity, $weight, $length, $width, $height, $color, $manufacturer, $rating, $product_url) {
    global $conn;
    $sql = "UPDATE products SET name='$name', description='$description', price='$price', category='$category', image_url='$image_url', front_image_url='$front_image_url', back_image_url='$back_image_url', stock_quantity='$stock_quantity', weight='$weight', length='$length', width='$width', height='$height', color='$color', manufacturer='$manufacturer', rating='$rating', product_url='$product_url' WHERE id=$product_id";
    if ($conn->query($sql) === TRUE) {
        echo '<p class="success-message">Product updated successfully</p>';
    } else {
        echo "Error updating product: " . $conn->error;
    }
}

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    // Fetch product details
    $product = getProductById($product_id);
    if (!$product) {
        echo "Product not found";
        exit;
    }
} else {
    echo "Product ID not provided";
    exit;
}

// Check if form is submitted for updating product
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $image_url = $_POST['image_url'];
    $front_image_url = $_POST['front_image_url'];
    $back_image_url = $_POST['back_image_url'];
    $stock_quantity = $_POST['stock_quantity'];
    $weight = $_POST['weight'];
    $length = $_POST['length'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $color = $_POST['color'];
    $manufacturer = $_POST['manufacturer'];
    $rating = $_POST['rating'];
    $product_url = $_POST['product_url'];

    // Update product details
    updateProduct($product_id, $name, $description, $price, $category, $image_url, $front_image_url, $back_image_url, $stock_quantity, $weight, $length, $width, $height, $color, $manufacturer, $rating, $product_url);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="assets/style/admin-1.css">
</head>
<body>
    <div class="container">
        <h2>Edit Product</h2>
        <form method="POST" action="">
    <div class="form-section">
        <h3>Basic Information</h3>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>" >
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" value="<?php echo $product['price']; ?>">
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <input type="text" id="category" name="category" value="<?php echo $product['category']; ?>">
        </div>
    </div>
    
    <div class="form-section">
        <h3>Image URLs</h3>
        <div class="form-group">
            <label for="image_url">Image URL:</label>
            <input type="text" id="image_url" name="image_url" value="<?php echo $product['image_url']; ?>">
        </div>
        <div class="form-group">
            <label for="front_image_url">Front Image URL:</label>
            <input type="text" id="front_image_url" name="front_image_url" value="<?php echo $product['front_image_url']; ?>">
        </div>
        <div class="form-group">
            <label for="back_image_url">Back Image URL:</label>
            <input type="text" id="back_image_url" name="back_image_url" value="<?php echo $product['back_image_url']; ?>">
        </div>
    </div>
    
    <div class="form-section">
        <h3>Product Details</h3>
        <div class="form-group">
            <label for="stock_quantity">Stock Quantity:</label>
            <input type="number" id="stock_quantity" name="stock_quantity" value="<?php echo $product['stock_quantity']; ?>">
        </div>
        <div class="form-group">
            <label for="weight">Weight:</label>
            <input type="text" id="weight" name="weight" value="<?php echo $product['weight']; ?>">
        </div>
        <div class="form-group">
            <label for="length">Length:</label>
            <input type="text" id="length" name="length" value="<?php echo $product['length']; ?>">
        </div>
        <div class="form-group">
            <label for="width">Width:</label>
            <input type="text" id="width" name="width" value="<?php echo $product['width']; ?>">
        </div>
        <div class="form-group">
            <label for="height">Height:</label>
            <input type="text" id="height" name="height" value="<?php echo $product['height']; ?>">
        </div>
        <div class="form-group">
            <label for="color">Color:</label>
            <input type="text" id="color" name="color" value="<?php echo $product['color']; ?>">
        </div>
        <div class="form-group">
            <label for="manufacturer">Manufacturer:</label>
            <input type="text" id="manufacturer" name="manufacturer" value="<?php echo $product['manufacturer']; ?>">
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <input type="text" id="rating" name="rating" value="<?php echo $product['rating']; ?>">
        </div>
        <div class="form-group">
            <label for="product_url">Product URL:</label>
            <input type="text" id="product_url" name="product_url" value="<?php echo $product['product_url']; ?>" >
        </div>
    </div>
    
    <button type="submit" class="submit-button">Update Product</button>
</form>

    </div>
</body>
</html>
