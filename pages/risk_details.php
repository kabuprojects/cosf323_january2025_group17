<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Settings page</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        header {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }

        main {
            padding: 20px;
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 15px;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #007bff;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 600px) {
            main {
                padding: 15px;
            }
            button {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <?php include './navbar.php'; ?>

    <header>
        <h1>Settings</h1>
    </header>

    <main>
        
    </main>

    <footer>
        <p>© 2025 Risk Assessment Portal</p>
    </footer>

    <script src="./Risk Assessment Portal_files/script.js"></script>
</body>
</html>
