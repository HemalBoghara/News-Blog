<?php
    include "DB_Connection.php";
    // session_start();
    if(isset($_SESSION['username']))
    {
        header("Location: $HostName/admin/post.php");
    }
?>
<!doctype html>
<html>
   <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>ADMIN | Login</title>
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>

    <body>
        <div id="wrapper-admin" class="body-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-4 col-md-4">
                        <img class="logo" src="images/news.jpg">
                        <h3 class="heading">Admin</h3>
                        <!-- Form Start -->
                        <form  action="<?php $_SERVER['PHP_SELF']?>" method ="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="" required>
                            </div>
                            <input type="submit" name="login" class="btn btn-primary" value="login" />
                        </form>
                        <!-- /Form  End -->
                        <?php
                        
                            if(isset($_POST['login']))
                            {
                                include "DB_Connection.php";
                                $UserName = mysqli_real_escape_string($Connect,$_POST['username']);
                                $PassWord = md5($_POST['password']);
                                // print_r($_POST);
                                // exit();
                                // $User_SQL = "SELECT user_id,username,password,role FROM `user` WHERE username='$UserName'";
                                // $User_Result = mysqli_query($Connect,$User_SQL);
                                
                                
                                
                                $User_SQL = "SELECT user_id,username,role FROM `user` WHERE username ='$UserName' AND password ='$PassWord'";
                                $User_Result = mysqli_query($Connect,$User_SQL) or die("User_SQL Failed");
                                
                                if(mysqli_num_rows($User_Result)>0)
                                {
                                    while($Row = mysqli_fetch_assoc($User_Result))
                                    {
                                        session_start();
                                        $_SESSION["username"] = $Row['username'];
                                        $_SESSION["user_id"] = $Row['user_id'];
                                        $_SESSION["user_role"] = $Row['role'];

                                        header("Location: $HostName/admin/post.php");
                                        // $Row = mysqli_fetch_assoc($User_Result);
                                        // print_r($Row);
                                        // if($PassWord==$Row['password'])
                                        // {
                                        /*    }
                                            else
                                            {
                                                echo '<div class="alert alert-danger">Password Not Match</div>';
                                            }
                                        */
                                    }
                                    
                                }
                                else
                                {
                                    echo '<div class="alert alert-danger">This User Name To Not Create Account</div>';
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>