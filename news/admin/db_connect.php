<?php
$servername = "db";          // service name from docker-compose.yml
$username   = "newsuser";    // MYSQL_USER
$password   = "newpassword"; // MYSQL_PASSWORD
$dbname     = "newsdb";      // MYSQL_DATABASE

$cn = new mysqli($servername, $username, $password, $dbname);

if ($cn->connect_error) {
    die("Connection failed: " . $cn->connect_error);
}
?>
