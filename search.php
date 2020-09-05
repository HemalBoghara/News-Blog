<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    include "DB_Connection.php";
                    if(isset($_GET['search']))
                    {
                        $Search_Item = mysqli_real_escape_string($Connect,$_GET['search']);
                        echo'<div class="post-container">
                                <h2 class="page-heading">Search : '.$Search_Item.'</h2>';
                    }
                ?>

                <?php
                    
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
                    $Search_SQL = "SELECT post.post_id,post.title,post.description,post.post_date,post.category,post.author,post.post_img,category.category_name,user.username FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id  WHERE title LIKE '%$Search_Item%' OR description LIKE '%$Search_Item%' ORDER BY post_id DESC LIMIT $offset,$Limit";

                    $Search_Result = mysqli_query($Connect,$Search_SQL) or die("Error : Search_SQL");

                    if(mysqli_num_rows($Search_Result)>0)
                    {
                        while($Row = mysqli_fetch_assoc($Search_Result))
                        {
                            echo'<div class="post-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a class="post-img" href="single.php?id='.$Row['post_id'].'"><img src="admin/upload/'.$Row['post_img'].'" alt=""/></a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="inner-content clearfix">
                                                <h3><a href="single.php?id='.$Row['post_id'].'">'.$Row['title'].'</a></h3>
                                                <div class="post-information">
                                                    <span>
                                                        <i class="fa fa-tags" aria-hidden="true"></i>
                                                        <a href="category.php?cid='.$Row['category'].'">'.$Row['category_name'].'</a>
                                                    </span>
                                                    <span>
                                                        <i class="fa fa-user" aria-hidden="true"></i>
                                                        <a href="author.php?aid='.$Row['author'].'">'.$Row['username'].'</a>
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
                        echo '<div class="alert alert-waring">No Search Item Found</div>';
                    }
                  ?>
                <?php
                
                    $Page_SQL = "SELECT * FROM post WHERE post.title LIKE '%$Search_Item%' OR post.description LIKE '%$Search_Item%'";
                    $Page_Result = mysqli_query($Connect,$Page_SQL) or die("Error : Page_SQL");

                    if(mysqli_num_rows($Page_Result) > 0)
                    {
                        $Total_Record = mysqli_num_rows($Page_Result);
                        $Total_Page = ceil($Total_Record/$Limit);

                        echo'<ul class="pagination">';
                        if($Page > 1)
                        {
                            echo'<li><a href="search.php?search='.$Search_Item.'&page='.($Page - 1).'">Prev</a></li>';
                        }
                        for($i=1;$i<=$Total_Page;$i++)
                        {
                            if($i == $Page)
                            {
                                $Active = "active";
                            }
                            else
                            {
                                $Active = "";
                            }
                            echo'<li class="'.$Active.'"><a href="search.php?search='.$Search_Item.'&page='.$i.'">'.$i.'</a></li>';
                        }
                        if($Total_Page > $Page)
                        {
                            echo'<li><a href="search.php?search='.$Search_Item.'&page='.($Page + 1).'">Next</a></li>';
                        }
                        echo'</ul>';
                    }
                ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>