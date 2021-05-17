

<?php
session_start();
include("includes/header.php");

if (!isset($_SESSION['user_email'])) {
    header("location: index.php");
}

$user = $_SESSION['user_email'];
$get_user = "select * from users where user_email='$user'";
$run_user = mysqli_query($con, $get_user);
$row = mysqli_fetch_array($run_user);

$user_name = $row['user_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <style>
        #cover-img {
            height: 400px;
            width: 100%;
        }

        #profile-img {
            position: absolute;
            top: 160px;
            left: 40px;
        }

        #update_profile {
            position: relative;
            top: -36px;
            cursor: pointer;
            left: 93px;
            border-radius: 4px;
            background-color: rgba(0, 0, 0, 0.5);
            transform: translate(-50%, -50%);
        }

        #button_profile {
            position: absolute;
            top: 82%;
            left: 50%;
            cursor: pointer;
            transform: translate(-50%, -50%);
        }
        
        #posts_img{
            height: 300px;
            width: 100%;
        }

    </style>

    <link rel="stylesheet" href="style/home_style2.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name" ?></title>
</head>

<body>

    <div class="row my-2">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-8">
            <?php
            echo "
                <div>
                <div> <img id='cover-img' class='img-rounded' src='cover/$user_cover' alt='cover'>
                </div>
                <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
                
                <ul class='nav pull-left' style='position: absolute; top:10px; left: 40px; '>
                    <l1 class='dropdown'>
                        <button class='dropdown-toggle btn btn-default' data-toggle='dropdown' > Change Cover</button>
                        <div class='dropdown-menu'>
                        <center>
                        <p>Click <strong>Select Cover</strong> and then click the <strong>Update Cover</strong></p>
                        <label class='btn btn-info'> Select Cover
                            <input type='file' name='u_cover' size='60'>
                        </label><br><br>
                        <button type='submit' name='submit' class='btn-info btn'>Update Cover</button>
                        </center>
                        </div>
                    </l1>
                
                </ul>
                </form>
            </div>   

            <div>
            <div id='profile-img'>
                <img src='users/$user_image' alt='profile' class='mr-3 mt-3 rounded-circle' width='180px' height='185px'>
                <form action='profile.php?u_id=$user_id' method='post' enctype='multipart/form-data'>
                <label id='update_profile'> Select Profile
                    <input type='file' name='u_image' size='60'>
                    </label><br><br>
                    <button id='button_profile' name='update' type='update' class='btn-info btn'>Update Profile</button>
                </form>

            </div><br>

        </div>
                ";
            ?>
            <?php
            if (isset($_POST['submit'])) {
                $u_cover = $_FILES['u_cover']['name'];
                $image_tmp = $_FILES['u_cover']['tmp_name'];
                $random_number = rand(1, 100);
                if ($u_cover == '') {
                    echo "<script>alert('Please Select Cover Image')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    exit();
                } else {
                    move_uploaded_file($image_tmp, "cover/$u_cover.$random_number");
                    $update = "update users set user_cover='$u_cover.$random_number' where user_id='$user_id'";
                    $run = mysqli_query($con, $update);

                    if ($run) {
                        echo "<script>alert('Your Cover Image Updated')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    }
                }
            }

            ?>

            <?php
            if (isset($_POST['update'])) {
                $u_image = $_FILES['u_image']['name'];
                $image_tmp = $_FILES['u_image']['tmp_name'];
                $random_number = rand(1, 100);
                if ($u_image == '') {
                    echo "<script>alert('Please Select Profile Image')</script>";
                    echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    exit();
                } else {
                    move_uploaded_file($image_tmp, "users/$u_image.$random_number");
                    $update = "update users set user_image='$u_image.$random_number' where user_id='$user_id'";
                    $run = mysqli_query($con, $update);

                    if ($run) {
                        echo "<script>alert('Your Profile Image Updated')</script>";
                        echo "<script>window.open('profile.php?u_id=$user_id','_self')</script>";
                    }
                }
            }

            ?>
        </div>
        <div class="col-sm-2">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-2">
        </div>
        <div class="col-sm-2" style="background-color: #e6e6e6; height:max-content; text-align:center; left:0.9%; border-radius:5px; ">
            <?php
            echo "
                        <center><h2><strong>About</strong></h2></center>
                        <center><h4><strong>$f_name $l_name</strong></h4></center>
                        <p><strong><i style='color:gray;'>$describe_user</i> </strong></p><br>
                        <p><strong>Relation Status: </strong> $Relationship </p><br>
                        <p><strong>Lives In: </strong> $user_country </p><br>
                        <p><strong>Member Since: </strong> $register_date </p><br>
                        <p><strong>Gender: </strong> $user_gender </p><br>
                        <p><strong>Date Of Birth: </strong> $user_birthday </p><br>

                        
                        
                        ";
            ?>
        </div>



        <div class="col-sm-6">
            <!-- display users post  -->
            <?php
            global $con;
            if (isset($_GET['u_id'])) {
                $u_id = $_GET['u_id'];
            }
            $get_posts = "Select * from posts where user_id='$u_id' order by 1 desc limit 5";
            $run_posts = mysqli_query($con, $get_posts);
            while ($row_posts = mysqli_fetch_array($run_posts)) {
                $post_id = $row_posts['post_id'];
                $user_id = $row_posts['user_id'];
                $content = $row_posts['post_content'];
                $upload_image = $row_posts['upload_image'];
                $post_date = $row_posts['post_date'];

                $user = "select * from users where user_id='$user_id' and posts='yes'";
                $run_user = mysqli_query($con, $user);
                $row_user = mysqli_fetch_array($run_user);

                $user_name = $row_user['user_name'];
                $user_image = $row_user['user_image'];

                //now we will display the posts

                if($content=="No" && strlen($upload_image) >= 1){
                    echo"
                    <div class='row' id='own_posts'>
                        <div class=''>
                        </div>
                        <div id='posts' class='col-sm-11 offset-1'>
                            <div class='row'>
                                <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='mr-3 mt-3 rounded-circle' width='50px' height='50px'></p>
                                </div>
                                <div class='col-sm-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                </div>
                                <div class=''>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <img id='posts_img' src='imagepost/$upload_image' style='height:350px;'>
                                </div>
                            </div><br>
                            <div class='row'>
                            <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>
                            <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a><br>
                        </div>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                    </div><br><br>
                    ";
                }
                else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
                    echo"
                    <div class='row'>
                        <div class=''>
                        </div>
                        <div id='posts' class='col-sm-11 offset-1'>
                            <div class='row'>
                                <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='mr-3 mt-3 rounded-circle' width='50px' height='50px'></p>
                                </div>
                                <div class='col-sm-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                </div>
                                <div class=''>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <h3><p>$content</p></h3>
                                    <img id='posts-img' src='imagepost/$upload_image' style='height:350px;'>
                                </div>
                            </div><br>
                            <div class='row'>
                            <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a><br>
                            <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a><br>
                        </div>
                        </div>
                        <div class='col-sm-3'>
                        </div>
                    </div><br><br>
                    ";
                }
                
                else{
                    echo"
                    <div class='row'>
                        <div class=''>
                        </div>
                        <div id='posts' class='col-sm-11 offset-1'>
                            <div class='row'>
                                <div class='col-sm-2'>
                                <p><img src='users/$user_image' class='mr-3 mt-3 rounded-circle' width='50px' height='50px'></p>
                                </div>
                                <div class='col-sm-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;color #3897f0;' href='profile.php?u_id=$user_id'>$user_name</a></h3>
                                    <h4><small style='color:black;'>Updated a post on <strong>$post_date</strong></small></h4>
                                </div>
                                <div class=''>
                                </div>
                            </div>
                            <div class='row'>
                                <div class='col-sm-12'>
                                    <h3><p>$content</p></h3>
                                </div>
                            </div><br>
                            
                    ";
                    
                    global $con;

                    if(isset($_GET['u_id'])){
                        $u_id = $_GET['u_id'];
                    }
                    $get_posts = "select user_email from users where user_id='$u_id'";
                    $run_user = mysqli_query($con,$get_posts);
                    $row = mysqli_fetch_array($run_user);

                    $user_email = $row['user_email'];

                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email='$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);

                    $user_id = $row['user_id'];
                    $u_email = $row['user_email'];

                    if($u_email != $user_email){
                        echo "<script>window.open('profile.php?u_id=$user_id', '_self')</script>";
                    }

                    else{
                        echo "

                        <div class='row'>
                        <a href='single.php?post_id=$post_id' style='float:right;'><button class='btn btn-success'>View</button></a>
                        <a href='edit_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-info'>Edit</button></a>
                        <a href='functions/delete_post.php?post_id=$post_id' style='float:right;'><button class='btn btn-danger'>Delete</button></a><br>
                        </div>
                    </div>
                    <div class='col-sm-3'>
                    </div>
                </div><br><br>
                        ";
                    }
                }

                include("functions/delete_post.php");
            }
            ?>

        </div>

        <div class="col-sm-2">

        </div>
    </div>
</body>

</html>