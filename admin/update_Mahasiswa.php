
<?php

            $namaErr= $nimErr= $kelasErr= ""; 
            $nama= $nim= $kelas= ""; 
            // $valid_nama= $valid_nim= $valid_kelas=false; 
            $sql= "SELECT * FROM mahasiswa WHERE nim='$_GET[nim]'";
                                  
            $attr5A=$attr5B="";
            require "database.php";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                while($row=$result->fetch_assoc()){
           

            switch ($row['kelas']){
                case "5A":
                    $attr5A = "selected";
                    break;
                case "5B":
                    $attr5B= "selected";
                    break;
                default:
                $attr5A=$attr5B="";
             }
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
           
            <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
            <link rel="stylesheet" href="style.css">
            <title>update Data Mahasiswa</title>
        </head>
        <style>
                    .error {color: #F00210f1;}
                    </style>
        <body class="bg-color">
    <section class="container mt-5">
        <div class="row justify-content-md-center">
            <form class="col-md-6 col-sm-12 bg-white p-5 rounded shadow" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="col-12 text-center">
                    <h3 class="text-primary"><strong>UPDATE DATA MAHASISWA</strong></h3>
                </div>
    
                <!-- <p><span class="error">* required field</span></p> -->
               
                <div class="mb-3">
                <label for="email">NIM*</label>
                <input class="form-control" type="text" name="nim" value="<?= $row['nim'];?>" readonly>
                <span class="error">* <?php echo $nimErr;?></span>
                </div>
                <div class="mb-3">
                <label for="name">Nama*</label>
                <input class="form-control" type="text" name="nama" value="<?= $row['nama'];?>">
                <span class="error">* <?php echo $namaErr;?></span>
                </div>
                <div class="mb-3">
                <label for="kelas">Kelas</label>
                <select name="kelas"  id="kelas" class="form-control">
                <option value="">--PILIH KELAS--</option>
                        <option value="5A" <?php echo $attr5A;?> >5A</option>
                        <option value="5B" <?php echo $attr5B;?>>5B</option>
                      </select>
                <span class="error">* <?php echo $kelasErr;?></span>
                </div>
 
           <?php
                }
            }else{
                echo "0 results";
            }
            ?>
           <div class="text-center mt-3">
                    <button type="submit"  name="submit" class="btn btn-primary btn-rounded w-75">Update Now</button>
                </div>
                <div class="mb-3 text-center text-secondary mt-3">
                
                </div>
                </form>
      
        </div>
    </section> 
    <!-- <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
<?php
function sanitize($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
              return $data;
          }
          $valNama = $valNim= $valKelas= false;
          if(isset($_POST['submit'])){
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //echo "tesname".$_POST['name'];                echo "tesmail".$_POST['email'];

              if(empty($_POST["nama"])) {
                  $namaErr = "Nama is required";
              } else {
                  $nama = sanitize($_POST["nama"]);
                  // if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                  //     $nameErr = "Only letters and white space allowed";
                  // }else{
                      // $valName = true;
                  // }
                  $valNama= true;
              }
              $nim = sanitize($_POST["nim"]);

    
              
              if(empty($_POST["kelas"])){
                  $kelasErr = "kelas is required";
              }else{
                  $kelas = sanitize($_POST["kelas"]);
                  $valKelas = true;
              }
              if ($valNama && $valKelas == true ){
                    
                // $modified = date("Y-m-d");
                $sql2= "UPDATE mahasiswa SET nama='$nama',nim='$nim',kelas='$kelas' WHERE nim='$_POST[nim]'";
                if ($conn->query($sql2)=== TRUE){
                    header("location: tables_mahasiswa.php");
                    // echo "<script> window.location.href='tables_mahasiswa.php';</script>";
                } else {
                    //pesan error gagal update data
                    echo "Data Gagal Diupate!".$conn->error;
                
                }
            $conn->close();
            }
                }
                }
           ?>
               
  