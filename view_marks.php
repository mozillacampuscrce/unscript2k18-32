<?php
   include('config.php');
   session_start();
   $flag=0;
   $td = date('Y-m-d');
   if($_SERVER['REQUEST_METHOD'] == "POST"){
    $flag=1;
    $yr = mysqli_real_escape_string($db,$_POST['year']);
    $dv = mysqli_real_escape_string($db,$_POST['division']);
    $sub = mysqli_real_escape_string($db,$_POST['subject']);
    $dt = mysqli_real_escape_string($db,$_POST['date']);
    $typ = mysqli_real_escape_string($db,$_POST['type']);
    //get strength from table
    // echo($yr);
    // echo($dv);
    // echo($sub);
    // echo($dt);
    // echo($typ);
    // die();
    $sql = "SELECT * FROM `exam` WHERE `yr` = '$yr' and `dv` = '$dv' and `sub` = '$sub' and `dat` = '$dt' and `typ` = '$typ'";
    // die($sql);
    $result=mysqli_query($db,$sql);
    $row = mysqli_fetch_assoc($result);
    $exam = $row['id'];
    $sql = "SELECT * FROM `marks` WHERE `exam` = '$exam'";
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)!=0){
      
      $table="<div class=\"table-responsive\"><table id=\"tblCustomers\" class=\"table table-hover table-bordered\"><thead><tr><th>Roll No</th><th>Marks</th></thead><tbody>";
      while ($row = mysqli_fetch_assoc($result)){
        $table = $table."<tr><td>".$row['roll']."</td><td>".$row['marks']."</td></tr>";
      }
      $table = $table."</tbody>
        </table></div>";
    }
    else
      $table = "<h4 class=\"text-danger\">No records to display!</h4>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance and Marks Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="table2excel.js" type="text/javascript"></script>
  <script>
  function loadsub() {
    var selsub = document.getElementById("selsub");
    var yr = document.getElementById("yr").value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
            selsub.innerHTML = this.responseText;
    };
    xmlhttp.open("GET", "loadsub.php?yr=" + yr, true);
    xmlhttp.send();
  }
  </script>
</head>
<body>
<div class="container">
  <h4 class="float">
  <a href="marks.php">Enter Exam Marks</a>
  </h4>
  <h4><a href="index.php" class="btn btn-info" role="button">Back</a></h4>
  <h2>View Exam Marks</h2>
  <form class="form-horizontal" method="post" action="view_marks.php">
  <input type="hidden" name="action" value="attendance">
  <div class="form-group">
    <label class="control-label col-sm-2">Year:</label>
    <div class="col-sm-5">
      <select class="form-control" name="year" onchange="loadsub('')" id="yr">
        <option disabled selected>-- Select a Year --</option>
        <option>FE</option>
        <option>SE</option>
        <option>TE</option>
        <option>BE</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Division:</label>
    <div class="col-sm-5">
      <select class="form-control" name="division">
        <option>A</option>
        <option>B</option>
      </select> 
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Subject:</label>
    <div class="col-sm-5">
      <select class="form-control" name="subject" id="selsub">
        <?php
        if($flag && $subs!="") echo $subs;
        else echo "<option>-- Select Year to load Subjects --</option>";
        ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Date:</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" name="date" placeholder="Enter date" <?php echo "value=\"$td\""; ?> >
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label col-sm-2">Exam Type:</label>
    <div class="col-sm-5">
    <select class="form-control" name="type">
     <option>Term Test - 1</option>
     <option>Term Test - 2</option>
     <option>End Sem Exam</option>
    </select>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>

<?php
  if($flag) {
    echo <<<HTML

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" id="btnExport" class="col-sm-12 btn btn-success">Export Results</button>
    </div>
  </div>
  <br>
  <br>
  <br>
HTML;
    echo $table;
  }
?>
</div>


<script type="text/javascript">
    $(function () {
        $("#btnExport").click(function () {
            $("#tblCustomers").table2excel({
                filename: "Marks.xls"
            });
        });
    });
</script>

</body>
</html>

