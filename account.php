<?php
// Start the session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    // Redirect the user to the login page
    header("Location: register.html");
    exit; // Stop further execution of the script
}

// Continue with the rest of your HTML and PHP code for the account page
?>

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

        /* Grid layout styles */

        .container {
            width: 40%; /* Set width to 40% of the screen, same as navbar */
            margin: 20px auto; /* Center the container and add space */
            height: 70vh; /* 90% of the viewport height */
            display: flex;
            flex-direction: column;
        }

        .row {
            flex: 1; /* Each row takes equal space */
            display: flex;
            flex-direction: row;
            margin-bottom: 2%; /* Gap between rows */
        }

        .column {
            flex: 1; /* Each column takes equal space */
            display: flex;
            flex-direction: column;
            margin: 0% 1%; /* Gap between columns */
            background-color: #fff; /* Set background color of columns */
            border-radius: 5px; /* Add rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow effect */
            transition: transform 0.3s; /* Smooth transition on hover */
        }

        .column:hover {
            transform: translateY(-5px); /* Lift column on hover */
        }

        .column:first-child {
            flex: 8; /* First column takes 80% of the row */
        }

        .column:last-child {
            flex: 2; /* Last column takes 20% of the row */
        }

        /* Just for visualization */
        .item {
            padding: 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%; /* Ensure item takes full height of parent */
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 30px;
        }

        #accountInfo {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #555;
        }

        #logoutButton,
        #deleteAccountButton {
            display: inline-block;
            margin-right: 10px;
        }

        #logoutButton {
            background-color: #d9534f;
        }

        #logoutButton:hover {
            background-color: #c9302c;
        }

        #deleteAccountButton {
            background-color: #d9534f;
        }

        #deleteAccountButton:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

    <div class="navbar">
        <a href="index.php">First</a>
        <a href="rank.php">Rating</a>
        <a href="services.html">Services</a>
        <a href="">Account</a>
    </div>

    <div id="accountInfo">
        <h2>Your balance</h2>
        <form>
            <input type="text" id="balance" name="balance" value='Loading...' disabled>
        </form>
        <h2>Account Information</h2>
        <form id="changeInfoForm">

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="Loading...">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="Loading...">

            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword">

            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword">

            <label for="confirmPassword">Confirm New Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">

            <button type="submit">Save</button>

        </form>
        
        <button id="logoutButton" onclick="logout()">Log Out</button>
        <button id="deleteAccountButton" onclick="deleteAccount()">Delete Account</button>
    </div>

    <script>

        function deleteAccount() {
            if (confirm("Are you sure you want to delete your account?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        var response = JSON.parse(this.responseText);
                        if (response.success) {
                            // Optionally, perform any additional actions after successful deletion.
                            alert("Your account has been successfully deleted.");
                            window.location.href = "index.php"; // Redirect to the login page or any other appropriate page.
                        } else {
                            alert(response.error);
                            alert("Failed to delete the account. Please try again.");
                        }
                    }
                };
                xhttp.open("GET", "delete_account.php", true);
                xhttp.send();
            }
        }


        function logout() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Optionally, perform any additional actions after logout                       .
                    window.location.href = "index.php"; // Redirect to the login page
                }
            };
            xhttp.open("GET", "logout.php", true);
            xhttp.send();
        }

        // Function to fetch and update the balance
        function updateBalance() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.username !== undefined && response.email !== undefined && response.balance !== undefined) {
                        document.getElementById("name").value = response.username;
                        document.getElementById("email").value = response.email;
                        document.getElementById("balance").value = response.balance;
                    } else {
                        // If there's an error, display an error message
                        document.getElementById("balance").value = "opss";
                    }
                }
            };
            xhttp.open("GET", "get_balance.php", true);
            xhttp.send();
        }


        // Call the updateBalance function when the page loads
        window.onload = function() {
            updateBalance();
        };


        document.getElementById("changeInfoForm").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission
            
            var formData = new FormData(this);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.success) {
                        // Update user information displayed on the page
                        document.getElementById("email").value = formData.get("email");
                        document.getElementById("name").value = formData.get("name");
                        // Optionally, clear password fields
                        document.getElementById("currentPassword").value = "";
                        document.getElementById("newPassword").value = "";
                        document.getElementById("confirmPassword").value = "";
                        
                        // Optionally, display a success message
                        alert("User information updated successfully!");
                    } else {
                        // Display an error message
                        alert(response.error);
                        alert("Failed to update user information. Please try again.");
                    }
                }
            };
            xhttp.open("POST", "update_user_info.php", true);
            xhttp.send(formData);
    });

    </script>

</body>
</html>
