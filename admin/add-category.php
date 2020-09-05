<?php 
    include "header.php";
    include "DB_Connection.php";
?>
<?php
    if($_SESSION["user_role"]=='0')
    {
        header("Location: $HostName/admin/post.php");
    }
?>
<?php
    if(isset($_POST['save']))
    {
        $Catagory_Name = mysqli_real_escape_string($Connect,$_POST['cat']);

        $Catagory_Sql = "SELECT category_name FROM `category` WHERE category_name= '$Catagory_Name'";
        $Catagory_Result = mysqli_query($Connect,$Catagory_Sql);
        if(mysqli_num_rows($Catagory_Result) > 0)
        {
            echo '<p style="color:red";text-align:center;margin:10px 0;>Catagory Already Exists !</p>';
        }
        else
        {
            $Catagory_Insert = "INSERT INTO `category` (category_name) VALUES ('$Catagory_Name')";
            
            if(mysqli_query($Connect,$Catagory_Insert))
            {
                header("Location: $HostName/admin/category.php");
            }
            else
            {
                echo '<p style="color:red";text-align:center;margin:10px 0;>Catagory Is Not Insert!</p>';
            }
        }
        // mysqli_close($Connect);
    }
  ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add New Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- /Form End -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>