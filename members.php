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
    <title>Find People</title>
</head>
<body>
<div class="row">
    <div class="col-sm-12">
        <center><h2>Find People</h2></center><br><br>
        <div class="row " >
            <div class="col-sm-4"></div>
            <div class="col-sm-4 ">
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text"  name="search_user" placeholder="Search Friend" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="search_user_btn">Search</button>
            </form>
            </div>
            <div class="col-sm-4"></div>
        </div><br><br>
        <?php search_user(); ?>
    </div>
</div>
</body>
</html>



