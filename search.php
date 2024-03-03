<?php
// Database connection parameters
$host = "localhost";
$username = "root";
$password = "";
$database = "nurzhan";

// Establishing connection to the database
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve the search query from the URL parameter
$searchQuery = $_GET['q'];

// SQL query to retrieve data from the database based on the search query
$sql = "SELECT * FROM users WHERE username LIKE '%$searchQuery%'";

$result = mysqli_query($conn, $sql);
$row_number = 1;

// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Start output buffering to capture HTML content
    ob_start();

    // Loop through each row and display the data in the HTML grid
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="grid-item">' . $row_number . '</div>';
        echo '<div class="grid-item">' . $row['username'] . '</div>';
        echo '<div class="grid-item balance">' . $row['balance'] . '</div>';
        $row_number+=1;
    }

    // End output buffering and store the captured HTML content
    $htmlContent = ob_get_clean();

    // Send the HTML content as response
    echo $htmlContent;
} else {
    // If no matching records found, send appropriate message as response
    echo "No matching records found.";
}

// Close the database connection
mysqli_close($conn);
?>
