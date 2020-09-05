<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                
                <div class="post-container">
                    <?php
                        if(isset($_GET))
                        {
                            $Cat_Id = $_GET['cid'];
                        }

                        $Page_SQL = "SELECT post.post_id,post.title,post.description,post.post_img,post.post_date,category.category_name,user.username FROM post 
                        LEFT JOIN category ON post.category = category.category_id 
                        LEFT JOIN user ON post.author = user.user_id 
                        WHERE category = $Cat_Id";
                    
                        // $Page_SQL = "select post from category WHERE category_id = $Cat_Id";
                        $Page_Result = mysqli_query($Connect,$Page_SQL) or die("Error: Page_SQL");
                        $Rows = mysqli_fetch_assoc($Page_Result);
                        echo '<h2 class="page-heading">'.$Rows['category_name'].'</h2>';

                    ?>
                    
                    <!-- post-container -->
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
                        $offSet = ($Page - 1 ) * $Limit;
                        $Cat_SQL = "SELECT post.post_id,post.title,post.author,post.description,post.category,post.post_img,post.post_date,category.category_name,user.username FROM post 
                        LEFT JOIN category ON post.category = category.category_id 
                        LEFT JOIN user ON post.author = user.user_id 
                        WHERE category = $Cat_Id
                        ORDER BY post.post_id DESC LIMIT $offSet,$Limit";
                        $Cat_Result = mysqli_query($Connect,$Cat_SQL) or die("Error : Cat_Result");
                        if(mysqli_num_rows($Cat_Result)>0)
                        {
                            while($Row = mysqli_fetch_assoc($Cat_Result))
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
                                                            '.$Row['category_name'].'
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
                                                        '.substr($Row['description'],0,135).'...
                                                    </p>
                                                    <a class="read-more pull-right" href="single.php?id='.$Row['post_id'].'">read more</a>
                                                </div>
                                            </div>
                                        </div>
                                </div>';
                            }
                        }
                    ?>
                    <?php
                    
                        
                        if(mysqli_num_rows($Page_Result)>0)
                        {
                            $Total_Record = mysqli_num_rows($Page_Result);
                            $Total_Page = ceil($Total_Record/$Limit);
                            echo '<ul class="pagination">';
                            if($Page > 1)
                            {
                                echo'<li><a href="category.php?cid='.$Cat_Id.'&page='.($Page-1).'">Prev</a></li>';
                            }
                            for($i=1; $i<=$Total_Page; $i++)
                            {
                                if($i==$Page)
                                {
                                    $Active = "active";
                                }
                                else
                                {
                                    $Active = "";
                                }
                                echo '<li class="'.$Active.'"><a href="category.php?cid='.$Cat_Id.'&page='.$i.'">'.$i.'</a></li>';
                            }
                            if($Total_Page > $Page)
                            {
                                echo'<li><a href="category.php?cid='.$Cat_Id.'&page='.($Page+1).'">Next</a></li>';
                            }
                            echo '</ul>';
                        }
                        else
                        {
                            echo '<div class="alert alert-warning"><h5><b>No Records</b></h5></div>';
                        }
                    
                    ?>
                    
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
