<?php

$register_error = "";

require_once "dbconn.php"; // Include database connection
require_once "functions.php"; // Include functions for error handling and redirection

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"] ?? '';
    $username = $_POST["username"] ?? '';
    $password = $_POST["password"] ?? '';

    // Hash the password before storing it
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO users (email, username, password_hash) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $email, $username, $password_hash);

    if ($stmt->execute()) {
        // Registration successful, redirect to login page
        redirectIfNotLoggedIn("login.php");
    } else {
        // Check for duplicate email error
        if ($conn->errno === 1062) {
            // Duplicate entry error, handle accordingly
            $register_error = "Username or email already exists.";
        } else {
            // Other registration error, handle accordingly
            echo "Error registering user: " . $conn->error;
        }
    }

    $stmt->close();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <style>
        body {
            background-color: #000033;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Styles for the form container */
        .form-container {
            width: 300px; /* Set the width of the form container */
            padding: 20px; /* Add some padding around the form */
            border: 1px solid blueviolet; /* Add a border around the form */
            border-radius: 5px; /* Add rounded corners to the form */
            background-color: #0088cc; /* Set a light background color */
        }

        /* Styles for the form elements */
        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            margin-bottom: 10px;
            padding: 5px;
            border: 1px solid blue;
            border-radius: 9px;
        }

        input[type="submit"] {
            display: block;
            border: 1px solid blue;
            border-radius: 15px;
            margin: auto;
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Register</h2>
    <?php if ($register_error): ?>
        <p style="color: red;"><?php echo $register_error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" value="Register">
    </form>
    <div class="login-link">
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</div>
</body>
</html>
