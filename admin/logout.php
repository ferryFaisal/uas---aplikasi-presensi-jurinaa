<?php
  session_start();

  //  membatasi halaman sebelum login
  if (isset($_SESSION['role'])) {
    $_SESSION=[];
    unset ( $_SESSION);
    session_destroy();
      header("Location:login.php");
  }