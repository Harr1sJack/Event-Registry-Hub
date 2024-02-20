<?php 
$servername = "localhost";
$username_db = "root";
$password_db = "";
$database = "eventregistryhub";

$conn = new mysqli($servername, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>