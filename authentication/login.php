<?php
session_start();

$login_error = "";

require_once "functions.php"; // Include functions.php to access isUserLoggedIn() function
require_once "dbconn.php";

if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT user_id, username, password_hash FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Use password_verify to check the password
        if (password_verify($password, $row["password_hash"])) {
            // Password is correct
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            header("Location: index.php");
            exit;
        } else {
            $login_error = "Invalid username or password";
        }
    } else {
        $login_error = "Invalid username or password";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <style>
       body {
      background-color: #000033;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-position: center;
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
    input[type="text"],
    input[type="password"] {
      width: 100%; 
      margin-bottom: 10px; 
      padding: 5px; 
      border: 2px solid blue; 
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

    @media (max-width: 600px) {
        .form-container {
            width: 100%;
            padding: 10px;
        }
        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="submit"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
        }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <?php if ($login_error): ?>
      <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
      <input type="text" name="username" placeholder="Username" required><br>
      <input type="password" name="password" placeholder="Password" required><br>
      <input type="submit" value="Login">
    </form>
    <div class="login-link">
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
  </div>
</body>
</html>
