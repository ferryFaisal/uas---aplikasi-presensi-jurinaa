<?php
require "database.php";

// $date_created = date("d-m-Y");
// $date_modified = date("d-m-Y");
// insert data into table
$sql = "INSERT INTO user (email, name, password, role, date_created, date_modified) 
VALUES ('$email', '$name', '$pass', '$role', current_timestamp(), current_timestamp())";

if ($conn->query($sql) === TRUE) {
    // echo "New record created successfully";
    // header('Location: tables_user.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br>";
$conn->close();
// me-redirect ke file : read_data.php untuk menampilkan hasilnya
echo "<script> window.location.href='tables_user.php';</script>";
?>

  
