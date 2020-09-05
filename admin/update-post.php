<?php include "header.php"; ?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <form action="save-update-post.php" method="POST" enctype="multipart/form-data" autocomplete="off">
    <?php
        include "DB_Connection.php";
        $Post_ID = $_GET['id'];
        // echo $Post_ID;
        $Fetch_SQL = "SELECT post.post_id, post.title, post.description,post.post_img,
        category.category_name, post.category FROM post 
        LEFT JOIN category ON post.category = category.category_name
        LEFT JOIN user ON post.author = user.user_id 
        WHERE  post_id=$Post_ID";
        $Fetch_Result = mysqli_query($Connect,$Fetch_SQL);
        if(mysqli_num_rows($Fetch_Result)>0)
        {
            while($Row = mysqli_fetch_assoc($Fetch_Result))
            {
                echo'<div class="form-group">
                        <input type="hidden" name="post_id"  class="form-control" value="'.$Row['post_id'].'" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputTile">Title</label>
                        <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="'.$Row['title'].'">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1"> Description</label>
                        <textarea name="postdesc" class="form-control"  required rows="5">'.$Row['description'].'</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputCategory">Category</label>
                        <select class="form-control" name="category" required>
                        ';

                        $Catagory_SQL = "SELECT * FROM category";
                        $Catagory_Result = mysqli_query($Connect,$Catagory_SQL);
                        if(mysqli_num_rows($Catagory_Result)>0)
                        {
                            while($Rows = mysqli_fetch_assoc($Catagory_Result))
                            {
                                if($Row['category']==$Rows['category_id'])
                                {
                                    $Selected = "selected";
                                }
                                else
                                {
                                    $Selected = "";
                                }
                                echo'<option '.$Selected.' value="'.$Rows['category_id'].'">'.$Rows['category_name'].'</option>';
                            }
                        }
                    echo'
                    </select>
                    <input type="hidden" name="old_category" value="'.$Row['category'].'">
                    </div>
                    <div class="form-group">
                        <label for="">Post image</label>
                        <input type="file" name="new-image">
                        <img  src="upload/'.$Row['post_img'].'" height="150px">
                        <input type="hidden" name="old_image" value="'.$Row['post_img'].'">
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary" value="Update" />';
                    // echo $Row['post_img'];
            }
        }
        else
        {
            echo "Error";
        }
    ?>
        </form>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
