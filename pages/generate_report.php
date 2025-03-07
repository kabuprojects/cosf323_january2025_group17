<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <style>
        body {
            background-color: white
        }
    </style>
</head>
<body>
    
</body>
</html>
<?php
require('../libs/tcpdf/tcpdf.php'); 
session_start();
include '../authentication/dbconn.php';

$pdf = new TCPDF();
$pdf->AddPage();
$pdf->SetFont('Helvetica', '', 12);
$pdf->Write(10, "Cybersecurity Vulnerability Report\n\n");

$user_id = $_SESSION['user_id'];
$query = "SELECT assets.asset_name, v.vulnerability_type, v.severity, v.description, v.detected_at 
          FROM vulnerabilities v 
          JOIN assets ON v.asset_id = assets.id
          WHERE assets.user_id = '$user_id'";

$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $pdf->Write(10, "{$row['asset_name']} - {$row['vulnerability_type']} ({$row['severity']})\n");
}

$pdf->Output('report.pdf', 'D');
?>
