<?php
/*
    echo'<pre>';
        print_r($_SERVER);
    echo'</pre>';
*/
    // echo '<h1>' . $_SERVER['PHP_SELF'] . '</h1>';
    include "DB_Connection.php";

    $Pages = basename($_SERVER['PHP_SELF']);
    switch($Pages)
    {
        case "single.php":
            if(isset($_GET['id']))
            {
                $P_ID = $_GET['id'];
                $Title_Sql = "SELECT * FROM post WHERE post_id = $P_ID";
                $Title_Result = mysqli_query($Connect,$Title_Sql) or die("Error: Title_SQL Failed");
                $Row_Title = mysqli_fetch_assoc($Title_Result);
                $Page_Title = "View - " . $Row_Title['title'];
            }
            else
            {
                $Page_Title = "No Post Found";
            }
            break;
        case "category.php":
            if(isset($_GET['cid']))
            {
                $C_ID = $_GET['cid'];
                $Title_Sql = "SELECT * FROM category WHERE category_id = $C_ID";
                $Title_Result = mysqli_query($Connect,$Title_Sql) or die("Error: Title_SQL Failed");
                $Row_Title = mysqli_fetch_assoc($Title_Result);
                $Page_Title = $Row_Title['category_name'];
            }
            else
            {
                $Page_Title = "No Post Found";
            }
            break;
        case "author.php":
            if(isset($_GET['aid']))
            {
                $A_ID = $_GET['aid'];
                $Title_Sql = "SELECT * FROM user WHERE user_id = $A_ID";
                $Title_Result = mysqli_query($Connect,$Title_Sql) or die("Error: Title_SQL Failed");
                $Row_Title = mysqli_fetch_assoc($Title_Result);
                $Page_Title = "Profile - " . $Row_Title['first_name'] . " " . $Row_Title['last_name'] ;
            }
            else
            {
                $Page_Title = "No Post Found";
            }
            break;
        case "search.php":
            if(isset($_GET['search']))
            {
                $Page_Title = $_GET['search'];
            }
            else
            {
                $Page_Title = "No Post Found";
            }
            break;
        default:
            $Page_Title = 'New - Site';
            break;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $Page_Title; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class=" col-md-offset-4 col-md-4">
                <?php
                    
                    $SQL = "SELECT * FROM settings";
                    $Result = mysqli_query($Connect,$SQL) or die("Error: SQL");
                    if(mysqli_num_rows($Result)>0)
                    {
                        while($Row = mysqli_fetch_assoc($Result))
                        {
                            if($Row['logo']=="")
                            {
                                echo'<a href="index.php"><h1>'.$Row['websitename'].'</h1></a>';
                            }
                            else
                            {
                                echo'<a href="index.php" id="logo"><img src="admin/images/'.$Row['logo'].'"></a>';
                            }
                        }
                    }
                ?>
                </div>
                <!-- /LOGO -->
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <!-- Menu Bar -->
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                        <?php
                        include "DB_Connection.php";
                        
                        if(isset($_GET['cid']))
                        {
                            $cat_id = $_GET['cid'];
                        }

                        // $Category_Sql = "SELECT * FROM category";
                        $Category_Sql = "SELECT * FROM category WHERE post > 0";
                        $Category_Result = mysqli_query($Connect,$Category_Sql);
                        if(mysqli_num_rows($Category_Result)>0)
                        {
                            $Active = "";
                            echo '<ul class="menu">
                                    <li><a href="'.$HostName.'">Home</a></li>';
                            while($Row = mysqli_fetch_assoc($Category_Result))
                            {
                                if(isset($_GET['cid']))
                                {
                                    if($Row['category_id'] == $cat_id)
                                    {
                                        $Active = "active"; 
                                    }
                                    else
                                    {
                                        $Active = "";
                                    }
                                }
                                echo'<li><a class="'.$Active.'" href="category.php?cid='.$Row['category_id'].'">'.$Row['category_name'].'</a></li>';
                                // echo'<li><a class="'.$Active.'" href="category.php?cid='.$Row['category_id'].'">'.$Row['category_name'].'</a></li>';
                            }
                            echo'</ul>';
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- /Menu Bar -->