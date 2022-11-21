<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <title>Form Mahasiswa</title>
</head>
<style>
 .error {color: #F00210f1;}
 .bg-color{
	background-color: #3586d6;
	font-family: Arial, Helvetica, sans-serif;
}
.btn-rounded{
	border-radius: 30px;
}
 </style>
<body class="bg-color">
<section class="container mt-5">
<?php
$namaErr= $nimErr= $kelasErr= ""; 
$nama= $nim= $kelas= ""; 
$valid_nama= $valid_nim= $valid_kelas=false; 
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(empty($_POST["nama"])) {
        $namaErr = "Nama is required";
    } else {
        $nama = sanitize($_POST["nama"]);
        // if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        //     $nameErr = "Only letters and white space allowed";
        // }else{
            // $valName = true;
        // }
        $valid_nama = true;
    }
    if(empty($_POST["nim"])) {
        $nimErr = "NIM is required";
    } else {
        $nim = sanitize($_POST["nim"]);
        $valid_nim= true;
    }
    if(empty($_POST["kelas"])) {
        $kelasErr = " Class is required";
    } else {
        $kelas = sanitize($_POST["kelas"]);
        // if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        //     $priceErr = "Only Number";
        // }else{
        //     $valid_price = true;
        // }
        $valid_kelas = true;
    }
    

}
function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<div class="row justify-content-md-center">
            <form class="col-md-6 col-sm-12 bg-white p-5 rounded shadow" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="col-12 text-center">
                    <h3 class="text-primary"><strong>Input Mahasiswa</strong></h3>
                    </div>
                    <?php if(isset($success)) : ?>
                    <?php endif; ?>
                    <?php if(isset($error)) : ?>
                    <?php endif; ?>
                    <p><span class="error">* required field</span></p>
                    <div class="mb-3">
                    <label for="name">NIM*</label>
                    <input class="form-control" type="text" name="nim" value="<?php echo $nim;?>">
                    <span class="error">* <?php echo $nimErr;?></span>
                    </div>
                    <div class="mb-3">
                    <label for="id">Nama*</label>
                    <input class="form-control" type="text" name="nama" value="<?php echo $nama;?>">
                    <span class="error">* <?php echo $namaErr;?></span>
                    </div>
                    <div class="mb-3">
                    <label for="name">Kelas*</label>
                    <select name="kelas"  class="form-control">
                    <option value="">--PILIH KELAS--</option>
                    <option value="5A">5A</option>
                    <option value="5B">5B</option>
                    </select>
                    <span class="error">* <?php echo $kelasErr;?></span>
                    </div>
                    <div class="text-center mt-3">
                    <button type="submit" class="btn btn-primary btn-rounded w-75">Input Now</button>
                </div>
                    </form>
</div>
</section>

<?php
if ($valid_nama && $valid_nim && $valid_kelas == true ){
    echo "<h2>Your Input:</h2>";
    echo $nama;
    echo "<br>";
    echo $nim;
    echo "<br>";
    echo $kelas;
    echo "<br>";
   
    include "insert_Mahasiswa.php";
   
}
?>
</body>
</html>