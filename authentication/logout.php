<?php
session_start();

if (isset($_POST["confirm_logout"])) {
    $_SESSION = array();

    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]);
    }

    session_destroy();

    header("Location: login.php?logout=success");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    <style>
        body {
            background-color: #001f3f;
            font-family: Arial, sans-serif;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        section#logoutconf {
            background-color: #003366;
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        input[type="submit"], a.button {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover, a.button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <section id="logoutconf">
        <h2>Logout Confirmation</h2>
        <p>Are you sure you want to log out?</p>
        <form method="post" action="">
            <input type="submit" name="confirm_logout" value="Yes">
            <a href="/index.php" class="button">Cancel</a>
        </form>
    </section>
</body>
</html>
