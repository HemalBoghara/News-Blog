<?php include "header.php"; ?>
<?php
    if($_SESSION["user_role"]=='0')
    {
        header("Location: $HostName/admin/post.php");
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="adin-heading"> Update Category</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
                    <?php
                        $Get_Id = $_GET['id'];
                        include "DB_Connection.php";
                        $Fetch_Catagory_SQL = "SELECT * FROM `category` WHERE category_id=$Get_Id";
                        $Fetch_Catagory_Result = mysqli_query($Connect,$Fetch_Catagory_SQL);
                        if(mysqli_num_rows($Fetch_Catagory_Result)>0)
                        {
                            while($Row = mysqli_fetch_assoc($Fetch_Catagory_Result))
                            {
                                echo'<div class="form-group">
                                        <input type="hidden" name="cat_id" class="form-control" value="'. $Row['category_id'] .'" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" name="cat_name" class="form-control" value="'. $Row['category_name'] .'" placeholder="" required>
                                    </div>
                                        <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                                    </form>';
                            }
                        }
                        // mysqli_close($Connect);
                    ?>
            </div>
            <?php
                if(isset($_POST['sumbit']))
                {
                    // DataBase Connection
                    include "DB_Connection.php";

                    $Update_Catagory_Id = mysqli_real_escape_string($Connect,$_POST['cat_id']);
                    $Update_Catagory_Name = mysqli_real_escape_string($Connect,$_POST['cat_name']);

                    $Catagory_Exists_SQL = "SELECT category_name FROM `category` WHERE category_name= '$Update_Catagory_Name'";
                    $Catagory_Exists_Result = mysqli_query($Connect,$Catagory_Exists_SQL);

                    if(mysqli_num_rows($Catagory_Exists_Result)>0)
                    {
                        echo '<p style="color:red";text-align:center;margin:10px 0;>Catagory Already Exists !</p>';
                    }
                    else
                    {
                        // Update A Catagory 
                        $Update_Catagory_SQL = "UPDATE `category` SET category_name='$Update_Catagory_Name' WHERE category_id = $Update_Catagory_Id";
                        if(mysqli_query($Connect,$Update_Catagory_SQL))
                        {
                            header("Location: $HostName/admin/category.php");
                        }
                    }

                }          
            ?>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>