<?php
    include "DB_Connection.php";

    if(empty($_FILES['logo']['name']))
    {
        $file_name = $_POST['old_logo'];
    }
    else
    // if(isset($_FILES['logo']))
    {
        $Error = array();

        $file_name = $_FILES['logo']['name'];
        $file_size = $_FILES['logo']['size'];
        $file_type = $_FILES['logo']['type'];
        $file_temp = $_FILES['logo']['tmp_name'];
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
            move_uploaded_file($file_temp,"images/".$file_name);
        }
        else
        {
            print_r($Error);
            die();
        }
    }

    $WebSiteName = mysqli_real_escape_string($Connect,$_POST['website_name']);
    $FooterDesc = mysqli_real_escape_string($Connect,$_POST['footer_desc']);


    $Sql = "UPDATE settings SET websitename='$WebSiteName' , logo='$file_name' , footerdesc='$FooterDesc'";

    if(mysqli_query($Connect,$Sql))
    {
        header("Location: $HostName/admin/settings.php");
    }
    else
    {
        echo '<div class="alert alert-danger">SQL Failed</div>';
    }

?>