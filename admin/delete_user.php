<?php
require "database.php";
$sql= "DELETE FROM user WHERE email='$_GET[email]'";
if ($conn->query($sql) === TRUE) {
  //echo "Record deleted successfully";
  header('Location: tables_user.php');
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>