<?php
$servername = "db";          // service name from docker-compose
$username   = "newsuser";    // must match MYSQL_USER
$password   = "newpassword"; // must match MYSQL_PASSWORD
$database   = "news";      // must match MYSQL_DATABASE

$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
