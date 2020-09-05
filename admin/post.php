<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
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
                            $offSet = ($page - 1) * $Limit;

                            if($_SESSION['user_role']=='1')
                            {
                                $Select_SQL = "SELECT post.post_id,post.title,post.description,post.post_date,category.category_name,user.username,post.category FROM post 
                                LEFT JOIN category ON post.category = category.category_id 
                                LEFT JOIN user ON post.author = user.user_id
                                ORDER BY post.post_id DESC LIMIT $offSet,$Limit";
                            }
                            elseif($_SESSION['user_role']=='0')
                            {
                                $Select_SQL = "SELECT post.post_id,post.title,post.description,post.post_date,category.category_name,user.username,post.category FROM post 
                                LEFT JOIN category ON post.category = category.category_id 
                                LEFT JOIN user ON post.author = user.user_id
                                WHERE post.author = {$_SESSION['user_id']}
                                ORDER BY post.post_id DESC LIMIT $offSet,$Limit";
                            }
                            $Select_Result = mysqli_query($Connect,$Select_SQL);
                            if(mysqli_num_rows($Select_Result)>0)
                            {
                                while($Row = mysqli_fetch_assoc($Select_Result))
                                {
                                    echo'<tr>
                                            <td class="id">'.$Row['post_id'].'</td>
                                            <td>'.$Row['title'].'</td>
                                            <td>'.$Row['category_name'].'</td>
                                            <td>'.$Row['post_date'].'</td>
                                            <td>'.$Row['username'].'</td>
                                            <td class="edit"><a href="update-post.php?id='.$Row['post_id'].'"><i class="fa fa-edit"></i></a></td>
                                            <td class="delete"><a href="delete-post.php?id='.$Row['post_id'].'&cid='.$Row['category'].'"><i class="fa fa-trash-o"></i></a></td>
                                        </tr>';
                                }
                            }
                            else
                            {
                                echo '<div class="alert alert-danger">Empty Record</div>';
                            }
                          ?>
                    </tbody>
                </table>
                <?php
                if($_SESSION['user_role']=='1')
                {
                    $Page_SQL = "SELECT post.post_id,post.title,post.category,post.post_date,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category = category.category_id 
                    LEFT JOIN user ON post.author = user.user_id";
                }
                elseif($_SESSION['user_role']=='0')
                {
                    $Page_SQL = "SELECT post.post_id,post.title,post.category,post.post_date,category.category_name,user.username FROM post 
                    LEFT JOIN category ON post.category = category.category_id 
                    LEFT JOIN user ON post.author = user.user_id
                    WHERE post.author = {$_SESSION['user_id']}";
                }
                    // $Page_SQL = "SELECT * FROM post";
                    $Page_Result = mysqli_query($Connect,$Page_SQL) or die("Error : Page_SQL");
                    if(mysqli_num_rows($Page_Result)>0)
                    {
                        $Total_Record = mysqli_num_rows($Page_Result);
                        $Total_Page = ceil($Total_Record/$Limit);
                        echo '<ul class="pagination admin-pagination">';
                        if($page > 1)
                        {
                            echo '<li><a href="post.php?page='.($page-1).'">Prev</a></li>';
                        }
                        for($i=1;$i<=$Total_Page;$i++)
                        {
                            if($i==$page)
                            {
                                $active = "active";
                            }
                            else
                            {
                                $active = "";
                            }
                            echo '<li class="'.$active.'"><a href="post.php?page='. $i .'">'.$i.'</a></li>';
                        }
                        if($Total_Page > $page)
                        {
                            echo '<li><a href="post.php?page='.($page+1).'">Next</a></li>';
                        }
                        echo '</ul>';
                    }      
                  ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>