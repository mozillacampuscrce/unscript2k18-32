<?php 
   include('session.php');
	if($_SERVER['REQUEST_METHOD'] == "POST"){
		$fac = $_SESSION['login_faculty'];
		$act = mysqli_real_escape_string($db,$_POST['action']);
		$sub = mysqli_real_escape_string($db,$_POST['subject']);
		$dv = mysqli_real_escape_string($db,$_POST['division']);
		if($act == "remove"){
			$sql = "DELETE FROM `Subject_Faculty` WHERE `Subject` = '$sub' and `Division` = '$dv' and `Faculty` = '$fac'";
		}
		else{
			$temp = $sub;
			$sub = substr($temp,5);
			$yr = str_replace(" - ".$sub, "", $temp);
			$sql = "INSERT INTO `Subject_Faculty` VALUES('$sub','$yr','$dv','$fac')";
		}
		$result = mysqli_query($db,$sql);
		
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
	<h2>Welcome <?php echo $_SESSION['login_faculty']; ?></h2>
	<h3>My Subjects</h3>
	<?php
		$sql = "SELECT * FROM `Subject_Faculty` WHERE `Faculty` = '".$_SESSION['login_faculty']."' ORDER BY FIELD(`Year`,'SE','TE','BE'), `Subject`";
		if ($result=mysqli_query($db,$sql)){
			echo "<table class=\"table table-hover table-bordered\">
				<thead><tr>
				<th>Subject</th> <th>Year</th> <th>Division</th> <th>Action</th>
				</tr></theah><tbody>";
			//No subjects
			if(mysqli_num_rows($result)==0){
				echo "<tr><td colspan=\"4\"><h4 class=\"text-danger\">No subjects to show!</h4></td></tr>";
			}
			else{
				//Display subjects
				while ($row=mysqli_fetch_assoc($result)){
					echo "<tr>
						<td>".$row['Subject']."</td>
						<td>".$row['Year']."</td>
						<td>".$row['Division']."</td> 
						<td>
						<form method=\"post\" action=\"attendance.php\">
					  		<input type=\"hidden\" name=\"subject\" value=\"".$row['Subject']."\">
					  		<input type=\"hidden\" name=\"year\" value=\"".$row['Year']."\">
					  		<input type=\"hidden\" name=\"division\" value=\"".$row['Division']."\">
					  		<input type=\"hidden\" name=\"action\" value=\"atform\">
				        	<button type=\"submit\" class=\"btn btn-primary\">Attendance</button>
							<button type=\"button\" class=\"btn btn-danger\" onclick=\"remModal('".$row['Subject']."','".$row['Year']."','".$row['Division']."')\">Remove Subject</button>
						</form>
						</td>
						</tr>";
				}
			}
			echo "</tbody><table>";
			//Free result set
			mysqli_free_result($result);
		}
	?>
	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#addCon">Add Subject</button>
	<h3><a href = "logout.php">Sign Out</a></h3>
    <h3><a href = "#deaCon" data-toggle="modal" >Deactivate</a></h3>
</div>
<!-- ModalRemove -->
<div id="remCon" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Confirm Action!</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to remove subject- '<span id="smod"></span> <span id="ymod"></span> <span id="dmod"></span>' from 'My Subjects'? This doesn't affect existing attendance records and you can add this subject again anytime.</p>
      </div>
      <div class="modal-footer">
		<form method="post" action="welcome.php">
	  		<input type="hidden" name="subject" value="" id="sub">
	  		<input type="hidden" name="division" value="" id="dv">
	  		<input type="hidden" name="action" value="remove">
        	<button type="submit" class="btn btn-success">Confirm</button>
		</form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
<!-- ModalAdd -->
<div id="addCon" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
	  <form method="post" action="welcome.php">
  	  <input type="hidden" name="action" value="add">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Select Subject to add to 'My Subjects'</h4>
      </div>
      <div class="modal-body">
      	<?php
		$sql = "SELECT * FROM `Subject` ORDER BY FIELD(`Year`,'SE','TE','BE'), `Subject`";
		if ($result=mysqli_query($db,$sql)){;
			//No subjects
			if(mysqli_num_rows($result)==0){
				echo "<h4 class=\"text-danger\">No subjects to show!</h4>";
			}
			else{
				//Display subjects
				echo "<div class=\"row\"><div class=\"form-group col-xs-8\"><label>Year - Subject:</label><select class=\"form-control\" name=\"subject\">";
				while ($row=mysqli_fetch_assoc($result)){
					echo "<option>".$row['Year']." - ".$row['Subject']."</option>";
				}
				echo "</select></div>
					<div class=\"form-group col-xs-4\"><label>Division:</label><select class=\"form-control\" name=\"division\">
					<option>A</option><option>B</option>
					</select></div></div>";
			}
			//Free result set
			mysqli_free_result($result);
		}
	?>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Add</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
      </form>
    </div>

  </div>
</div>
<!-- ModalDeactivate -->
<div id="deaCon" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Please Confirm Action!</h4>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to deactivate your Faculty account? This cannot be undone!</p>
      </div>
      <div class="modal-footer">
		<form method="post" action="deactivate.php">
        	<button type="submit" class="btn btn-success">Confirm</button>
		</form>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>
<script>
	function remModal(subj,yr,dv){
		document.getElementById("sub").value=subj;
		document.getElementById("dv").value=dv;
		document.getElementById("smod").innerHTML=subj;
		document.getElementById("ymod").innerHTML=yr;
		document.getElementById("dmod").innerHTML=dv;
		$("#remCon").modal();
		//alert(document.getElementById("sub").value);
	}
</script>
</body>
</html>