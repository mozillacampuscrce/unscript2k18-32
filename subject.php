<?php
	include('config.php');
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//sql sent from form
		$sesub = array("OOPM","DS","AOA","TCS");
		$tesub = array("OS","CN","SE","MCC");
		$besub = array("CSS","AI","HMI","CC");
		$sql="CREATE TABLE `Subject` (`Subject` VARCHAR(63) NOT NULL, `Year` VARCHAR(2) NOT NULL, PRIMARY KEY(`Subject`) );";
		for($i=0;$i<sizeof($sesub);$i++)
			$sql=$sql."INSERT INTO `Subject` VALUES(\"".$sesub[$i]."\",\"SE\");";
		for($i=0;$i<sizeof($tesub);$i++)
			$sql=$sql."INSERT INTO `Subject` VALUES(\"".$tesub[$i]."\",\"TE\");";
		for($i=0;$i<sizeof($besub);$i++)
			$sql=$sql."INSERT INTO `Subject` VALUES(\"".$besub[$i]."\",\"BE\");";
		$sql=$sql."CREATE TABLE `Subject_Faculty` (`Subject` VARCHAR(63) NOT NULL, `Year` VARCHAR(2) NOT NULL,`Division` VARCHAR(1) NOT NULL, `Faculty`VARCHAR(63) NOT NULL, PRIMARY KEY(`Subject`, `Division`,`Faculty`) );";
		$result = mysqli_multi_query($db, $sql) or trigger_error(mysqli_error($db), E_USER_ERROR);
		if ($result) echo "Success";
	}
	mysqli_close($db);
?>