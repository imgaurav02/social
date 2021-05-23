<?php 

    include("base.php");
    include("connection.php");
?>
<link rel="stylesheet" href="style/post_style.css">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Social</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php
      $user = $_SESSION['user_email'];
      $get_user = "select * from users where user_email='$user'";
      $run_user = mysqli_query($con,$get_user);
      $row = mysqli_fetch_array($run_user);

      $user_id = $row['user_id'];
      $user_name = $row['user_name'];
      $f_name = $row['f_name'];
      $l_name = $row['l_name'];
      $describe_user = $row['describe_user'];
      $Relationship = $row['Relationship'];
      $user_pass = $row['user_pass'];
      $user_email = $row['user_email'];
      $user_country = $row['user_country'];
      $user_gender = $row['user_gender'];
      $user_birthday = $row['user_birthday'];
      $user_image = $row['user_image'];
      $user_cover = $row['user_cover'];
      $recovery_account = $row['recovery_account'];
      $register_date = $row['user_reg_date'];

      $user_posts = "select * from posts where user_id='$user_id'";
      $run_post = mysqli_query($con,$user_posts);
      $posts = mysqli_num_rows($run_post);
    
    ?>

      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="profile.php?<?php echo "u_id=$user_id"?>"><?php echo "$f_name"?></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="members.php">Find People</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="messages.php?u_id=new">Messages</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Action
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="my_post.php?<?php echo "u_id=$user_id"?>">My Posts <span class="badge badge-secondry"><?php $posts?></span></a>
          <a class="dropdown-item" href="edit_profile.php?<?php echo "u_id=$user_id"?>">Edit Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php">Logout</a>
        </div>
      </li>
    </ul>
    
  </div>
</nav>