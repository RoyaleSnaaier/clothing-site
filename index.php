<?php
require_once 'config.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>... . -.-. .-. . -</title>
    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="assets/img/icons8-circled-i-32.png" type="image/x-icon">

    <!--=============== REMIXICONS ===============-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.4.0/remixicon.css" crossorigin="">

    <!--=============== STYLE ===============-->
    <link rel="stylesheet" href="assets/style/style-28.css">
</head>
<body>
    <button class="scroll__To__Top__Button magic-hover magic-hover__square" id="scrollToTopButton">Scroll to Top</button>
               <!-- <a class="nav__logo">
            <span id="audioControl" class="nav__logo-circle">
            <i class="ri-focus-fill"></i>
            </span>
               <span class="nav__logo-name magic-hover magic-hover__square"></span>
            </a> -->

        <header class="header" id="header">
            <nav class="nav__container">
                <div class="nav__menu" id="nav-menu">
                <ul class="nav__list magic-hover magic-hover__square">
                    <li class="nav__item">
                        <a href="#" class="nav__link">Home</a>
                    </li>

                    <li class="nav__item magic-hover magic-hover__square">
                        <a href="#products" class="nav__link">Products</a>
                    </li>

                    <li class="nav__item magic-hover magic-hover__square">
                        <a href="#" class="nav__link">FAQ</a>
                    </li>

                    <li class="nav__item magic-hover magic-hover__square">
                        <a href="#contact" class="nav__link nav__link-button ">Contact</a>
                    </li>
                </ul>
                </div>
                <a href="#" class="nav__link__cart magic-hover magic-hover__square" id="cart-icon">
                    <i class="ri-shopping-cart-line"></i>
                    <span>Cart</span>
                </a>
            </nav>
        </header>
    <main> 
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

        <section class="home__section" id="home">
            <div class="home__container container grid">
                <div class="home__content grid">
                    <div class="home__social">
                        <a href="https://www.linkedin.com/in/ingmar-van-rheenen-1b1b3b1b1/" target="_blank" class="home__social-icon magic-hover magic-hover__square">
                            <i class="ri-linkedin-fill"></i>
                        </a>
                        <a href="https://github.com/ingmrvr" target="_blank" class="home__social-icon magic-hover magic-hover__square">
                            <i class="ri-github-fill"></i>
                        </a>
                    </div>
                    <h1 id="audioControl" class="home__title">... . -.-. .-. . -</h1> 
                    <a href="#products" class="scroll-to-products magic-hover magic-hover__square" >
                    <i class="ri-arrow-down-s-line"></i>
                    </a>
                </div>
            </div>    
        </section>  
        <section class="products section" id="products">
    <h2 class="products__title">Products</h2>
    <?php
    // Query to select distinct categories from the database
    $category_query = "SELECT DISTINCT category FROM products";
    $category_result = $conn->query($category_query);

    // Check if there are any categories
    if ($category_result->num_rows > 0) {
        // Loop through each category
        while ($category_row = $category_result->fetch_assoc()) {
            $category = $category_row['category'];
            echo '<h3>' . $category . '</h3>';

            // Query to select products of the current category
            $product_query = "SELECT * FROM products WHERE category = '$category'";
            $product_result = $conn->query($product_query);

            // Check if there are any products in the category
            if ($product_result->num_rows > 0) {
                // Output data of each product
                echo '<div class="products___container container grid">';
                echo '<div class="products___content">';
                while ($row = $product_result->fetch_assoc()) {
                    // Create container for scrollable card item
                    echo '<div class="scrollable-card__item" onmouseenter="toggleImage(this, true)" onmouseleave="toggleImage(this, false)">';

                    // Start product card container
                    echo '<div class="product-card">';

                    // Create link around entire product card
                    echo '<a href="product_details.php?id=' . $row["id"] . '">';

                    // Display product image
                    if (!empty($row["image_url"])) {
                        // If image URL is not empty, use it
                        echo '<div class="image-container">';
                        echo '<a href="product_details.php?id=' . $row["id"] . '">'; // Moved inside image-container
                        echo '<img class="img magic-hover magic-hover__square front-image" src="' . $row["image_url"] . '" alt="Card Image">';
                        echo '<img class="img back-image magic-hover magic-hover__square" src="' . $row["image_url"] . '" alt="Back Image" style="display: none;">';
                        echo '</a>'; // Close the <a> tag here
                        echo '</div>';
                    } else {
                        // If image URL is empty, use default front image
                        echo '<div class="image-container">';
                        echo '<a href="product_details.php?id=' . $row["id"] . '">'; // Moved inside image-container
                        echo '<img class="img front-image magic-hover magic-hover__square" src="' . $row["front_image_url"] . '" alt="Front Image">';
                        echo '<img class="img back-image magic-hover magic-hover__square" src="' . $row["back_image_url"] . '" alt="Back Image" style="display: none;">';
                        echo '</a>'; // Close the <a> tag here
                        echo '</div>';
                    }

                    // Display product title
                    echo '<h3 class="scrollable-card__title">' . $row["name"] . '</h3>';

                    // Display product price
                    echo '<h5 class="scrollable-card__price">$' . $row["price"] . '</h5>';

                    // Add to cart button
                    echo '<button class="cart__button magic-hover magic-hover__square" onclick="addToCart(' . $row["id"] . ')"><i class="ri-shopping-cart-line"></i> Add to cart</button>';

                    // Close link tag for entire product card
                    echo '</a>';

                    // End product card container
                    echo '</div>'; // Closing div for product-card

                    // End scrollable card item container
                    echo '</div>';
                }
                echo '</div>'; // Closing div for products___content
                echo '</div>'; // Closing div for products___container
            } else {
                echo "<p>No products found in the category: $category</p>";
            }
        }
    } else {
        echo "No categories found.";
    }
    ?>
</section>

    
    


    </main>
    </div>
        <section class="contact section" id="contact">
                <div class="contact__container container grid">
                    <div class="info-wrapper">
                        <h2 class="contact__title">Contact me</h2>
                        <p class="contact__description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, voluptatem.</p>
                        <ul class="contact__list">
                            <li class="contact__item">
                                <i class="ri-map-pin-line"></i>
                                <span class="contact__text">Amersfoort, The Netherlands</span>
                            </li>
                            <li class="contact__item">
                                <i class="ri-mail-line"></i>
                                <span class="contact__text">i.vanrheenen@hotmail.com</span>
                            </li>
                            <li class="contact__item">
                                <i class="ri-phone-line"></i>
                                <span class="contact__text">+31 6 12345678</span>
                            </li>
                        </ul>
                    </div>
                            <!-- Map
                            <div class="google-maps">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2430.073013073073!2d4.890954315934682!3d52.37889397978769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c609c1f1d9e6e7%3A0x1b3b3f4   3b3f4!2sAmsterdam%20Centraal!5e0!3m2!1snl!2snl!4v1629780730737!5m2!1snl!2snl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </div> -->
                            <form action="#" class="contact__form grid" id="contactForm">
                                <div class="contact__inputs grid">
                                    <div class="contact__content">
                                        <label for="name" class="contact__label">Name</label>
                                        <input required type="text" class="contact__input magic-hover magic-hover__square" id="name" name="name">
                                    </div>
                                    <div class="contact__content">
                                        <label for="email" class="contact__label">Email</label>
                                        <input required type="email" class="contact__input magic-hover magic-hover__square" id="email" name="email">
                                    </div>
                                </div>
                                <div class="contact__content">
                                    <label for="subject" class="contact__label">Subject</label>
                                    <input required type="text" class="contact__input magic-hover magic-hover__square" id="subject" name="subject">
                                </div>
                                <div class="contact__content">
                                    <label for="message" class="contact__label">Message</label>
                                    <textarea required name="message" id="message" cols="0" rows="7" class="contact__input magic-hover magic-hover__square"></textarea>
                                </div>
                                <button type="submit" class="button magic-hover magic-hover__square">Send</button>
                            </form>
                </div>
            </section>
        </main>
    <footer class="footer section" id="footer">
        <div class="footer__container container grid">
            <div class="footer__content grid">
                <nav class="footer__menu">
                    <ul class="footer__list">
                        <li class="footer__item">
                            <a href="#home" class="footer__link magic-hover magic-hover__square">Home</a>
                        </li>
                        <li class="footer__item">
                            <a href="#about" class="footer__link magic-hover magic-hover__square">Products</a>
                        </li>
                        <li class="footer__item">
                            <a href="#projects" class="footer__link magic-hover magic-hover__square">FAQ</a>
                        </li>
                        <li class="footer__item">
                            <a href="#contact"  class="footer__link magic-hover magic-hover__square">Contact</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="footer__copyright">
                <p class="footer__copy">&#169; 2024 Ingmar van Rheenen. All right reserved.</p>
            </div>
        </div>
    </footer>
    <canvas class="canvas_products" id="particle-canvas"></canvas>
    <canvas class="canvas_products" id="video_canvas"></canvas>

<!-- include the GSAP library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>

    <!-- include mailjs library -->
    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@2.6.4/dist/email.min.js"></script>

    <!-- mouse library -->
    <script type="text/javascript" src="https://res.cloudinary.com/veseylab/raw/upload/v1684982764/magicmouse-2.0.0.cdn.min.js"></script>
    

    <!-- include your main.js file -->
    <script src="assets/js/main-13.js"></script>
  </body>
</html>