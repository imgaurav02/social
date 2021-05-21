<?php

    // getting the post id to diplay the commented users on that post 
    $get_id = $_GET['post_id'];

    $get_com = "select * from comments where post_id='$get_id' order by 1 desc";
    $run_com = mysqli_query($con,$get_com);
    echo "<div class='row'><div class='col-md-3'></div><div class='col-md-6'><h3> Comments: </h3></div><div class='col-md-3'></div></div> <br>";
    
    while($row = mysqli_fetch_array($run_com)){
        // getting the data of how many comments are there in that post and displaying it 
        $com = $row['comment'];
        $com_name = $row['comment_author'];
        $date = $row['date'];

        echo "
        <div class='row'>
        
        <div class='col-md-3'></div>
        <div class='card'>
                <div class='card-header'>
                <strong>$com_name</strong><i> Commented </i> on $date
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>$com</h5>
                </div>
        </div>
        
        <div class='col-md-3'></div>
        </div>
        ";
    }
?>