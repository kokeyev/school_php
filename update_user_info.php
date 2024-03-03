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

    // Collect form data
    $email = $_POST['email'] ?? '';
    $name = $_POST['name'] ?? '';
    $currentPassword = $_POST['currentPassword'] ?? '';
    $newPassword = $_POST['newPassword'] ?? '';
    $confirmPassword = $_POST['confirmPassword'] ?? '';

    // Validate and sanitize form data (you may need to implement more validation as per your requirements)
    $email = mysqli_real_escape_string($conn, $email);
    $name = mysqli_real_escape_string($conn, $name);

    // Check if the current password matches the stored password in the database
    // For security reasons, you should hash the passwords before storing them in the database
    // Here, we assume the password is stored as plaintext for simplicity, but it's not recommended in a real-world scenario
    $sql = "SELECT password FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $storedPassword = $row['password'];
        if ($currentPassword === $storedPassword) {
            // Current password matches, proceed to update user information
            // Update user information in the database
            $updateSql = "UPDATE users SET email = '$email', username = '$name' WHERE username = '$username'";
            if (mysqli_query($conn, $updateSql)) {
                // User information updated successfully
                // Optionally, update the password if new password is provided
                if (!empty($newPassword) && $newPassword === $confirmPassword) {
                    // Hash the new password before storing it in the database
                    
                    $updatePasswordSql = "UPDATE users SET password = '$newPassword' WHERE username = '$username'";
                    mysqli_query($conn, $updatePasswordSql);
                }
                // Send a success response
                echo json_encode(array('success' => true));
            } else {
                // Failed to update user information
                echo json_encode(array('success' => false, 'error' => 'Failed to update user information.'));
            }
        } else {
            // Current password does not match
            echo json_encode(array('success' => false, 'error' => $currentPassword));
        }
    } else {
        // Error retrieving stored password
        echo json_encode(array('success' => false, 'error' => 'Failed to retrieve stored password.'));
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // User is not logged in
    echo json_encode(array('success' => false, 'error' => 'User not logged in.'));
}
?>
