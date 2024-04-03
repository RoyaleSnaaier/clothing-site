<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Add your CSS stylesheets here -->
    <link rel="stylesheet" href="assets/style/style-28.css">
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/icons8-circled-i-32.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">
</head>
<body class="body_check__out">
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
            </nav>
        </header>
    <div class="container-fluid main-content">
        <div class="checkout-wrapper">
            <div class="cart_item_wrapper">
            <h1 class="check_out_h1">Cart Items</h1>

                <div id="cartItems" class="check_out_items"></div>
            </div>

                    <!-- Add checkout form fields here -->
                    <form action="process_checkout.php" method="POST" class="checkout-form">
                    <h1 class="check_out_h1">Checkout Form</h1>

                        <div class="form_wrapper">
                            <label for="name">Name:</label>
                            <input type="text" id="name" class="name" name="name" required>

                            <label for="email">Email:</label>
                            <input type="email" id="email" class="email" name="email" required>

                            <label for="address">Address:</label>
                            <input type="text" id="address" class="address" name="address" required>

                            <label for="paymentMethod">Payment Method:</label>
                            <select id="paymentMethod" name="paymentMethod" required>
                                <option value="creditCard">Credit Card</option>
                                <option value="paypal">PayPal</option>
                                <option value="bankTransfer">Bank Transfer</option>
                            </select>
                        </div>

                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                        <button type="submit" class="checkout-button magic-hover magic-hover__square">
                            <i class="ri-shopping-cart-line"></i> Checkout
                        </button>
                    </form>
            </div>
        </div>
    </div>
    <canvas class="canvas" id="particle-canvas"></canvas>
    <canvas class="canvas" id="video_canvas"></canvas>

    <!-- Add Magic Mouse library -->
    <script type="text/javascript" src="https://res.cloudinary.com/veseylab/raw/upload/v1684982764/magicmouse-2.0.0.cdn.min.js"></script>

    <!-- Add your JavaScript code here -->
    <script src="assets/js/checkout-1.js"></script>
    <script>
                // Retrieve cart items from localStorage
const cartData = JSON.parse(localStorage.getItem('cart'));

// Check if cartData is not null and it contains items
if (cartData && cartData.length > 0) {
    // Define the function to update cart items
    function updateCartItems() {
        const cartItemsContainer = document.getElementById('cartItems');
        // Clear the existing cart items
        cartItemsContainer.innerHTML = '';

        // Retrieve the products from the cart (assuming stored in localStorage)
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Iterate through each product in the cart and display it
        cart.forEach(item => {
            // Create a div element to display item details
            const itemDiv = document.createElement('div');
            // Wrap the item details in a div with a class "item-details"
            itemDiv.innerHTML = `
                <div class="item-details">
                    <h2>${item.name}</h2> 
                    <p>Price: $${item.price}</p>
                    <p>Quantity: ${item.quantity}</p>
                    <p>Total: $${(item.price * item.quantity).toFixed(2)}</p>
                    <img src="${item.front_image_url}" alt="${item.name}" class="front-image">
                    <button class="cart-item__remove-button magic-hover magic-hover__square" onclick="removeFromCart(${item.id})"><i class="ri-delete-bin-line"></i></button>
                </div>
            `;
            // Append the created div to the cart items container
            cartItemsContainer.appendChild(itemDiv);
        });
    }

    // Define the function to remove a product from the cart
    function removeFromCart(productId) {
        // Retrieve the cart from localStorage
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Find the index of the product with the given ID
        const productIndex = cart.findIndex(product => product.id === productId);

        // If the product is found, remove it from the cart
        if (productIndex !== -1) {
            cart.splice(productIndex, 1);
            
            // Save the updated cart back to localStorage
            localStorage.setItem('cart', JSON.stringify(cart));

            // Update the cart items on the page
            updateCartItems();
        } else {
            console.log("Product not found in the cart.");
        }
    }

    // Define the function to send an AJAX request to update the cart on the server
    function updateCartOnServer(cartData) {
        // Your AJAX request code here
    }

    // Call the updateCartItems function to display cart items initially
    updateCartItems();

    // Calculate the total amount of items in the cart
    let totalAmount = 0;
    cartData.forEach(item => {
        totalAmount += item.price * item.quantity;
    });

    // Display the total amount on the page
    document.getElementById('totalAmount').textContent = `Total: $${totalAmount}`;
} else {
    alert("Your shopping cart is empty");
    window.location.href = "index.php";
}




                </script>
</body>
</html>
