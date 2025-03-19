<?php 
session_start();
include '../authentication/dbconn.php'; 

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized access!";
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT id, asset_name, ip_address, asset_type FROM assets WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "No assets found.";
    exit;
}

$scan_results = [];

while ($row = $result->fetch_assoc()) {
    $asset_id = $row['id'];
    $asset_name = $row['asset_name'];
    $ip_address = escapeshellcmd($row['ip_address']);
    $asset_type = strtolower($row['asset_type']);

    $issues = [];
    $ports_to_scan = [];

    // Determine ports based on asset type
    switch ($asset_type) {
        case "website":
            $resolved_ip = gethostbyname($ip_address);
            if ($resolved_ip === $ip_address) {
                $issues[] = "Domain resolution failed.";
            } else {
                $ip_address = $resolved_ip;
            }
            $ports_to_scan = [80, 443, 8080]; // Common web ports
            break;

        case "server":
            $ports_to_scan = [22, 80, 443, 3306, 8080, 3389]; // Essential server ports
            break;

        case "database":
            $ports_to_scan = [1433, 3306, 5432, 1521]; // Database ports
            break;

        default:
            $ports_to_scan = [22, 80, 443]; // Fallback ports
            break;
    }

    // Check if the host is reachable before scanning
    if (!fsockopen($ip_address, 80, $errno, $errstr, 2)) {
        $issues[] = "Host is unreachable.";
    } else {
        // Scan specific ports
        $sockets = [];
        $timeout = 2;

        foreach ($ports_to_scan as $port) {
            $sockets[$port] = @fsockopen($ip_address, $port, $errno, $errstr, $timeout);
        }

        foreach ($sockets as $port => $socket) {
            if (is_resource($socket)) {
                $issues[] = "Port $port - Open";
                fclose($socket);
            }
        }
    }

    // Determine risk level based on open ports count
    $risk_level = "Low";
    if (count($issues) > 5) {
        $risk_level = "High";
    } elseif (count($issues) > 2) {
        $risk_level = "Medium";
    }

    $scan_result = implode("; ", $issues) ?: "No open ports detected.";
    $scan_results[] = [
        'asset' => $asset_name,
        'issues' => $scan_result,
        'risk' => $risk_level
    ];

    // Insert scan results into `scan_results` table
    $insert = "INSERT INTO scan_results (asset_id, user_id, vulnerabilities, risk_level, scan_date) VALUES (?, ?, ?, ?, NOW())";
    $stmt_insert = $conn->prepare($insert);
    $stmt_insert->bind_param("iiss", $asset_id, $user_id, $scan_result, $risk_level);
    $stmt_insert->execute();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Scan Results</title>
    <link rel="stylesheet" href="../styles.css">
    <link rel="stylesheet" href="/css/navcss.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }
        nav {
            background-color: rgb(3, 15, 122);
            border-bottom-right-radius: 5px;
            border-bottom-left-radius: 10px;
            height: 70px;
            display: flex;
            align-items: center;
            padding: 0 20px;
        }

        .navbar-brand {
            font-size: 24px;
            color: red;
            text-decoration: none;
            margin-right: auto;
        }

        .navbar-nav {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        .navbar-nav li {
            margin-left: 20px;
        }

        .navbar-nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .navbar-nav a:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }


        .container {
            max-width: 700px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .result-card {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #fff;
        }
        .high { color: red; font-weight: bold; }
        .medium { color: orange; font-weight: bold; }
        .low { color: green; font-weight: bold; }
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
        <h1>Scan Results</h1>
        <?php foreach ($scan_results as $result): ?>
            <div class="result-card">
                <h2><?= htmlspecialchars($result['asset']) ?></h2>
                <p><strong>Vulnerabilities:</strong> <?= nl2br(htmlspecialchars($result['issues'])) ?></p>
                <p><strong>Risk Level:</strong> <span class="<?= strtolower($result['risk']) ?>"><?= $result['risk'] ?></span></p>
                <p><strong>Scanned At:</strong> <?= date("Y-m-d H:i:s") ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
