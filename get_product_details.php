<?php
// Include database connection
require_once('config.php');

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $product_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch product details based on the provided ID
    $sql = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Fetch the product details
        $row = $result->fetch_assoc();

        // Prepare the product details as JSON response
        $response = array(
            'id' => $row['id'],
            'name' => $row['name'],
            'price' => $row['price'],
            'image_url' => $row['image_url'],
            'front_image_url' => $row['front_image_url']
        );

        // Send JSON response
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Product not found
        http_response_code(404);
        echo json_encode(array('message' => 'Product not found'));
    }
} else {
    // No product ID provided
    http_response_code(400);
    echo json_encode(array('message' => 'Product ID not provided'));
}
?>
