<?php
// Database connection
$servername = "sql202.infinityfree.com";
$username = "if0_36480489";
$password = "Brian413983";
$dbname = "if0_36480489_MyTest"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
