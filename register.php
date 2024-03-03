<?php
session_start(); // Start the session

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
    $name = $_POST["name"];

    
    if(isset($_POST['register_button'])){
        $query = mysqli_query($conn, "INSERT INTO users VALUES ('$email', '$password', '$name', '0')");
        $_SESSION['user'] = array(
            'email' => $email,
            'password' => $password,
            'username' => $name,
            'balance' => 0
        );
        header("Location: index.php");
        exit();
    } else {
        echo "Error saving registration data.";
    }
} else {
    echo "Invalid request.";
}
?>
