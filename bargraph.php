<?php
$cat1 = $_GET['cat1'];
$cat2 = $_GET['cat2'];
$cat3 = $_GET['cat3'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Attendance and Marks Management</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bargraph.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<?php 
echo <<<HTML
<div class="container vertical rounded">
  <h2>Attendance Analysis</h2>
  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>$cat1%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>$cat2%</span>
      </div>
    </div>
  </div>

  <div class="progress-bar">
    <div class="progress-track">
      <div class="progress-fill">
        <span>$cat3%</span>
      </div>
    </div>
  </div>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<b>
  &nbsp;Cat 1 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Cat 2 &nbsp;&nbsp;&nbsp;&nbsp;    Cat 3 </b>
<br>
<br>
<br>

HTML;
?>

</div>

  <script src="bargraph.js" type="text/javascript"></script>


</body>
</html>