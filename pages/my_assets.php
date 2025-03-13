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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            
            /*text-align: center;*/
        }

        nav {
            color: black;
            background-color:rgb(3, 15, 122);
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 10px;
            height: 70px;
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
    <nav class="navbar navbar-expand-lg navbar-dark" style="color:black;">
        <a class="navbar-brand" href="#" style="font-size: 40px;color: red;">HAZARD<span style="color:rgba(0, 0, 0, 0.8);">HUB</span></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" style="color: black;">
                <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/reports.php">reports</a></li>
                <li class="nav-item"><a class="nav-link btn-get-started" href="/authentication/logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>


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

<h3>Add assets here! <a href="/pages/add_asset.php">Click here</a></h3>

</body>
</html>
