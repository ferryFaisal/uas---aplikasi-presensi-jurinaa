
<?php

// require "connect_db.php";
//                 $sql= "SELECT * FROM user WHERE email='$_GET[email]'";
//                 $result = $conn->query($sql);
                
            $nameErr = $emailErr = $passErr =  $roleErr = "";
            $name = $email = $pass =$role = "";
            
            $attrAdmin=$attrAuthor=$attrEditor="";
            require "database.php";
            // $email= $_GET['email'];
            $sql= "SELECT * FROM user WHERE email='$_GET[email]'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0){
                while($row=$result->fetch_assoc()){
               
            switch ($row['role']){
                case "Dosen":
                    $attrDosen = "selected";
                    break;
                case "Admin":
                    $attrAdmin= "selected";
                    break;
                default:
                $attrDosen=$attrAdmin="";
             }
        //  }
        // }
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
            <title>update</title>
        </head>
        <style>
                    .error {color: #F00210f1;}
                    </style>
        <body class="bg-color">
    <section class="container mt-5">
        <div class="row justify-content-md-center">
            <form class="col-md-6 col-sm-12 bg-white p-5 rounded shadow" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="col-12 text-center">
                    <h3 class="text-primary"><strong>UPDATE FORM</strong></h3>
                </div>
            
                <!-- alert untuk success -->
                <!-- <?php if(isset($success)) : ?>
                <?php endif; ?>
                alert untuk error
                <?php if(isset($error)) : ?>
                <?php endif; ?> -->
                
                <p><span class="error">* required field</span></p>

                <div class="mb-3">
                <label for="name">Name *</label>
                <input class="form-control" type="text" name="name" value="<?= $row['name'];?>">
                <span class="error">* <?php echo $nameErr;?></span>
                </div>
                <div class="mb-3">
                <label for="email">Email *</label>
                <input class="form-control" type="text" name="email" value="<?= $row['email'];?>" readonly>
                <span class="error">* <?php echo $emailErr;?></span>
                </div>
                <div class="mb-3">
                <label for="password">Password *</label>
                <input class="form-control" type="password" name="pass" value="<?= $row['password'];?>">
                <span class="error">*<?php echo $passErr;?></span>
                </div>
                <div class="mb-3">
                <label for="role">Role</label>
                <select name="role"  id="role" class="form-control">
                <option value="">--PILIH USER--</option>
                        <option value="Dosen" <?php echo $attrAdmin;?> >Dosen</option>
                        <option value="Admin" <?php echo $attrAuthor;?>>Admin</option>
                      </select>
                <span class="error">* <?php echo $roleErr;?></span>
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
          $valName = $valEmail = $valPass= $valRole = false;
          if(isset($_POST['submit'])){
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                //echo "tesname".$_POST['name'];                echo "tesmail".$_POST['email'];

              if(empty($_POST["name"])) {
                  $nameErr = "Name is required";
              } else {
                  $name = sanitize($_POST["name"]);
                  // if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
                  //     $nameErr = "Only letters and white space allowed";
                  // }else{
                      // $valName = true;
                  // }
                  $valName = true;
              }
              if(empty($_POST["email"])) {
                  $emailErr = "Email is required";
              } else {
                  $email = sanitize($_POST["email"]);
                  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                      $emailErr = "Invalid email format";
                  }else{
                //read data email from table user
                require "database.php";
                        $sql = "SELECT email FROM user";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                if ($row["email"] == $email) {
                                    $emailErr = "Email already exist!";
                                    break;
                                }else {
                                    $valEmail = true;
                                }
                            }
                        } else {
                            echo "0 results";
                        }
                       
                     }
                   
          }
        
              if(empty($_POST["pass"])){
                  $passErr = "Password is require";
              }else{
                  $pass = sanitize($_POST["pass"]);
                  // if(!preg_match("/^(?=.\d)(?=.[a-z])(?=.*[A-Z]).{8,}/",$pass)) {
                  //     $passErr = "Invalid password format";
                  // }
                  $valPass = true;
              } 

              
              if(empty($_POST["role"])){
                  $roleErr = "Role is required";
              }else{
                  $role = sanitize($_POST["role"]);
                  $valRole = true;
              }
              if ($valName&& $valPass && $valRole == true ){
                    
                $pass = sha1($pass);
                //$pass = md5($_POST['password']);
                $modified = date("Y-m-d");
                $sql2= "UPDATE user SET name='$name',password='$pass',role='$role', date_modified='$modified' WHERE email='$_POST[email]'";
                if ($conn->query($sql2)=== TRUE){
                    header("location: tables_user.php");
                } else {
                    //pesan error gagal update data
                    echo "Data Gagal Diupate!".$conn->error;
                }
      $conn->close();
      }
          }
        }
          
                
        
           ?>
               
  