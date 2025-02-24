<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HazardHub Navbar</title>
    <style>
        nav {
            background-color: #1a1d3b;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo a {
            font-size: 24px;
            font-weight: bold;
            color: #ff4500;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav li {
            margin: 0 15px;
        }

        nav a {
            padding: 10px 15px;
            text-decoration: none;
            color: #ffffff;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav a:hover {
            background-color: #ff4500;
            color: #ffffff;
        }

        .sidebar {
            color: #ffffff;
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 250px;
            z-index: 999;
            background-color: #1a1d3b;
            display: none;
            flex-direction: column;
            align-items: flex-start;
            padding: 20px;
        }

        .sidebar li {
            width: 100%;
            margin: 10px 0;
        }

        .sidebar a {
            width: 100%;
            padding: 10px;
            color: #ffffff;
            transition: background-color 0.3s ease;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background-color: #ff4500;
        }

        .menu-button {
            display: none;
            cursor: pointer;
            font-size: 24px;
            color: #ffffff;
        }

        @media (max-width: 800px) {
            nav ul {
                display: none;
            }

            .menu-button {
                display: block;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="logo">
            <a href="index.php">HazardHub</a>
        </div>
        <div class="menu-button" onclick="toggleSidebar()">&#9776;</div>
        <ul class="sidebar">
            <li onclick="toggleSidebar()"><a href="#">Close</a></li>
            <li><a href="/index.php">Home</a></li>
            <li><a href="risk_assessment.php">Risk Assessment</a></li>
            <li><a href="reporting_page.php">Reports</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul id="nav-items">
            <li><a href="/index.php">Home</a></li>
            <li><a href="risk_assessment.php">Risk Assessment</a></li>
            <li><a href="reporting_page.php">Reports</a></li>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            if (sidebar.style.display === 'flex') {
                sidebar.style.display = 'none';
            } else {
                sidebar.style.display = 'flex';
            }
        }

        window.onclick = function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuButton = document.querySelector('.menu-button');
            if (!sidebar.contains(event.target) && !menuButton.contains(event.target)) {
                sidebar.style.display = 'none';
            }
        }
    </script>
</body>
</html>
