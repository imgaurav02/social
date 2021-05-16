<?php
    session_start();
    include("includes/header.php");
    include("functions/functions.php");
    if(!isset($_SESSION['user_email'])){
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Post</title>
</head>
<body>
  <div class="row">
      <div class="col-sm-12">
          <center><h2>Comments</h2><br></center>
          <?php single_post(); ?>
      </div>
  </div>  
</body>
</html>