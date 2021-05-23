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
    <title>Edit Account</title>
</head>
<body>
<div class="row">
    <div class="col-sm-2">
    </div>
    <div class="col-sm-8">
        <form action="" method="post" enctype="multipart/form-data">
            <table class="table table-hover table-bordered">
                <tr align="center">
                    <td colspan="6" class="active"><h2>Edit Your Account</h2></td>
                </tr>
                <tr>
                    <td style="font-weight: bold;"> Change Your First Name</td>
                    <td>
                        <input class="form-control" type="text" name="f_name" required value="<?php echo $f_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;"> Change Your Last Name</td>
                    <td>
                        <input class="form-control" type="text" name="l_name" required value="<?php echo $l_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;"> Change Your User Name</td>
                    <td>
                        <input class="form-control" type="text" name="u_name" disabled required value="<?php echo $user_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Description</td>
                    <td>
                        <input class="form-control" type="text" name="describe_user" required value="<?php echo $describe_user; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Relationship Status</td>
                    <td>
                        <select name="Relationship" class="form-control" id="">
                            <option><?php echo $Relationship ?></option>
                            <option>Engaged</option>
                            <option>Married</option>
                            <option>Single</option>
                            <option>In a Relationship</option>
                            <option>It's Complicated</option>
                            <option>Seprated</option>
                            <option>Divorced</option>
                            <option>Widowed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Password</td>
                    <td>
                        <input class="form-control" type="password" name="u_pass" id="mypass" required value="<?php echo $user_pass; ?>">
                        <input type="checkbox" onclick="show_password()" ><strong>Show Password</strong>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;"> Email</td>
                    <td>
                        <input class="form-control" type="text" name="u_email" disabled required value="<?php echo $user_email; ?>">
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Country</td>
                    <td>
                        <select name="u_country" class="form-control" id="">
                            <option><?php echo $user_country ?></option>
                            <option>Afghanistan</option>
                            <option>Albania</option>
                            <option>Algeria</option>
                            <option>Andorra</option>
                            <option>Angola</option>
                            <option>Armenia</option>
                            <option>India</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Gender</td>
                    <td>
                        <select name="u_gender" class="form-control" id="">
                            <option><?php echo $user_gender ?></option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td style="font-weight: bold;"> Birthdate</td>
                    <td>
                        <input class="form-control input-md" type="date" name="u_birthday" required value="<?php echo $user_birthday; ?>">
                    </td>
                </tr>

                <!-- forgot password question -->

                <tr>
                    <td style="font-weight: bold;"> Forgot Password</td>
                    <td>
                                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Change Security Question
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Security Question </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="" method="post" id="f">
                                        <strong>What is your School Best Friend Name?</strong>
                                        <textarea name="content" class="form-control" cols="83" rows="4" placeholder="Answer the above question this will help you when you forgot your password"></textarea><br>
                                        <input type="submit" name="sub" class="btn btn-dark" value="Submit" style="width: 100px;" ><br><br>
                                    </form>

                                    <?php
                                        if(isset($_POST['sub'])){
                                            $bfn = htmlentities($_POST['content']);
                                            if($bfn ==''){
                                                echo "<script>alert('Please Enter Something!')</script>";
                                                echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                                                exit();
                                            }
                                            else{
                                                $update = "update users set recovery_account='$bfn' where user_id='$user_id'";

                                                $run = mysqli_query($con,$update);
                                                if($run){
                                                    echo "<script>alert('Recovery Question Updated...')</script>";
                                                    echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                                                }
                                                else{
                                                    echo "<script>alert('Error while upadting Recovery Question')</script>";
                                                    echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
                                                }
                                            }
                                        }
                                    ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                
                            </div>
                            </div>
                        </div>
                        </div>
                    </td>
                </tr>
                <tr align="center">
                    <td colspan="6">
                        <input type="submit" name="update" class="btn btn-info" value="Update" style="width: 250px;">
                    </td>
                
                </tr>
            </table>
        </form>
    </div>
    <div class="col-sm-2"></div>
      
</div>
<!-- show password radio button script  -->
<script>
    var state = false;
    function show_password(){
        if(state){
            document.getElementById("mypass").setAttribute("type","password");
            state = false;
        }
        else{
            document.getElementById("mypass").setAttribute("type","text");
            state = true;

        }
    }

</script>
</body>
</html>


<?php
    if(isset($_POST['update'])){
        $f_name = htmlentities($_POST['f_name']);
        $l_name = htmlentities($_POST['l_name']);
        $u_name = htmlentities($_POST['u_name']);
        $describe_user = htmlentities($_POST['describe_user']);
        $Relationship_status = htmlentities($_POST['Relationship']);
        $u_pass = htmlentities($_POST['u_pass']);
        $u_email = htmlentities($_POST['u_email']);
        $u_country = htmlentities($_POST['u_country']);
        $u_gender = htmlentities($_POST['u_gender']);
        $u_birthday = htmlentities($_POST['u_birthday']);

        $update = "update users set f_name='$f_name', l_name='$l_name', describe_user='$describe_user',
        Relationship='$Relationship_status', user_pass='$u_pass', user_country='$u_country',
        user_gender='$u_gender', user_birthday='$u_birthday' where user_id='$user_id' ";

        $run = mysqli_query($con,$update);
        if($run){
            echo "<script>alert('Profile Updated...')</script>";
            echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
        }
        else{
            echo "<script>alert('Error while upadting Recovery Question')</script>";
            echo "<script>window.open('edit_profile.php?u_id=$user_id', '_self')</script>";
        }
    }
?>
