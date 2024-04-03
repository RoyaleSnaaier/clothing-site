<?php
// Include the database connection file
require_once 'config.php';

// Check if the 'id' parameter is set in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to select the product details from the database based on the product ID
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    // Check if the query was successful and if the product exists
    if ($result && $result->num_rows > 0) {
        // Fetch the product details
        $product = $result->fetch_assoc();
        // You can display more details here as needed
    } else {
        // Product not found
        echo 'Product not found';
    }
} else {
    // 'id' parameter is not set in the URL
    echo 'Invalid product ID';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Add your CSS stylesheets here -->
    <link rel="stylesheet" href="assets/style/style-28.css">
        <!--=============== FAVICON ===============-->
        <link rel="shortcut icon" href="assets/img/icons8-circled-i-32.png" type="image/x-icon">

<!--=============== REMIXICONS ===============-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">

</head>
<body>
<div class="cart-menu" id="cart-menu">
        <div class="cart-header">
            <h2>Shopping Cart</h2>
            <button class="close-button magic-hover magic-hover__square" id="close-cart">
                <i class="ri-close-line"></i>
            </button>

        </div>
        <div class="cart-items" id="cart-items">
            <!-- Cart items will be displayed here -->
        </div>
        <div class="cart-footer">
            <h3>Total: $<span id="cart-total"></span></h3>
            <button class="button__cart__controls button--primary magic-hover magic-hover__square" id="checkout">
                <a class="buton__text__color" href="checkout.php">Checkout</a>
            </button>
        </div>
    </div>
<header class="header" id="header">
            <nav class="nav__container">
                <div class="nav__menu" id="nav-menu">
                <ul class="nav__list magic-hover magic-hover__square">
                    <li class="nav__item">
                        <a href="index.php" class="nav__link">Home</a>
                    </li>

                    <li class="nav__item magic-hover magic-hover__square">
                        <a href="index.php #products" class="nav__link">Products</a>
                    </li>

                    <li class="nav__item magic-hover magic-hover__square">
                        <a href="index.php" class="nav__link">FAQ</a>
                    </li>

                    <li class="nav__item magic-hover magic-hover__square">
                        <a href="index.php #contact" class="nav__link nav__link-button ">Contact</a>
                    </li>
                </ul>
                </div>
                <a href="#" class="nav__link__cart magic-hover magic-hover__square" id="cart-icon">
                    <i class="ri-shopping-cart-line"></i>
                    <span>Cart</span>
                </a>
            </nav>
        </header>
    <div class="container-fluid main-content">
        <div class="info_product_wrapper">
            <div class="product-details">
            <div class="product-image" id="productImage">
    <?php
    // Display product image
    if (!empty($product["image_url"])) {
        // If image URL is not empty, use it
        echo '<img class="img magic-hover magic-hover__square" src="' . $product["image_url"] . '" alt="Card Image">';
    } else {
        // If image URL is empty, use default front and back images
        echo '<div class="image-container">';
        echo '<img class="img front-image-info magic-hover magic-hover__square" src="' . $product["front_image_url"] . '" alt="Front Image">';
        echo '</div>';
        echo '<div class="image-info-container">';
        echo '<div class="front-image-wrapper">';
        echo '<div class="front-image-info"><img class="img front-image-info-small magic-hover magic-hover__square" src="' . $product["front_image_url"] . '" alt="Front Image"></div>';
        echo '</div>';
        echo '<div class="back-image-wrapper">';
        echo '<div class="back-image-info"><img class="img back-image-info-small magic-hover magic-hover__square" src="' . $product["back_image_url"] . '" alt="Front Image"></div>';
        echo '</div>';
        echo '</div>';
        
    }
    ?>
</div>


                <div class="product-info">
                    <!-- Display the product information here -->
                    <h1><?php echo $product['name']; ?></h1>
                    <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
                    <h4><strong>Description:</strong> <?php echo $product['description']; ?></h4>
                    <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
                 <!-- Add to cart button -->
                 <button class="cart__button__info magic-hover magic-hover__square" id="cartBtn_<?php echo $product["id"]; ?>" data-product-id="<?php echo $product["id"]; ?>" onclick="addToCart(<?php echo $product["id"]; ?>)"><i class="ri-shopping-cart-line"></i> Add to cart</button>
                <input type="number" min="1" value="1" id="quantity" class="input__quantity" />
                <small>(Quantity)</small>
                    <!-- Add more product details here as needed -->
                </div>
            </div>
        </div>
    </div>
    <canvas class="canvas" id="particle-canvas"></canvas>
    <canvas class="canvas" id="video_canvas"></canvas>

    <!-- Add Magic Mouse library -->
    <script type="text/javascript" src="https://res.cloudinary.com/veseylab/raw/upload/v1684982764/magicmouse-2.0.0.cdn.min.js"></script>

    <!-- Add your JavaScript code here -->
    <script src="assets//js/products-details-1.js"></script>
    
    
</body>
</html>
