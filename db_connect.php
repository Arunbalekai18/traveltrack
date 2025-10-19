<?php
$host = "gateway01.ap-southeast-1.prod.aws.tidbcloud.com";
$port = 4000;
$user = "yhQSbqWsM4HhLAm.root";
$pass = "RP7JZZZH2snJFp3j"; // Replace with your TiDB-generated password
$db   = "test";
$ssl_ca = __DIR__ . "/ca.pem"; // SSL certificate path

$conn = mysqli_init();

// Enable SSL
mysqli_ssl_set($conn, NULL, NULL, $ssl_ca, NULL, NULL);

// Connect securely
if (!mysqli_real_connect(
    $conn,
    $host,
    $user,
    $pass,
    $db,
    $port,
    NULL,
    MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT
)) {
    die("Connection failed: " . mysqli_connect_error());
}

$conn->set_charset("utf8mb4");
?>
