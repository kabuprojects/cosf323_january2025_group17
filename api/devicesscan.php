<?php
function scanNetwork() {
    $output = shell_exec("arp -a"); // Get ARP table
    $devices = [];

    // Extract IP and MAC addresses
    preg_match_all('/(\d+\.\d+\.\d+\.\d+)\s+.*?\s+((?:[0-9A-Fa-f]{2}-){5}[0-9A-Fa-f]{2})/', $output, $matches, PREG_SET_ORDER);

    foreach ($matches as $match) {
        $ip = $match[1];
        $mac = strtoupper($match[2]);

        // Exclude multicast/broadcast addresses
        if (!preg_match('/^(224|239|255)\./', $ip) && $mac !== "FF-FF-FF-FF-FF-FF") {
            $devices[] = ["ip" => $ip, "mac" => $mac];
        }
    }

    return $devices;
}

$devices = scanNetwork();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connected Devices</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; text-align: center; }
        h2 { color: #333; }
        table { width: 60%; margin: auto; border-collapse: collapse; background: white; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 10px; border: 1px solid #ddd; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f9f9f9; }

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
        <a class="navbar-brand" href="#" style="font-size: 40px;color: red;">HAZARD<span style="color:rgba(0, 0, 0, 0.8);">HUB</span></a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto" style="color: black;">
                <li class="nav-item"><a class="nav-link" href="/index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/reports.php">reports</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/my_assets.php">Assets</a></li>
                <li class="nav-item"><a class="nav-link" href="/pages/settings.php">Settings</a></li>
                <li class="nav-item"><a class="nav-link btn-get-started" href="/authentication/logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>


    <h2>Connected Devices</h2>
    <table>
        <tr>
            <th>IP Address</th>
            <th>MAC Address</th>
        </tr>
        <?php if (empty($devices)): ?>
            <tr><td colspan="2">No connected devices found.</td></tr>
        <?php else: ?>
            <?php foreach ($devices as $device): ?>
                <tr>
                    <td><?php echo $device["ip"]; ?></td>
                    <td><?php echo $device["mac"]; ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
