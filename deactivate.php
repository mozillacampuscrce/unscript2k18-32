<?php
	include('config.php');
	session_start();
	
	$myuser = $_SESSION['login_user'];
	$fac = $_SESSION['login_faculty'];
	$sql = "DELETE FROM `Faculty` WHERE `Username` = '$myuser';";
	$sql = $sql."DELETE FROM `Subject_Faculty` WHERE `Faculty` = '$fac';";
	$result = mysqli_multi_query($db,$sql);
   if(session_destroy()) {
      header("Location: facultylogin.php");
   }
?>