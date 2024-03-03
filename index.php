<?php
// Start the session
session_start();
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
    </style>
</head>
<body>

    <div class="navbar">
        <a href="">First</a>
        <a href="rank.php">Rating</a>
        <a href="services.html">Services</a>
        <a href="account.php">Account</a>
    </div>

    <!-- Grid layout content -->
    <div class="container">
        <div class="row">
            <div class="column">
                <div class="item">Полдник</div>
            </div>
            <div class="column">
                <div class="item">150 тг</div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="item">Депозит</div>
            </div>
            <div class="column">
                <div class="item">15%</div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="item">Кредит</div>
            </div>
            <div class="column">
                <div class="item">20%</div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="item">Доллар</div>
            </div>
            <div class="column">
                <div class="item">470 тг</div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div class="item">Комиссия перевода</div>
            </div>
            <div class="column">
                <div class="item">5%</div>
            </div>
        </div>
    </div>

</body>
</html>
