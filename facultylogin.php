<?php
	include('config.php');
	session_start();
  include('logged.php');
  $error="";
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		//user and pass sent from form
		$myuser = mysqli_real_escape_string($db,$_POST['username']);
		$mypass = mysqli_real_escape_string($db,$_POST['password']);
		
		$sql = "SELECT `Faculty` FROM `Faculty` WHERE `Username` = '$myuser' and `Password` = '$mypass'";
		$result = mysqli_query($db,$sql);
		
		//if correct, 1 row
		if(mysqli_num_rows($result) == 1){
			$row = mysqli_fetch_assoc($result);
			$_SESSION['login_faculty'] = $row["Faculty"];
			$_SESSION['login_user'] = $myuser;
			header("location: welcome.php");
		}
		else
			$error = "Invalid Username or Password";
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance and Marks Management</title>
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
  <h2>Faculty Login</h2>
  <form class="form-horizontal" method="post" action="">
  <div class="form-group">
    <label class="control-label col-sm-2">Username:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="username" placeholder="Enter username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Password:</label>
    <div class="col-sm-5"> 
      <input type="password" class="form-control" name="password" placeholder="Enter password">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-primary">Login</button>
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
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <a href="facultyregister.php"><h4 class="text-info">Faculty Register</h4></a>
    </div>
  </div>
</form>
</div>
</body>
</html>