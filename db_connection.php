<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "crud_app";

// Create connection
$conn = mysqli_connect("localhost", "root", "", "crud_app");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>