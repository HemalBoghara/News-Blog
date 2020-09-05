<?php
    if($_SESSION["user_role"]=='0')
    {
        header("Location: $HostName/admin/post.php");
    }
?>
<?php
    include "DB_Connection.php";
    $GetId = $_GET['id'];

    $Delete_Sql = "DELETE FROM user WHERE user_id = $GetId";
    $Delete_Result = mysqli_query($Connect,$Delete_Sql);
    if($Delete_Result)
    {
        header("Location: $HostName/admin/users.php");
    }
    else
    {
        echo "<p style='color:red';margin:10px 0 ;>Can't Delete This User Record</p>"."<br>";
    }
    mysqli_close($Connect);
?>