<?php
	include('config.php');
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//sql sent from form
		$sql="CREATE TABLE `Faculty` (`Faculty` VARCHAR(63) NOT NULL, `Username` VARCHAR(63) NOT NULL, `Password` VARCHAR(63) NOT NULL, PRIMARY KEY(`Username`) );";
		$result = mysqli_multi_query($db, $sql) or trigger_error(mysqli_error($db), E_USER_ERROR);
		if ($result) echo "Success";
	}
	mysqli_close($db);
?>