<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <style>
        body{
            background-color: white;
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php
session_start();
include '../authentication/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access!");
}

$user_id = $_SESSION['user_id'];
$query = "SELECT assets.asset_name, v.vulnerability_name, v.risk_level, v.description, v.found_at 
          FROM vulnerabilities v 
          JOIN assets ON v.asset_id = assets.id
          WHERE assets.user_id = '$user_id'";

$result = mysqli_query($conn, $query);
?>

<h2>Vulnerability Reports</h2>
<table border="1">
    <tr>
        <th>Asset</th>
        <th>Vulnerability</th>
        <th>Severity</th>
        <th>Description</th>
        <th>Detected At</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo $row['asset_name']; ?></td>
        <td><?php echo $row['vulnerability_type']; ?></td>
        <td><?php echo $row['severity']; ?></td>
        <td><?php echo $row['description']; ?></td>
        <td><?php echo $row['detected_at']; ?></td>
    </tr>
    <?php } ?>
</table>
