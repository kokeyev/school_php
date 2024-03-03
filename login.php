<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input {
      width: 100%;
      padding: 8px;
      margin-bottom: 16px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #4caf50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>

<body>





  <form id="registrationForm" method="post" action="login_process.php">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" placeholder="Enter your password" required>

    <button type="submit" name="register_button">Log in</button>
  </form>

  <script>
    // Check if the URL contains the invalid_credentials parameter
    const urlParams = new URLSearchParams(window.location.search);
    const invalidCredentials = urlParams.get('invalid_credentials');
    const invalidEmail = urlParams.get('invalid_email');
    if (invalidCredentials !== null) {
        // Show an alert if invalid credentials are detected
        alert("Invalid email or password. Please try again.");
    }3
    if (invalidEmail !== null) {
        // Show an alert if invalid credentials are detected
        alert("Such email is not found");
    }

</script>
  
</body>

</html>