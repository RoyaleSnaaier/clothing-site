<?php
require_once('config.php'); // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Hash the password before storing it
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Insert new user into database using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $new_username, $hashed_password);

    if ($stmt->execute()) {
        $success_message = "Account created successfully!";
    } else {
        $error_message = "Error creating account: " . $conn->error;
    }
}
?>
