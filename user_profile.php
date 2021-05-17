

<link rel="stylesheet" href="style/post_style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
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
    <?php
        if(isset($_GET['u_id'])){
            $u_id = $_GET['u_id'];
        }
        if($u_id<0 || $u_id == ""){
            echo "<script>window.open('home.php', '_self')</script>";
        }
        else {
    ?>
    <div class="col-sm-12">
            <?php
                if(isset($_GET['u_id'])){
                    global $con;

                    $user_id = $_GET['u_id'];

                    $select = "select * from users where user_id='$user_id'";
                    $run = mysqli_query($con,$select);
                    $row = mysqli_fetch_array($run);

                    $name = $row['user_name'];

                }
            ?>

            <?php
                if(isset($_GET['u_id'])){
                    global $con;

                    $user_id = $_GET['u_id'];

                    $select = "select * from users where user_id='$user_id'";
                    $run = mysqli_query($con,$select);
                    $row = mysqli_fetch_array($run);

                    
                    $id = $row['user_id'];
                    $image = $row['user_image'];
                    $name = $row['user_name'];
                    $f_name = $row['f_name'];
                    $l_name = $row['l_name'];
                    $describe_user = $row['describe_user'];
                    $Relationship = $row['Relationship'];
                    $country = $row['user_country'];
                    $gender = $row['user_gender'];
                    $birthday = $row['user_birthday'];
                    $user_cover = $row['user_cover'];
                    $register_date = $row['user_reg_date'];

                    echo "
                    
                    
                    <center>
                    <div class='' style='width: 18rem;'>
                    <img src='users/$image' alt='profile' class='mr-3 mt-3 rounded-circle' width='180px' height='185px'>
                    <div class='card-body'>
                      <h5 class='card-title'>$f_name $l_name</h5>
                      <p class='card-text'>$describe_user</p>
                    </div>
                    <ul class='list-group list-group-flush'>
                      <li class='list-group-item'><strong>Country: </strong>$country</li>
                      <li class='list-group-item'><strong>Gender: </strong>$gender</li>
                      <li class='list-group-item'><strong>Birthday: </strong>$birthday</li>
                      <li class='list-group-item'><strong>Relationship: </strong>$Relationship</li>
                    </ul>
                  </div>
                  </center><br><br>
                    ";

                    $user = $_SESSION['user_email'];
                    $get_user = "select * from users where user_email = '$user'";
                    $run_user = mysqli_query($con,$get_user);
                    $row = mysqli_fetch_array($run_user);
    
                    $userown_id = $row['user_id'];
    
                    if($user_id == $userown_id){
                        echo "
                            <a href='edit_profile.php?u_id=$userown_id' class ='btn btn-success' >Edit Profile </a><br><br>
                        ";
                    }
                }

            
            ?>

        <div class="col-sm-8">
            <center><h1><strong><?php echo "$f_name $l_name"?></strong> Posts</h1></center>

            <?php 
                global $con;

                if(isset($_GET['u_id'])){
                    $u_id = $_GET['u_id'];
                }
                $get_posts = "select * from posts where user_id='$u_id' order by 1 desc limit 5";

                $run_posts = mysqli_query($con,$get_posts);

                 while($row_posts = mysqli_fetch_array($run_posts)){
                     $post_id = $row_posts['post_id'];
                     $user_id = $row_posts['user_id'];
                     $content = $row_posts['post_content'];
                     $upload_image = $row_posts['upload_image'];
                     $post_date = $row_posts['post_date'];

                     $user = "select * from users where user_id='$user_id' and posts='yes'";

                     $run_user = mysqli_query($con,$user);
                     $row_user = mysqli_fetch_array($run_user);

                     $user_name = $row_user['user_name'];
                     $f_name = $row_user['f_name'];
                     $l_name = $row_user['l_name'];
                     $user_image = $row_user['user_image'];

                     if($content=="No" && strlen($upload_image) >= 1){
                        echo "<div class='container my-5'>
                            <div class='row'>
                                <div class='col-md-9 col-lg-12 mx-md-auto'>
                                    <div class='card'>
                                        <div class='card-header post-header'>
                                            <div class='media'>
                                                <img class='rounded-circle avatar z-depth-0' src='users/$user_image' alt='Avatar'>
                                                <div class='media-body ml-2'>
                                                    <h6><a href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h6>
                                                    <span class='text-muted'><small>$post_date</small></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='card-body py-0'>
                                            
                                            <div class='d-grid mdb-lightbox'>
                                                <figure class='item'>
                                                        <img src='imagepost/$upload_image' class='img-fluid'  style='height:350px;'/>
                                                </figure>
                                                
                                            </div>
                                        </div>
                                        <div class='card-footer post-actions'>
                                            <div class='d-flex'>
                                                <div class='ml-auto actions-menu'>
                                                    <a class='btn-floating hoverable btn-sm'>
                                                        <i class='fas fa-thumbs-up'></i>
                                                    </a>
                                                    <a href='single.php?post_id=$post_id' class='btn-floating hoverable btn-sm'>
                                                        <i class='fas fa-comment'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                     }
                     else if(strlen($content) >= 1 && strlen($upload_image) >= 1){
                        echo "<div class='container my-5'>
                            <div class='row'>
                                <div class='col-md-9 col-lg-12 mx-md-auto'>
                                    <div class='card'>
                                        <div class='card-header post-header'>
                                            <div class='media'>
                                                <img class='rounded-circle avatar z-depth-0' src='users/$user_image' alt='Avatar'>
                                                <div class='media-body ml-2'>
                                                    <h6><a href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h6>
                                                    <span class='text-muted'><small>$post_date</small></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='card-body py-0'>
                                        <p class='post-text'>
                                        $content
                                        </p>
                                            <div class='d-grid mdb-lightbox'>
                                                <figure class='item'>
                                                        <img src='imagepost/$upload_image' class='img-fluid' style='height:350px;'/>
                                                </figure>
                                                
                                            </div>
                                        </div>
                                        <div class='card-footer post-actions'>
                                            <div class='d-flex'>
                                                <div class='ml-auto actions-menu'>
                                                    <a class='btn-floating hoverable btn-sm'>
                                                        <i class='fas fa-thumbs-up'></i>
                                                    </a>
                                                    <a href='single.php?post_id=$post_id' class='btn-floating hoverable btn-sm'>
                                                        <i class='fas fa-comment'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                     }
                     else {
                        echo "<div class='container my-5'>
                            <div class='row'>
                                <div class='col-md-9 col-lg-12 mx-md-auto'>
                                    <div class='card'>
                                        <div class='card-header post-header'>
                                            <div class='media'>
                                                <img class='rounded-circle avatar z-depth-0' src='users/$user_image' alt='Avatar'>
                                                <div class='media-body ml-2'>
                                                    <h6><a href='user_profile.php?u_id=$user_id'>$f_name $l_name</a></h6>
                                                    <span class='text-muted'><small>$post_date</small></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='card-body py-0'>
                                        <p class='post-text'>
                                        $content
                                        </p>
                                        </div>
                                        <div class='card-footer post-actions'>
                                            <div class='d-flex'>
                                                <div class='ml-auto actions-menu'>
                                                    <a class='btn-floating hoverable btn-sm'>
                                                        <i class='fas fa-thumbs-up'></i>
                                                    </a>
                                                    <a href='single.php?post_id=$post_id' class='btn-floating hoverable btn-sm'>
                                                        <i class='fas fa-comment'></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>";
                     }
                 }
            
            ?>
        </div>
    </div>
</div>
<?php }?>
</body>
</html>


