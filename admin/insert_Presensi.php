<?php
require "database.php";
// insert data into table
$sql = "INSERT INTO presensi (tgl_presensi, makul, kelas, nim, nama,) 
VALUES ('$tgl','$makul', '$kelas', '$nim', '$nama', '$statusPresensi' )";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
echo "<br>";
$conn->close();
// me-redirect ke file : read_data.php untuk menampilkan hasilnya
//header('Location: login.php');
?>

  
