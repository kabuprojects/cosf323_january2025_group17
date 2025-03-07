<?php
session_start();
include '../authentication/dbconn.php';

if (!isset($_SESSION['user_id'])) {
    die("You must be logged in to view your assets.");
}

$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM assets WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Assets</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            /*text-align: center;*/
        }

        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .scan-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .scan-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>My Assets</h2>
    <table>
        <tr>
            <th>Asset Name</th>
            <th>IP Address</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['asset_name']); ?></td>
            <td><?php echo htmlspecialchars($row['ip_address']); ?></td>
            <td><?php echo htmlspecialchars($row['asset_type']); ?></td>
            <td><a href="../api/scan.php?asset_id=<?php echo $row['id']; ?>" class="scan-btn">Scan</a></td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
