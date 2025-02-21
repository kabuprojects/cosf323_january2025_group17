<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        nav {
            background-color: #0f142e; /* Navbar background color */
            box-shadow: 3px 3px 5px royalblue;
            padding: 10px 0; /* Reduced padding for less height */
        }

        nav ul {
            width: 100%;
            list-style: none;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 0; /* Remove default padding */
            margin: 0; /* Remove default margin */
        }

        nav li {
            height: auto; /* Adjust height */
            margin: 0 10px; /* Add margin for spacing */
        }

        nav a {
            height: 50px; /* Set height for links */
            padding: 0 20px; /* Adjust padding for links */
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #ffffff; /* White color for links */
            font-size: 16px; /* Adjust font size */
        }

        nav a:hover {
            background-color: #3b4b88; /* Lighter blue on hover */
        }

        .sidebar {
            color: blueviolet;
            position: fixed;
            top: 0;
            right: 0;
            height: 100vh;
            width: 250px;
            z-index: 999;
            background-color: #1a1d3b; /* Menu background color when toggled */
            backdrop-filter: blur(10px);
            box-shadow: -10px 0 10px cornflowerblue;
            display: none;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
        }

        .sidebar li {
            width: 100%; 
        }

        .sidebar a {
            width: 100%;
            padding: 15px 20px; /* Add padding for sidebar items */
            color: #ffffff; /* White color for sidebar links */
        }

        .menu-button {
            display: none;
        }

        .menu-button a {
            color: #ffffff; /* White color for the menu button */
        }

        .menu-button a:hover {
            color: #3b4b88; /* Optional: Change color on hover */
        }

        @media (max-width: 800px) {
            .hideOnMobile {
                display: none;
            }
            .menu-button {
                display: block;
            }
        }

        @media (max-width: 400px) {
            .sidebar {
                width: 100%;
            }
        }

        @media screen and (max-width: 600px) {
            #h3 {
                font-size: 36px;
                line-height: 50px;
            }
        }
    </style>
</head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick="hideSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="profile.php">Profile</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul id="nav-items">
            <li><a href="index.php" class="logo">UnRisk</a></li>
            <li class="hideOnMobile"><a href="index.php">Home</a></li>
            <li class="hideOnMobile"><a href="products.php">Products</a></li>
            <li class="hideOnMobile"><a href="profile.php">Profile</a></li>
            <li class="hideOnMobile"><a href="logout.php">Logout</a></li>
            <li class="menu-button" onclick="showSidebar()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>

    <script>
        function showSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'flex';
        }

        function hideSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.style.display = 'none';
        }

        // Close the sidebar if the user clicks outside of it
        window.onclick = function(event) {
            const sidebar = document.querySelector('.sidebar');
            if (!sidebar.contains(event.target) && !document.querySelector('.menu-button').contains(event.target)) {
                sidebar.style.display = 'none';
            }
        }

        // Hide sidebar on page load
        document.addEventListener("DOMContentLoaded", function() {
            hideSidebar();
        });
    </script>
</body>
</html>
