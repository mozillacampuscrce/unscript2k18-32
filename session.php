<?php
   include('config.php');
   session_start();
   
   if(!isset($_SESSION['login_faculty']))
      header("location:facultylogin.php");
?>