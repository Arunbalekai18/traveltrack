<?php
$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$port = 4000;
$user = "yhQSbqlWsM4HhLAm.root";
$pass = "RP7JZZZH2snJFp3j";
$db   = "test";
$ssl_ca = __DIR__ . "/ca.pem"; // path to your CA file

$conn = mysqli_init();

// Set SSL options
mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

// Establish a secure connection
if (!mysqli_real_connect($conn, $host, $user, $pass, $db, $port, NULL, MYSQLI_CLIENT_SSL)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
?>
