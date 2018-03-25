<?php
include('config.php');
for ($i=1; $i <=90 ; $i++) { 
	if($i%2==0){
	$marks = 18;
	$sql = "insert into marks values(1,".$i.",".$marks.")";
	}
	elseif($i%3==0){
	$marks = 17;
	$sql = "insert into marks values(1,".$i.",".$marks.")";
	}
	elseif($i%5==0){
	$marks = 20;
	$sql = "insert into marks values(1,".$i.",".$marks.")";
	}
	else{
	$marks = 19;
	$sql = "insert into marks values(1,".$i.",".$marks.")";
	}
	$result=mysqli_query($db,$sql);
}
?>