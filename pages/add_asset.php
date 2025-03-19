<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD ASSETS</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    <style>
                nav {
            color: black;
            background-color:rgb(3, 15, 122);
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 10px;
            height: 70px;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark" style="color:black;">
        <a class="navbar-brand" href="/index.php" style="font-size: 40px;color: red;">HAZARD<span style="color:rgba(0, 0, 0, 0.8);">HUB</span></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" style="color: black;">
                <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/reports.php">reports</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/my_assets.php">Assets</a></li>
                <li class="nav-item"><a class="nav-link btn-get-started" href="/authentication/logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>

</body>
</html>
<?php

session_start();
include '../authentication/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to add assets.");
}

if (isset($_POST['add_asset'])) {
    $user_id = $_SESSION['user_id'];  // Get logged-in user ID
    $asset_name = mysqli_real_escape_string($conn, $_POST['asset_name']);
    $ip_address = mysqli_real_escape_string($conn, $_POST['ip_address']);
    $asset_type = mysqli_real_escape_string($conn, $_POST['asset_type']);

    $query = "INSERT INTO assets (user_id, asset_name, ip_address, asset_type) 
              VALUES ('$user_id', '$asset_name', '$ip_address', '$asset_type')";
    if (mysqli_query($conn, $query)) {
        echo "Asset added successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<form method="post" action="add_asset.php">
    <input type="text" name="asset_name" placeholder="Asset Name" required>
    <input type="text" name="ip_address" placeholder="IP Address">
    <select name="asset_type">
        <option value="server">Server</option>
        <option value="database">Database</option>
        <option value="website">Website</option>
    </select>
    <button type="submit" name="add_asset">Submit</button>
</form>
