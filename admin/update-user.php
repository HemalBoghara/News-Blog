<?php include "header.php"; ?>
<?php include "DB_Connection.php"; ?>
<?php
    if($_SESSION["user_role"]=='0')
    {
        header("Location: $HostName/admin/post.php");
    }
?>
<?php
    if(isset($_POST['submit']))
    {
        $UserId = mysqli_real_escape_string($Connect,$_POST['user_id']);
        $FName = mysqli_real_escape_string($Connect,$_POST['f_name']);
        $LName = mysqli_real_escape_string($Connect,$_POST['l_name']);
        $UserName = mysqli_real_escape_string($Connect,$_POST['username']);
        $Role = mysqli_real_escape_string($Connect,$_POST['role']);
        // $PassWord = mysqli_real_escape_string($Connect,$Row['first_name']);

        $Update_Sql = "UPDATE user SET first_name='$FName',last_name='$LName',username='$UserName',role='$Role' WHERE user_id = $UserId";
        
        $Update_Result = mysqli_query($Connect,$Update_Sql);
        if($Update_Result)
        {
            header("Location: $HostName/admin/users.php");
        }
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                
                <?php
                    $GetId = $_GET['id'];
                        
                    $User_Sql = "SELECT * FROM `user` WHERE user_id=$GetId";
                    $User_Result = mysqli_query($Connect,$User_Sql);
                        if(mysqli_num_rows($User_Result)>0)
                        {
                            while($Row = mysqli_fetch_assoc($User_Result))
                            {
                                echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST">
                                <div class="form-group">
                                    <input type="hidden" name="user_id" class="form-control" value="'.$Row['user_id'].'" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" name="f_name" class="form-control" value="'.$Row['first_name'].'" placeholder=""
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" name="l_name" class="form-control" value="'.$Row['last_name'].'" placeholder=""
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" value="'.$Row['username'].'" placeholder=""
                                        required>
                                </div>
                                <div class="form-group">
                                    <label>User Role</label>
                                    <select class="form-control" name="role" value="'.$Row['role'].'">';
                                        if($Row['role']==1)
                                        {
                                        echo '<option value="0">normal User</option>
                                        <option value="1" selected>Admin</option>';
                                        }
                                        else
                                        {
                                        echo '<option value="0" selected>normal User</option>
                                        <option value="1">Admin</option>';
                                        }
                                    echo'</select>
                                 </div>
                                <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                            </form>';
                        }
                    }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>