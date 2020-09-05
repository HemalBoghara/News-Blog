<?php

    include "DB_Connection.php";

    if(empty($_FILES['new-image']['name']))
    {
        $file_name = $_POST['old_image'];
    }
    else
    {
        $Error = array();
        
        $file_name = $_FILES['new-image']['name'];
        $file_size = $_FILES['new-image']['size'];
        $file_type = $_FILES['new-image']['type'];
        $file_temp = $_FILES['new-image']['tmp_name'];
        $file_ext = end(explode('.',$file_name));
        $extensions = array("png","jpg","jpeg");

        if(in_array($file_ext,$extensions)===false)
        {
            $Error[] = "This Extension File Is Not Allowed , Please Choose A JPG OR PNG FIle.";
        }

        if($file_size > 2097152)
        {
            $Error[] = "File Size Must Be 2MB OR Lower."; 
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

    $Post_Id = $_POST['post_id'];
    $Title = mysqli_real_escape_string($Connect,$_POST['post_title']);
    $Description = mysqli_real_escape_string($Connect,$_POST['postdesc']);
    $Catagory = $_POST['category'];


    $Update_SQL = "UPDATE `post` SET title='$Title',description='$Description',category=$Catagory,post_img='$file_name' WHERE post_id=$Post_Id;";

    if($_POST['old_category'] != $_POST['category'])
    {
        $Update_SQL .= "UPDATE category SET post=post-1 WHERE category_id = $_POST['old_category'];";
        $Update_SQL .= "UPDATE category SET post= post + 1 WHERE category_id = $_POST['category'];";
    }
    
    echo $Update_SQL;
    die();

    $Update_Result = mysqli_multi_query($Connect,$Update_SQL);

    if($Update_Result)
    {
        header("Location: $HostName/admin/post.php");
    }
    else
    {
        echo '<h1 class="alert alert-danger">UpDate Post Error</h1>';
    }
?>