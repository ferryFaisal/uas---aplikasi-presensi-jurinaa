<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Login</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">
    <style>
      .error {color: #FF0000;}
    </style>
</head>

<body class="bg-dark">
<?php
  session_start();

  //  membatasi halaman sebelum login
  if (isset($_SESSION['role'])) {
      // header("Location:index.php");
  }
  
   $emailErr = $passErr= "";
   $valid_email = $valid_password = false;
   $pass = $email = "";
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'database.php';
    $pass = cek($_POST['password']);
    $email = cek($_POST['inputEmail']);
    echo "pass$pass: $pass, email: $email<br>";
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    // output data of each row
    if ($result->num_rows > 0) {
      echo "name ".$row['name'].",<br> email: ".$row['email'].",<br> pass$pass: ".$row['password'].",<br> role: ".$row['role'];
      if ($pass == $row['password']){
        $name = $row['name'];
        $role = $row['role'];
        session_start();
        $_SESSION['role'] = $role;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $name;
        //menuju ke halaman pemeriksaan session
        header('Location: index.php');
        echo '<script>alert("nama akun:'.$_SESSION['name'].'")</script>';
        die;
      } else{
        echo '<script>alert("Login Gagal")</script>';
        die;
      }
    } else {
      echo '<script>alert("Email belum terdaftar")</script>';
      die;
    }
  }
  function cek($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  ?>
    <div class="container">
      <div class="card card-login mx-auto mt-5">
        <div class="card-header">Login</div>
        <div class="card-body">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <div class="form-label-group">
                <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
                <label for="inputEmail">Email address</label>
              </div>
            </div>
            <div class="form-group">
              <div class="form-label-group">
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
                <label for="inputPassword">Password</label>
              </div>
            </div>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" value="remember-me">
                  Remember Password
                </label>
              </div>
            </div>
            <!-- <a class="btn btn-primary btn-block" href="index.php">Login</a> -->
            <input type="submit" class="btn btn-primary btn-block" name="submit" value="Login">  
          </form>
          <div class="text-center">
            <a class="d-block small mt-3" href="register.php">Register an Account</a>
            <a class="d-block small" href="forgot.php">Forgot Password?</a>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  
  </body>
  
  </html>