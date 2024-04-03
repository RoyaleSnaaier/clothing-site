<?php
session_start();
require_once('config.php'); // Include database connection

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $new_username = $_POST['new_username'];
    $new_password = $_POST['new_password'];

    // Hash the password before storing it
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

    // Insert new user into the database using prepared statement
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $new_username, $hashed_password);

    if ($stmt->execute()) {
        $registration_success = "Account created successfully!";
    } else {
        $registration_error = "Error creating account: " . $conn->error;
    }
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials using prepared statement
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            header("Location: site.php");
            exit;
        } else {
            $login_error = "Invalid username or password.";
        }
    } else {
        $login_error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Create Account</title>
    <!-- Include stylesheet -->
    <link rel="stylesheet" href="assets/style/style-14.css">
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($login_error)) { echo "<p>$login_error</p>"; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <h2>Create Account</h2>
    <?php if (isset($registration_success)) { echo "<p>$registration_success</p>"; } ?>
    <?php if (isset($registration_error)) { echo "<p>$registration_error</p>"; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="new_username">Username:</label>
        <input type="text" id="new_username" name="new_username" required>
        <label for="new_password">Password:</label>
        <input type="password" id="new_password" name="new_password" required>
        <button type="submit" name="register">Create Account</button>
    </form>

    <!-- include the GSAP library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>

    <!-- include mailjs library -->
    <script src="https://cdn.jsdelivr.net/npm/emailjs-com@2.6.4/dist/email.min.js"></script>

    <!-- mouse library -->
    <script type="text/javascript" src="https://res.cloudinary.com/veseylab/raw/upload/v1684982764/magicmouse-2.0.0.cdn.min.js"></script>
    

    <!-- include your main.js file -->
    <script src="assets/js/main-8.js"></script>
</body>
</html>
