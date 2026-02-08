<?php
$conn = new mysqli("db", "newsuser", "newpassword", "newsdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
