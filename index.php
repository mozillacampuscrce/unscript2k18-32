<?php
   include('config.php');
   session_start();
   $flag=0;
   $td = date('Y-m-d');

   $cat1 = 0;
   $cat2 = 0;
   $cat3 = 0;

   if($_SERVER['REQUEST_METHOD'] == "POST"){
    $flag=1;
    $yr = mysqli_real_escape_string($db,$_POST['year']);
    $dv = mysqli_real_escape_string($db,$_POST['division']);
    $sub = mysqli_real_escape_string($db,$_POST['subject']);
    $fromd = mysqli_real_escape_string($db,$_POST['fromd']);
    $tod = mysqli_real_escape_string($db,$_POST['tod']);
    $subs= $_SESSION['subs'];
    $subs = str_replace('>'.$sub, ' selected>'.$sub, $subs);
    //get strength from table
    $sql = "SELECT `Strength` FROM `Strength` WHERE  `Year` = '$yr' and `Division` = '$dv';";
      if($result=mysqli_query($db,$sql)){
        $row=mysqli_fetch_assoc($result);
        $strength = $row['Strength'];
        $sql = "SELECT * FROM `$yr"."_$dv` WHERE `Subject` = '$sub' and `Date` BETWEEN '$fromd' and '$tod'";
        if($result=mysqli_query($db,$sql)){
          $restable = array();
          while ($row = mysqli_fetch_assoc($result))
            $restable[] = $row;
          if(mysqli_num_rows($result)!=0){
            $table="<div class=\"table-responsive\"><table id=\"tblCustomers\" class=\"table table-hover table-bordered\"><thead><tr><th>Roll No</th>";
            for($i=0;$i<mysqli_num_rows($result);$i++){
                $d = $restable[$i]['Date'];
                $d = date_format(date_create($d),"d-m-Y");
                $table = $table."<th>$d</th>";
              }
            $table=$table."<th>Attendance Percentage</th></tr></thead><tbody>";
            for($j=1;$j<=$strength;$j++){
              $table = $table."<tr><td>".($j)."</td>";
              $pr=0;
              $tot=mysqli_num_rows($result);
              for($i=0;$i<$tot;$i++){
                if($restable[$i][$j]){
                  $pre="P";
                  $pr++;
                }
                else {
                  $pre="A";
                }
                $table = $table."<td>$pre</td>";
              }
              $perc = $pr*100/$tot;
              if($perc<33) $cat1++;
              elseif($perc<66) $cat2++;
              else $cat3++;
              $table = $table."<td>".$perc."%</td></tr>";
            }
            $table = $table."</tbody>
              </table></div>";
          }
          else
            $table = "<h4 class=\"text-danger\">No records to display!</h4>";
        }
      }
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
  <link rel="stylesheet" href="bargraph.css">
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
  <?php
    if(isset($_SESSION['login_faculty']))
      echo $_SESSION['login_faculty'].":&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"welcome.php\">Manage</a>";
    else
      echo "Faculty:&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"facultylogin.php\">Login</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"facultyregister.php\">Register</a>";
  ?>
  <a href="marks.php">Exam Marks</a>
  </h4>
  <h2>View Attendance</h2>


  <form class="form-horizontal" method="post" action="index.php">
  <div class="form-group">
    <label class="control-label col-sm-2">Year:</label>
    <div class="col-sm-5">
      <select class="form-control" name="year" onchange="loadsub('')" id="yr">
      <?php if(!$flag) echo "<option disabled selected>-- Select a Year --</option>"; ?>
      <?php 
        echo "<option>FE</option><option ";if($flag && $yr=="SE") echo "selected";
        echo ">SE</option><option ";if($flag && $yr=="TE") echo "selected";
        echo ">TE</option><option ";if($flag && $yr=="BE") echo "selected";
        echo ">BE</option> ";
      ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Division:</label>
    <div class="col-sm-5">
      <select class="form-control" name="division">
      <?php 
        echo "<option ";if($flag && $dv=="A") echo "selected";
        echo ">A</option><option ";if($flag && $dv=="B") echo "selected";
        echo ">B</option> ";
      ?>
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
    <label class="control-label col-sm-2">From:</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" name="fromd"" placeholder="Enter from date"
      <?php if($flag) echo "value=\"$fromd\""; else echo "value=\"$td\""; ?> >
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">To:</label>
    <div class="col-sm-5">
      <input type="date" class="form-control" name="tod"" placeholder="Enter to date"
      <?php if($flag) echo "value=\"$tod\""; else echo "value=\"$td\""; ?> >
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

    $totc = $cat1 +$cat2 +$cat3;
    $cat1 = floor($cat1*100/$totc);
    $cat2 = floor($cat2*100/$totc);
    $cat3 = floor($cat3*100/$totc);

    echo <<<HTML

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-5">
      <button type="submit" id="btnExport" class="col-sm-12 btn btn-success">Export Results</button>
    </div>
    <div class="col-sm-offset-2 col-sm-5">
      <button class="col-sm-12 btn btn-success" data-cat1 = "{$cat1}" data-cat2 = "{$cat2}" data-cat3 = "{$cat3}" onclick="window.open('http://localhost/cmpnportal/unscript2k18-32/bargraph.php?cat1={$cat1}&cat2={$cat2}&cat3={$cat3}');">Attendance Analysis</button>
    </div>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
HTML;


    echo <<<HTML


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
                filename: "Attendance.xls"
            });
        });
    });
</script>

  <script src="bargraph.js" type="text/javascript"></script>


</body>
</html>

