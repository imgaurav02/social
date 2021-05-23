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


<link rel="stylesheet" href="style/home_style2.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Post</title>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <center><h2>Your Posts</h2></center>
        <?php user_posts(); ?>
    </div>
</div>

</body>
</html>



