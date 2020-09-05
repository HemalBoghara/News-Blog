<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search ....." required>
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>

        <?php
            include "DB_Connection.php";

            $Limit = 3;
            $Recent_SQL = "SELECT post.post_id,post.title,category.category_name,post.post_date,post.post_img,post.category FROM post LEFT JOIN category ON post.category = category.category_id ORDER BY post_id DESC LIMIT $Limit";
            $Recent_Result = mysqli_query($Connect,$Recent_SQL);
            if(mysqli_num_rows($Recent_Result)>0)
            {
                while($Row = mysqli_fetch_assoc($Recent_Result))
                {
                    echo'<div class="recent-post">
                    <a class="post-img" href="single.php?id='.$Row['post_id'].'">
                        <img src="admin/upload/'.$Row['post_img'].'"alt=""/>
                    </a>
                    <div class="post-content">
                        <h5><a href="single.php?id='.$Row['post_id'].'">'.$Row['title'].'</a></h5>
                            <span>
                                <i class="fa fa-tags" aria-hidden="true"></i>
                                <a href="category.php?cid='.$Row['category'].'">'.$Row['category_name'].'</a>
                            </span>
                            <span>
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                '.$Row['post_date'].'
                            </span>
                                <a class="read-more" href="single.php?id='.$Row['post_id'].'">read more</a>
                        </div>
                    </div>';
                }
            }
        ?>
    </div>
</div>
<!-- /recent posts box -->
</div>