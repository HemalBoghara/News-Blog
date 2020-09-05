<?php

    include "DB_Connection.php";

    $Delete_Id = $_GET['id'];
    $Catagory_Id = $_GET['cid'];

    $Select_Post = "SELECT * FROM post WHERE post_id=$Delete_Id";
    $Select_Delete = mysqli_query($Connect,$Select_Post) or die("Error Select SQL");

    $Row = mysqli_fetch_assoc($Select_Delete);
    
    unlink("upload/".$Row['post_img']);


    $Delete_SQL = "DELETE FROM post WHERE post_id = $Delete_Id;";
    $Delete_SQL .= "UPDATE category SET post = post - 1 WHERE category_id = $Catagory_Id";
    // echo $Delete_SQL;
    $Delete_Result = mysqli_multi_query($Connect,$Delete_SQL);
    if($Delete_Result)
    {
        header("Location: $HostName/admin/post.php");
    }
    else
    {
        echo '<div class="alert alert-danger">Delete Error!</dive>';
    }

?>