<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Grid Layout</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5; /* Set background color of the body/HTML */
        }

        .navbar {
            overflow: hidden;
            width: 40%; /* Set width to 40% of the screen */
            margin: 20px auto; /* Center the navbar and add space */
            background-color: #333; /* Set background color of the navbar */
            text-align: center; /* Center the text within the navbar */
        }

        .navbar a {
            display: inline-block; /* Display buttons inline */
            width: 20%; /* Set width to 20% of the .navbar width */
            color: #f2f2f2;
            text-align: center;
            padding: 14px 0; /* Vertical padding remains the same, adjust as needed */
            text-decoration: none;
            background-color: #333; /* Set background color of buttons */
            cursor: pointer; /* Change cursor to pointer on hover */
            transition: background-color 0.3s; /* Smooth transition on hover */
        }

        .navbar a:hover {
            background-color: #555; /* Darken background color on hover */
        }

        
        .grid-container {
            display: grid;
            grid-template-columns: 10% 70% 20%;
            border: 2px solid #ccc;
            border-radius: 10px;
            overflow: hidden;
            margin: 20px auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 40%;
        }

        .grid-item {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .grid-item:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .grid-item:hover {
            background-color: #e0e0e0;
        }

        .search-box {
            text-align: center;
            margin-top: 20px;
            width: 37%; /* Set width to match the navbar width */
            margin: 0 auto; /* Center the search box */
        }

        .search-input {
            padding: 10px;
            width: 100%; /* Take up full width of the search box */
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .sort-button {
            margin-top: 10px;
            
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sort-button:hover {
            background-color: #555;
        }

        .sort-box {
            text-align: center;
        }


        
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">First</a>
        <a href="">Rating</a>
        <a href="services.html">Services</a>
        <a href="account.php">Account</a>
    </div>

    <div class="search-box">
        <input type="text" class="search-input" id="searchInput" onkeyup="updateGrid()" placeholder="Search...">
    </div>
    <div class="sort-box">
        <button class="sort-button" onclick="sortGrid()">Sort by Balance</button>

    </div>
    

    <div class="grid-container" id="gridContainer">



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

// SQL query to retrieve data from the database
$sql = "SELECT * FROM users";

$result = mysqli_query($conn, $sql);

$row_number = 1;
// Check if any rows were returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each row and display the data in the HTML grid
    while ($row = mysqli_fetch_assoc($result)) {

        echo '<div class="grid-item">' . $row_number . '</div>';
        echo '<div class="grid-item">' . $row['username'] . '</div>';
        echo '<div class="grid-item balance">' . $row['balance'] . '</div>'; // Use class 'balance' here
        $row_number+=1;
    }
} else {
    echo "No data found.";
}

// Close the database connection
mysqli_close($conn);
?>
        
    </div>

    <script>
    function updateGrid() {
        var searchValue = document.getElementById("searchInput").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("gridContainer").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "search.php?q=" + searchValue, true);
        xhttp.send();
    }

    document.addEventListener("DOMContentLoaded", function() {
        document.getElementById("searchInput").addEventListener("input", function() {
            updateGrid();
        });

        // Initial call to update grid with empty search value (show all records)
        updateGrid("");
    });


    let sortOrder = 'asc'; // Initialize sort order as ascending by default

function sortGrid() {
    // Get all grid items containing balance and username
    const gridItems = document.querySelectorAll('.grid-item');

    // Extract balance and username values from grid items
    const userBalances = [];
    gridItems.forEach(item => {
        // Check if the grid item has the class 'balance'
        if (item.classList.contains('balance')) {
            // Extract balance value and corresponding username
            const balance = parseFloat(item.textContent.trim());
            const username = item.previousElementSibling.textContent.trim(); // Get username from the previous sibling
            userBalances.push({ username, balance }); // Push username and balance into the array
        }
    });

    // Sort the list of usernames and balances based on balance values and sort order
    userBalances.sort((a, b) => {
        if (sortOrder === 'asc') {
            return a.balance - b.balance;
        } else {
            return b.balance - a.balance;
        }
    });

    // Create a new HTML string for the sorted grid
    let newGridHTML = '';
    userBalances.forEach((item, index) => {
        newGridHTML += `<div class="grid-item">${index + 1}</div>`; // Add row number
        newGridHTML += `<div class="grid-item">${item.username}</div>`; // Add username
        newGridHTML += `<div class="grid-item balance">${item.balance}</div>`; // Add balance with 'balance' class
    });

    // Replace the content of the grid container with the new HTML string
    const gridContainer = document.getElementById('gridContainer');
    gridContainer.innerHTML = newGridHTML;

    // Toggle the sort order for next click
    sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
}



</script>



</body>
</html>
