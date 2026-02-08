<?php
$servername = "db";          // Docker Compose service name
$username   = "newsuser";    // from docker-compose.yml
$password   = "newpassword"; // from docker-compose.yml
$dbname     = "newsdb";      // from docker-compose.yml

$cn = new mysqli($servername, $username, $password, $dbname);

if ($cn->connect_error) {
    die("Connection failed: " . $cn->connect_error);
}
?>
