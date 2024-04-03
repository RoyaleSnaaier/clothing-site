<?php

// Database configuration
$servername = "sql11.freesqldatabase.com"; // Change this to your database server name
$username = "sql11695018"; // Change this to your database username
$password = "UCn4ftPQ1F"; // Change this to your database password
$database = "sql11695018"; // Change this to your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the connection is successful, you can optionally echo a message
// echo "Connected successfully";

?>
