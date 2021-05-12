<?php
    include("includes/connection.php");

    if(isset($_POST['signup'])){
        $first_name = htmlentities(mysqli_real_escape_string($con,$_POST['first_name']));
        $last_name = htmlentities(mysqli_real_escape_string($con,$_POST['last_name']));
        $u_email = htmlentities(mysqli_real_escape_string($con,$_POST['u_email']));
        $u_country = htmlentities(mysqli_real_escape_string($con,$_POST['u_country']));
        $gender = htmlentities(mysqli_real_escape_string($con,$_POST['gender']));
        $u_birthday = htmlentities(mysqli_real_escape_string($con,$_POST['u_birthday']));
        $u_pass = htmlentities(mysqli_real_escape_string($con,$_POST['u_pass']));
        $status = "verified";
        $posts ="no";
        $newgid = sprintf('%05d',rand(0,999999));

        $username = strtolower($first_name . "_" . $last_name . "_" . $newgid);
        $check_username_query = "select user_name from users where user_email='$u_email'";
        $run_username = mysqli_query($con,$check_username_query);

        if(strlen($u_pass)<9){
            echo"<script> alert('Password should be atleast 9 character')</script>";
            exit();
        }

        $check_email = "select * from users where user_email='$u_email'";
        $run_email = mysqli_query($con,$check_email);
        $check = mysqli_num_rows($run_email);
    
        if($check == 1){
            echo"<script> alert('Email Already Exists')</script>";
            echo"<script> window.open('signup.php','_self')</script>";
            exit();
        }

        $rand = rand(1,3);

            if($rand == 1)
                $profile_pic = "1.png";
            else if($rand == 2)
                $profile_pic = "2.png";
            else if($rand == 3)
                $profile_pic = "3.png";

        $insert = "insert into users(f_name,l_name,user_name,describe_user,Relationship,user_pass,user_email,user_country,user_gender,user_birthday,user_image,user_cover,user_reg_date,status,posts,recovery_account) values('$first_name','$last_name','$username','Hello I M Using Gaurav Social Media','...','$u_pass','$u_email','$u_country','$gender','$u_birthday','$profile_pic','default_cover.jpg',NOW(),'$status','$posts','Hellogaurav')";
        $query = mysqli_query($con,$insert);
        if($query){
            echo"<script> alert('Signup successfully done $first_name')</script>";
            echo"<script> window.open('login.php','_self')</script>";
        }
        else{
            echo"<script> alert('Error')</script>";
            echo"<script> window.open('signup.php','_self')</script>";
        }
    }

    
?>