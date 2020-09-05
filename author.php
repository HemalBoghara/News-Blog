<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    include "DB_Connection.php";
                    $Author_Id = $_GET['aid'];
                    
                    $Fetch_Name_SQL = "SELECT * FROM post JOIN user ON post.author = user.user_id WHERE post.author = $Author_Id";
                    $Fetch_Name_Result = mysqli_query($Connect,$Fetch_Name_SQL);
                    
                    $Rows = mysqli_fetch_assoc($Fetch_Name_Result);
                
                    echo'<div class="post-container">
                            <h2 class="page-heading alert-success">User Profile  : '.$Rows['username'].' </h2>';
                ?>
                    
                <?php
                    include "DB_Connection.php";

                    if(isset($_GET['page']))
                    {
                        $Page = $_GET['page'];
                    }
                    else
                    {
                        $Page = 1;
                    }

                    $Limit = 3;
                    $offset = ($Page - 1) * $Limit;

                    // $Author_Id = $_GET['aid'];
                    $User_Fetch_SQL = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE author = $Author_Id ORDER BY post_id DESC LIMIT $offset,$Limit";
                    $User_Fetch_Result = mysqli_query($Connect,$User_Fetch_SQL);

                    if(mysqli_num_rows($User_Fetch_Result)>0)
                    {
                        while($Row = mysqli_fetch_assoc($User_Fetch_Result))
                        {
                            echo'<div class="post-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="post-img" href="single.php?id='.$Row['post_id'].'"><img src="admin/upload/'.$Row['post_img'].'" alt="" /></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="inner-content clearfix">
                                                <h3><a href="single.php?id='.$Row['post_id'].'">'.$Row['title'].'</a>
                                                </h3>
                                                <div class="post-information">
                                                    <span>
                                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                                        <a href="category.php?cid='.$Row['category'].'">'.$Row['category_name'].'</a>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        '.$Row['username'].'
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                                        '.$Row['post_date'].'
                                                    </span>
                                                </div>
                                                <p class="description">
                                                    '.$Row['description'].'
                                                </p>
                                                <a class="read-more pull-right" href="single.php?id='.$Row['post_id'].'">read more</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
                        }
                    }
                    else
                    {

                        echo '<div class="alert alert-warning"><p>No Post Upload</p></div>';
                    }
                ?>
                <?php
                
                    $Page_Sql = "SELECT * FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE author = $Author_Id";
                    $Page_Result = mysqli_query($Connect,$Page_Sql) or die("Error: Page_SQL");
                    if(mysqli_num_rows($Page_Result)>0)
                    {
                        $Total_Record = mysqli_num_rows($Page_Result);
                        $Total_Page = ceil($Total_Record/$Limit);
                        echo'<ul class="pagination">';
                        if($Page > 1)
                        {
                            echo'<li><a href="author.php?aid='.$Author_Id.'&page='.($Page - 1).'">Prev</a></li>';
                        }
                        for($i=1;$i<=$Total_Page;$i++)
                        {
                            if($i==$Page)
                            {
                                $Active = "active";
                            }
                            else
                            {
                                $Active = "";
                            }
                            echo'<li class='.$Active.'><a href="author.php?aid='.$Author_Id.'&page='.$i.'">'.$i.'</a></li>';
                        }
                        if($Total_Page > $Page)
                        {
                            echo'<li><a href="author.php?aid='.$Author_Id.'&page='.($Page + 1).'">Next</a></li>';
                        }
                        echo'</ul>';
                    }
                ?>
                        <!-- <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>