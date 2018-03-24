<?php
  include('session.php');
	if($_SERVER['REQUEST_METHOD'] != "POST")
    header('location:welcome.php');
  else{
    $action = mysqli_real_escape_string($db,$_POST['action']);
    $faculty = $_SESSION['login_faculty'];
    $subject = mysqli_real_escape_string($db,$_POST['subject']);
    $year = mysqli_real_escape_string($db,$_POST['year']);
    $division = mysqli_real_escape_string($db,$_POST['division']);
    if($action == "atform"){
  		//subject details sent from form
      date_default_timezone_set('Asia/Kolkata');
      $date = date('Y-m-d');
      $time = date('H:i');
      $class = $year.'_'.$division;
      $_SESSION['class']=$class;
      $sql = "SELECT `Strength` FROM `Strength` WHERE  `Year` = '$year' and `Division` = '$division';";
      if($result=mysqli_query($db,$sql)){
        $row=mysqli_fetch_assoc($result);
        //get strength from table
        $strength = $row['Strength'];
        $_SESSION['strength'] = $strength;
      }
    }
    else{
      $topics = mysqli_real_escape_string($db,$_POST['topics']);
      $date = mysqli_real_escape_string($db,$_POST['date']);
      $time = mysqli_real_escape_string($db,$_POST['time']);
      $type = mysqli_real_escape_string($db,$_POST['type']);
      $rno = mysqli_real_escape_string($db,$_POST['rno']);
      $strength = $_SESSION['strength'];
      //attendance array
      $att=array_fill(0,$strength,1);
      //rollnumber array from form
      $noarray = preg_replace_callback('/(\d+)-(\d+)/', 
        function($m) {
          return implode(',', range($m[1], $m[2]));
        }, $rno);
      $noarray = explode(',', $noarray);
      foreach (range(1, $strength) as $no) {
        //in absent list
        if(in_array($no, $noarray) && $type=="Absent Roll Numbers")
          $att[$no -1]=0;
        //not in present list
        else if(!in_array($no, $noarray) && $type=="Present Roll Numbers")
          $att[$no -1]=0;
      }
      $class = $_SESSION['class'];
      $sql = "INSERT INTO `".$class."` VALUES ('$faculty','$subject','$topics','$date','$time'";
      for($i = 1; $i<=$strength;$i++)
        $sql = $sql.", ".$att[$i -1];
      $sql = $sql.")";
      if($result=mysqli_query($db,$sql))
        header('location:welcome.php');
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h4><a href="welcome.php" class="btn btn-info" role="button">Back</a></h4>
  <h2>Subject Attendance</h2>
  <form class="form-horizontal" method="post" action="attendance.php">
  <input type="hidden" name="action" value="attendance">
  <div class="form-group">
    <label class="control-label col-sm-2">Faculty:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="faculty" value="<?php echo $faculty ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Subject:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="subject" value="<?php echo $subject ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Year:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="year" value="<?php echo $year ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Division:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="division" value="<?php echo $division ?>" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Topics covered:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="topics" value="" placeholder="Enter topics covered during lecture">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Date:</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" name="date" value="<?php echo $date ?>" placeholder="Enter date">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Time:</label>
    <div class="col-sm-5">
      <input type="time" class="form-control" name="time" value="<?php echo $time ?>" placeholder="Enter time">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Type:</label>
    <div class="col-sm-5">
    <select class="form-control" name="type">
     <option>Absent Roll Numbers</option><option>Present Roll Numbers</option>
    </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Roll Numbers:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="rno" value="" placeholder="Enter roll numbers"><p class="help-block">Enter comma separated range or individaul numbers. eg. 12,23-26,45</p><h4 class="text-info">(Class Strength is <?php echo $_SESSION['strength']; ?>)</h4>
    </div>
    
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
</div>
</body>
</html>
