<?php
	include('config.php');
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "GET"){
		$yr = mysqli_real_escape_string($db,$_GET['yr']);
		$sql = "SELECT `Subject` FROM `Subject` WHERE `Year` = '$yr'";
		if($result = mysqli_query($db,$sql)){
			$subs="";
			while ($row=mysqli_fetch_assoc($result))
				$subs=$subs."<option>".$row['Subject']."</option>";
			$_SESSION['subs']=$subs;
			echo $subs;
		}
		
	}
?>