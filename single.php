<?php include 'header.php'; ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <?php
                    include "DB_Connection.php";  

                    $Post_Id = $_GET['id'];

                    // Post Table In Fetch
                    $Fetch_SQL = "SELECT post.title,post.description,post.author,post.post_date,post.category,post.post_img,user.username,category.category_name FROM post LEFT JOIN category ON post.category = category.category_id LEFT JOIN user ON post.author = user.user_id WHERE post_id = $Post_Id";
                    $Fetch_Result = mysqli_query($Connect,$Fetch_SQL);
                    if(mysqli_num_rows($Fetch_Result)>0)
                    {
                        while($Row = mysqli_fetch_assoc($Fetch_Result))
                        {
                            echo'<div class="post-container">
                                    <div class="post-content single-post">
                                        <h3>'.$Row['title'].'</h3>
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
                                        <img class="single-feature-image" src="admin/upload/'.$Row['post_img'].'" alt="" />
                                        <p class="description">
                                        '.$Row['description'].'
                                        </p>
                                    </div>
                                </div>';
                        }
                    }
                  
                  ?>
                <!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>