<?php
require "database.php";


//--------------------MySQLi Object-oriented------------------//
//create database 
$sql = "CREATE DATABASE UASpresensi_jurina";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();
?>