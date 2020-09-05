<?php
    include "header.php"; 
    include "DB_Connection.php"; 
?>
<?php
    // if($_SESSION["user_role"]=='0')
    // {
    //     header("Location: $HostName/admin/post.php");
    // }
?>
<?php
    if(isset($_POST['save']))
    {
        $FName = mysqli_real_escape_string($Connect,$_POST['fname']);
        $LName = mysqli_real_escape_string($Connect,$_POST['lname']);
        $UserName = mysqli_real_escape_string($Connect,$_POST['user']);
        $Password = mysqli_real_escape_string($Connect,md5($_POST['password']));
        $Role = mysqli_real_escape_string($Connect,$_POST['role']);

        $User_Sql = "SELECT username FROM user WHERE username='$UserName'";
        $User_Result = mysqli_query($Connect,$User_Sql);
        if(mysqli_num_rows($User_Result)>0)
        {
            echo "<p style='color:red'; text-align:center; margin:10px 0;>UserName Already Exist !</p>" . "<br>";
        }
        else
        {
            $Insert_Sql = "INSERT INTO `user` (first_name,last_name,username,password,role) VALUES ('$FName','$LName','$UserName','$Password','$Role')";
            if(mysqli_query($Connect,$Insert_Sql))
            {
                header("Location: $HostName/admin/users.php");
            }
        }
    }
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Add User</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <!-- Form Start -->
                <form action="<?php $_SERVER['PHP_SELF']?>" method="POST" autocomplete="off">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label>User Name</label>
                        <input type="text" name="user" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label>User Role</label>
                        <select class="form-control" name="role" required>
                            <option value="">Select</option>
                            <option value="0">Normal User</option>
                            <!-- <option value="1">Admin</option> -->
                        </select>
                    </div>
                    <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                </form>
                <!-- Form End-->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>