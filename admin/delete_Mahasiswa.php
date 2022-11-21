<?php
require "database.php";

$sql= "DELETE FROM mahasiswa WHERE nim='$_GET[nim]'";
if ($conn->query($sql) === TRUE) {
  //echo "Record deleted successfully";
  header('Location: tables_mahasiswa.php');
} else {
  echo "Error deleting record: " . $conn->error;
}

$conn->close();

?>