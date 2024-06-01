<?php
$servername = "localhost";
$database = "beanwave";
$username = "root";
$password = "root";

$base_url = "http://localhost:8888/beanwave/";

$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
