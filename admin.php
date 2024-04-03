<?php
require_once 'config.php';

// Function to fetch all products from the database
function getAllProducts() {
    global $conn;
    $sql = "SELECT * FROM products";
    $result = $conn->query($sql);
    $products = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

// Function to delete a product by ID
function deleteProduct($product_id) {
    global $conn;
    $sql = "DELETE FROM products WHERE id = $product_id";
    if ($conn->query($sql) === TRUE) {
        echo "Product deleted successfully";
    } else {
        echo "Error deleting product: " . $conn->error;
    }
}

// Check if the delete action is requested
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $product_id = $_GET['id'];
    deleteProduct($product_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="assets/style/admin-1.css">
</head>
<body>
    <div class="container">
        <h2>Product List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through your products and display them here -->
                <?php
                // Fetch products from the database
                $products = getAllProducts();

                foreach ($products as $product) {
                    echo "<tr>";
                    echo "<td>" . $product["id"] . "</td>";
                    echo "<td>" . $product["name"] . "</td>";
                    echo "<td>" . $product["description"] . "</td>";
                    echo "<td>$" . $product["price"] . "</td>";
                    echo "<td>" . $product["category"] . "</td>";
                    echo "<td class='action-links'><a href='edit_product.php?id=" . $product["id"] . "'>Edit</a><a href='?action=delete&id=" . $product["id"] . "'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <button class="add-product-button" onclick="window.location.href='add_product.php'">Add Product</button>
    </div>
</body>
</html>
