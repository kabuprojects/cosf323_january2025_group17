<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Port Scanner</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
        }
        label {
            font-weight: bold;
        }
        input[type="submit"] {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
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
                <li class="nav-item"><a class="nav-link btn-get-started" href="/authentication/logout.php">Log out</a></li>
            </ul>
        </div>
    </nav>
    <h1>Automated Port Scanner</h1>
    <form action="" method="post">
        <label for="host">Enter Host (IP or Domain):</label>
        <input type="text" id="host" name="host" required><br><br>
        <input type="submit" value="Scan Ports">
    </form>
    

<?php

function scanPorts($host, $ports) {
    $openPorts = [];

    foreach ($ports as $port) {
        $connection = @fsockopen($host, $port, $errno, $errstr, 1); 
        if (is_resource($connection)) {
            $openPorts[] = $port;
            fclose($connection);
        }
    }

    return $openPorts;
}

function getRiskAdvice($openPorts) {
    $advice = [];
    foreach ($openPorts as $port) {
        switch ($port) {
            case 21:
                $advice[] = "Port 21 (FTP) is open. Ensure anonymous access is disabled.";
                break;
            case 22:
                $advice[] = "Port 22 (SSH) is open. Use strong passwords and key-based authentication.";
                break;
            case 23:
                $advice[] = "Port 23 (Telnet) is open. Use SSH instead, as Telnet is insecure.";
                break;
            case 25:
                $advice[] = "Port 25 (SMTP) is open. Secure your mail server to prevent spam abuse.";
                break;
            case 53:
                $advice[] = "Port 53 (DNS) is open. Ensure proper DNS configurations.";
                break;
            case 80:
                $advice[] = "Port 80 (HTTP) is open. Ensure your web server is secure.";
                break;
            case 110:
                $advice[] = "Port 110 (POP3) is open. Use SSL/TLS for security.";
                break;
            case 143:
                $advice[] = "Port 143 (IMAP) is open. Secure with SSL/TLS.";
                break;
            case 443:
                $advice[] = "Port 443 (HTTPS) is open. Check SSL/TLS certificate validity.";
                break;
            case 3389:
                $advice[] = "Port 3389 (RDP) is open. Enable network-level authentication.";
                break;
            default:
                $advice[] = "Port $port is open. Investigate the service running on this port.";
                break;
        }
    }
    return $advice;
}

$commonPorts = [21, 22, 23, 25, 53, 80, 110, 143, 443, 3389];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = htmlspecialchars($_POST['host']);
    
    if (!empty($host)) {
        $openPorts = scanPorts($host, $commonPorts);
        $advice = getRiskAdvice($openPorts);

        echo "<h2>Scan Results for $host</h2>";
        if (empty($openPorts)) {
            echo "No open ports found.";
        } else {
            echo "Open Ports: " . implode(", ", $openPorts) . "<br>";
            echo "<h3>Risk Advice:</h3>";
            foreach ($advice as $line) {
                echo "$line<br>";
            }
        }
    } else {
        echo "<h2>Please enter a valid host.</h2>";
    }
}
?>
</body>
</html>
