<?php
$servername = "db";          // service name from docker-compose
$username   = "newsuser";    // must match MYSQL_USER
$password   = "newpassword"; // must match MYSQL_PASSWORD
$database   = "newsdb";      // must match MYSQL_DATABASE

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
