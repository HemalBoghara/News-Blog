<?php
    include "DB_Connection.php";
    if($_SESSION["user_role"]=='0')
    {
        header("Location: $HostName/admin/post.php");
    }
?>
<?php

    $Get_Id = $_GET['id'];
    $Delete_Catagory_SQL = "DELETE FROM `category` WHERE category_id = $Get_Id";
    if(mysqli_query($Connect,$Delete_Catagory_SQL))
    {
        header("Location: $HostName/admin/category.php");
    }
?>