<?php
session_start();

$login_error = "";

require_once "functions.php";
require_once "dbconn.php";

if (isUserLoggedIn()) {
    header("Location: /index.php");
    exit;
}

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
        if (password_verify($password, $row["password_hash"])) {
            $_SESSION["loggedin"] = true;
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            header("Location: /index.php");
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            background-color: #000033;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            width: 90%;
            max-width: 400px;
            padding: 30px;
            border: 1px solid #007bff;
            border-radius: 8px;
            background-color: #001a4d;
            color: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #007bff;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%; 
            margin-bottom: 15px; 
            padding: 12px; 
            border: 2px solid #007bff; 
            border-radius: 5px; 
            background-color: #003366; 
            color: #fff; 
            font-size: 16px;
            box-sizing: border-box; 
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #0056b3; 
            outline: none; 
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            border: none;
            border-radius: 5px;
            margin-top: 15px;
            padding: 12px;
            background-color: #007bff; 
            color: #fff; 
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #0056b3; 
            transform: scale(1.05);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
        }

        .login-link a {
            color: #007bff; 
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .login-link a:hover {
            color: #0056b3; 
        }

        @media (max-width: 600px) {
            .form-container {
                width: 90%; 
                padding: 20px;
            }
            .form-container input[type="text"],
            .form-container input[type="password"],
            .form-container input[type="submit"] {
                padding: 10px;
                font-size: 15px;
            }
            h2 {
                font-size: 24px; 
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <?php if ($login_error): ?>
            <p style="color: red; text-align: center;"><?php echo $login_error; ?></p>
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
