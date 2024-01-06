<?php
    
$hostname = "localhost";
$username = "root";
$password = "123";
$database = "quanlybt";

$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>