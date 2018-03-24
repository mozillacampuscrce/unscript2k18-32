<?php
	include('config.php');
	session_start();
	include('logged.php');
  $error="";
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//user and pass sent from form
		$myname = mysqli_real_escape_string($db,$_POST['faculty']);
		$myuser = mysqli_real_escape_string($db,$_POST['username']);
		$mypass = mysqli_real_escape_string($db,$_POST['password']);
		
		$sql = "SELECT `Faculty` FROM `Faculty` WHERE `Username` = '$myuser'";
		$result = mysqli_query($db,$sql);
		
		//if doesn not exist, 0 rows
		if(mysqli_num_rows($result) == 0){
			$sql = "INSERT INTO `Faculty` VALUES ('$myname','$myuser','$mypass');";
			$result = mysqli_query($db,$sql);
			$_SESSION['login_faculty'] = $myname;
			$_SESSION['login_user'] = $myuser;
			header("location: welcome.php");
		}
		else
			$error = "Username already exists!";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h4 class="float">
  <a href="index.php">View Attendance</a>
   </h4>
  <h2>Faculty Register</h2>
  <form class="form-horizontal" method="post" action="" onSubmit="return passalert();">
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <h4 class="text-info">Already registered? <a href="facultylogin.php">Faculty Login</a></h4>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Name:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="faculty" placeholder="Enter name">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Username:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="username" placeholder="Enter username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Password:</label>
    <div class="col-sm-5"> 
      <input type="password" class="form-control" name="password" id="pass" placeholder="Enter password" onChange="checkpass();">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Confirm password:</label>
    <div class="col-sm-5"> 
      <input type="password" class="form-control" id="cpass" placeholder="Re-enter password" onChange="checkpass();">
    </div>
    <h4 class="text-danger text-left" id="err"></h4>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-primary">Register</button>
    </div>
  </div>
  <?php if($error!="")
  echo "
  		<div class=\"form-group\">
  			<div class=\"col-sm-7\">
  			<h4 class=\"text-danger text-center\">$error</h4>
   			</div>
		</div>";
   ?>
</form>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form contains errors!</h4>
      </div>
      <div class="modal-body">
        <p>Passwords do not match!</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<script>
function checkpass(){	
	var pass=document.getElementById("pass");
	var cpass=document.getElementById("cpass");
	var err=document.getElementById("err");
	if(pass.value!="" && cpass.value!=""){
		if(pass.value!=cpass.value){
			err.innerHTML="Passwords do not match!";
			return true;	
		}
		else{
			err.innerHTML="";
			return false;
		}
	}
	return false;
}
function passalert(){
	if(checkpass()){
		$("#myModal").modal();
		return false;
	}
	return true;
}
</script>
</body>
</html>
