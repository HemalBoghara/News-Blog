<?php
    include "DB_Connection.php";

    if(isset($_FILES['fileToUpload']))
    {
        $Error = array();

        $file_name = $_FILES['fileToUpload']['name'];
        $file_size = $_FILES['fileToUpload']['size'];
        $file_type = $_FILES['fileToUpload']['type'];
        $file_temp = $_FILES['fileToUpload']['tmp_name'];
        $file_ext = end(explode('.',$file_name));
        $extensions = array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions) === false)
        {
            $Error[] = "This Extension File Not Allowed , Please Choose A JPG OR PNG FIle.";
        }

        if($file_size >= 2097152)
        {
            $Error[] = "File Size Must Be 2MB OR Lower .";
        }

        if(empty($Error)==true)
        {
            move_uploaded_file($file_temp,"upload/".$file_name);
        }
        else
        {
            print_r($Error);
            die();
        }
    }

    $title = mysqli_real_escape_string($Connect,$_POST['post_title']);
    $description = mysqli_real_escape_string($Connect,$_POST['postdesc']);
    $category = mysqli_real_escape_string($Connect,$_POST['category']);
    $date = date("d M, Y");
    session_start();
    $author = $_SESSION["user_id"];


    $Sql = "INSERT INTO post (title,description,category,post_date,author,post_img) VALUES ('$title','$description',$category,'$date',$author,'$file_name');";
    $Sql .= "UPDATE category SET post = post + 1 WHERE category_id = $category";
    // print_r($Sql);
    // die();
    // if(mysqli_query($Connect,$SQL))

    if(mysqli_multi_query($Connect,$Sql))
    {
        header("Location: $HostName/admin/post.php");
    }
    else
    {
        echo '<div class="alert alert-danger">MultiSQL Failed</div>';
    }

?>