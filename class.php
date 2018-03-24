<?php
	include('config.php');
	session_start();
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//sql sent from form
		$sea = mysqli_real_escape_string($db,$_POST['sea']);
		$seb = mysqli_real_escape_string($db,$_POST['seb']);
		$tea = mysqli_real_escape_string($db,$_POST['tea']);
		$teb = mysqli_real_escape_string($db,$_POST['teb']);
		$bea = mysqli_real_escape_string($db,$_POST['bea']);
		$beb = mysqli_real_escape_string($db,$_POST['beb']);
		$strength = array($sea, $seb, $tea, $teb, $bea, $beb);
		$classes = array("SE_A", "SE_B", "TE_A", "TE_B", "BE_A", "BE_B");
		$sql="CREATE TABLE `Strength`(`Year` VARCHAR(2) NOT NULL, `Division` VARCHAR(1) NOT NULL, 
			`Strength` TINYINT(3) NOT NULL, PRIMARY KEY(`Year`, `Division`));
			INSERT INTO `Strength` VALUES(\"SE\",\"A\",".$sea.");
			INSERT INTO `Strength` VALUES(\"SE\",\"B\",".$seb.");
			INSERT INTO `Strength` VALUES(\"TE\",\"A\",".$tea.");
			INSERT INTO `Strength` VALUES(\"TE\",\"B\",".$teb.");
			INSERT INTO `Strength` VALUES(\"BE\",\"A\",".$bea.");
			INSERT INTO `Strength` VALUES(\"BE\",\"B\",".$beb.");
			";
		for($j=0;$j<6;$j++){
			$sql=$sql."CREATE TABLE `".$classes[$j]."`(
				`Faculty` VARCHAR(63) NOT NULL, 
				`Subject` VARCHAR(63) NOT NULL, 
				`Topics` VARCHAR(127) NOT NULL, 
				`Date` DATE NOT NULL, 
				`Time` TIME NOT NULL, ";
			for($i=1;$i<=$strength[$j];$i++)
				$sql=$sql."`".$i."`"." BIT(1) NOT NULL DEFAULT 1, ";
			$sql=$sql."PRIMARY KEY (`Date`,`Time`) );";
		}
		$result = mysqli_multi_query($db, $sql) or trigger_error(mysqli_error($db), E_USER_ERROR);
		if ($result) echo "Success";
	}
	mysqli_close($db);
?>