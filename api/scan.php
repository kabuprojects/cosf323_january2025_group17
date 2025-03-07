<?php
session_start();
include '../authentication/dbconn.php'; // Database connection

if (!isset($_SESSION['user_id'])) {
    echo "Unauthorized access!";
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch assets linked to this user
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
            // Convert domain to IP (if applicable)
            $resolved_ip = gethostbyname($ip_address);
            if ($resolved_ip === $ip_address) {
                $issues[] = "Domain resolution failed.";
            } else {
                $ip_address = $resolved_ip;
            }
            $ports_to_scan = [80, 443, 8080]; // Common web ports
            break;

        case "server":
            $ports_to_scan = [22, 80, 443, 3306, 8080, 3389];
            //$ports_to_scan = range(1, 2500); // Server ports (SSH, HTTP, HTTPS, MySQL, RDP)
            break;

        case "database":
            $ports_to_scan = [1433, 3306, 5432, 1521]; // Database ports (MSSQL, MySQL, PostgreSQL, Oracle)
            break;

        default:
            $ports_to_scan = [22, 80, 443]; // Fallback ports
            break;
    }

    // Scan each port using fsockopen
    foreach ($ports_to_scan as $port) {
        $connection = @fsockopen($ip_address, $port, $errno, $errstr, 2);
        if (is_resource($connection)) {
            $issues[] = "Port $port - Open";
            fclose($connection);
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
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
