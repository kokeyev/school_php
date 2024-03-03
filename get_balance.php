<?php
// Start the session
session_start();

// Check if the user is logged in
if (isset($_SESSION['user']) && isset($_SESSION['user']['username'])) {
    // Database connection parameters
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "nurzhan";

    // Establish connection to the database
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check if the connection is successful
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the username from the session data
    $username = $_SESSION['user']['username'];

    // Prepare and execute SQL query to fetch the balance of the user
    $sql = "SELECT username, email, balance FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful
    if ($result) {
        // Fetch the balance from the result
        $row = mysqli_fetch_assoc($result);
        $userInfo = array(
            'username' => $row['username'],
            'email' => $row['email'],
            'balance' => $row['balance']
        );
        
        // Send the balance as JSON response
        echo json_encode($userInfo);
    } else {
        // If query fails, send error message
        echo json_encode(array('error' => 'Failed to fetch user information.'));
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If user is not logged in or username is not set in session, send error message
    echo json_encode(array('error' => 'User not logged in.'));
}
?>
