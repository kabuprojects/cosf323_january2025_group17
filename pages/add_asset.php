<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD ASSETS</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
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
