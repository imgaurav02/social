<?php
    session_start();
    include("includes/header.php");
    include("functions/functions.php");

    if(!isset($_SESSION['user_email'])){
        header("location: index.php");
    }

    $user = $_SESSION['user_email'];
    $get_user = "select * from users where user_email='$user'";
    $run_user = mysqli_query($con,$get_user);
    $row = mysqli_fetch_array($run_user);

    $user_name = $row['user_name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>

<style>
    #cover-img{
        height: 400px;
        width: 100%;
    }

    #profile-img{
        position: absolute;
        top: 160px;
        left: 40px;
    }
    #update_profile{
        position: relative;
        top: -36px;
        cursor: pointer;
        left: 93px;
        border-radius: 4px;
        background-color: rgba(0, 0, 0, 0.5);
        transform: translate(-50%, -50%);
    }

    #button_profile{
        position: absolute;
        top: 82%;
        left: 50%;
        cursor: pointer;
        transform: translate(-50%, -50%);
    }

</style>

<link rel="stylesheet" href="style/home_style2.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "$user_name"?></title>
</head>
<body>
    <div class="row">
        <div id="insert_post" class="col-sm-12">
            <center>
            <form action="home.php?id=<?php echo $user_id;?>" method="post" id="f" enctype="multipart/form-data">
                <textarea name="content" id="content" class="form-control" rows="4" placeholder="What's in your mind?"></textarea><br>
                <label class="btn btn-warning" id="upload_image_button">Select Image
                    <input type="file" name="upload_image" size="30">
                </label>
                <button id="btn-post" class="btn btn-success" name="sub">Post</button>
            </form>

            <?php insertPost();?>
            </center>
        </div>
    </div>
<div class="row">
	<div class="col-sm-12">
		<center><h2><strong>News Feed</strong></h2><br></center>
		<?php echo get_posts(); ?>
	</div>
</div>
</body>
</html>



