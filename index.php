<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php
                        include "DB_Connection.php";
                        if(isset($_GET['page']))
                        {
                            $page = $_GET['page'];
                        }
                        else
                        {
                            $page = 1;
                        }
                        $Limit = 3;
                        $offset = ($page - 1) * $Limit;
                        $Fetch_SQL = "SELECT post.post_id,post.title,post.author,post.category,post.description,category.category_name,user.username,post.post_date,post.post_img FROM post 
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        ORDER BY post_id DESC LIMIT $offset,$Limit";
                        $Fetch_Result = mysqli_query($Connect,$Fetch_SQL);
                        if(mysqli_num_rows($Fetch_Result)>0)
                        {
                            while($Row = mysqli_fetch_assoc($Fetch_Result))
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
                                                    <a href="author.php?aid='.$Row['author'].'">'.$Row['username'].'</a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                                    '.$Row['post_date'].'
                                                </span>
                                            </div>
                                            <p class="description">'.substr($Row['description'],0,135)."..".'</p>
                                            <a class="read-more pull-right" href="single.php?id='.$Row['post_id'].'">read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                            }
                        }
                        else
                        {
                            echo '<h1>No Record Found</h1>';
                        }
                    
                    
                    ?>
                    <?php

                        $Page_Sql = "SELECT * FROM post";
                        $Page_Result = mysqli_query($Connect,$Page_Sql);
                        if(mysqli_num_rows($Page_Result)>0)
                        {
                            $Total_Record = mysqli_num_rows($Page_Result);
                            $Total_Page = ceil($Total_Record / $Limit);
                            echo'<ul class="pagination">';

                            if($page > 1)
                            {
                                echo'<li><a href="index.php?page='.($page-1).'">Prev</a></li>';
                            }
                            for($i=1;$i<=$Total_Page;$i++)
                            {
                                if($i == $page)
                                {
                                    $active = "active";
                                }
                                else
                                {
                                    $active = "";
                                }
                                echo '<li class="'.$active.'"><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                            }
                            if($Total_Page > $page)
                            {
                                echo'<li><a href="index.php?page='.($page+1).'">Next</a></li>';
                            }
                            echo'</ul>';
                        }
                    
                    ?>
                    
                        <!-- <li class="active"><a href="">1</a></li>
                        
                        <li><a href="">3</a></li> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>