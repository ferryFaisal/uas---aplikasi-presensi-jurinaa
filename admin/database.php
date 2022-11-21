<?php
// used to connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "UASpresensi_jurina";

//create connection
$conn = new mysqli($servername, $username, $password,$dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>