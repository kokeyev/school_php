<?php
// Start or resume the session.
session_start();

// Check if the user is logged in.
if (isset($_SESSION['user'])) {
    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "nurzhan";

    // Establish connection to the database
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check if the connection is successful
    if ($conn) {
        // Get the username of the logged-in user from the session
        $email = $_SESSION['user']['email'];

        // SQL query to delete the user account
        $sql = "DELETE FROM users WHERE email = '$email'";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            $_SESSION = array();

// Destroy the session
session_destroy();
            // Account deleted successfully
            $response = array("success" => true);
            echo json_encode($response);
        } else {
            // Failed to delete the account
            $response = array("success" => false, "error" => "Failed to delete the account.");
            echo json_encode($response);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // Failed to connect to the database
        $response = array("success" => false, "error" => "Database connection error.");
        echo json_encode($response);
    }
} else {
    // User is not logged in
    $response = array("success" => false, "error" => "User not logged in.");
    echo json_encode($response);
}
?>
