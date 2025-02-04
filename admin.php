<?php 
session_start();
include "connect.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve form data
    $username = $_POST['username'];
    $user_password = $_POST['user_password'];

    // Check if all fields are filled
    if (empty($username) || empty($user_password)) {
        $message = "All fields are required.";
    } else {

        // Check for existing username
        $stmt = $connection->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verify password
            if (password_verify($user_password, $user['user_password'])) {
                $_SESSION['username'] = $username;
                header("Location: dashboard.php");
                exit();
            } else {
                $message = "Invalid password.";
            }
        } else {
            $message = "User not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin_style.css">
    <title>Login Page</title>
</head>
<body>
    <div class="login-container">
        <form action="">
            <h1>Login</h1>
            <div class="input-box">
                <input type="text" placeholder="  Username" required>
            </div>
            <div class="input-box">
                <input type="password" placeholder="  Password" required>
            </div>
            <div class="remember-forget">
                <label for=""><input type="checkbox">Remember me</label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn-login">Login</button>
        </form>
    </div>
</body>
</html>