<?php
include("functions/functions.php");
session_start();

if(isset($_SERVER['HTTP_REFERER'])){

    $return_to = $_SERVER['HTTP_REFERER'];
}
else{

    $return_to = "home.php";
}

    if(isset($_GET['id'])){
        like_post($_GET['id'],$_SESSION['user_email']);
    }

header("Location: ".$return_to);


?>