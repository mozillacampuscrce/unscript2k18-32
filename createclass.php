<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Enter Class Strengths</h2>
  <form class="form-horizontal" action="class.php" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2">SE A:</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="sea">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">SE B:</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="seb">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">TE A:</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="tea">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">TE B:</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="teb">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">BE A:</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="bea">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">BE B:</label>
    <div class="col-sm-2">
      <input type="number" class="form-control" name="beb">
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-2">
      <button type="submit" class="btn btn-default">Submit</button>
    </div>
  </div>
</form>
</div>

</body>
</html>
