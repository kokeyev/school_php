<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "nurzhan";

    // Establishing the connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Get the form data
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Validate and sanitize the data (you should implement proper validation)

    // Check if the entered credentials match any user in the database
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // If no matching email is found, redirect back to login page with invalid_email parameter
        header("Location: login.php?invalid_email=true");
        exit();
    }

    if (mysqli_num_rows($result) == 1) {
        // Authentication successful, store user information in session
        $_SESSION['user'] = mysqli_fetch_assoc($result);
        header("Location: index.php");
        exit();
    } else {
        // If no matching user is found
        header("Location: login.php?invalid_credentials=true");
    }
} else {
    echo "Invalid request.";
}
?>
