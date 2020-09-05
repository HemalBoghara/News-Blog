<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Users</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-user.php">add user</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Full Name</th>
                        <th>User Name</th>
                        <th>Role</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                    include "DB_Connection.php";
                    $Limit = 3;
                    if(isset($_GET['page']))
                    {
                        $page = $_GET['page'];
                    }
                    else
                    {
                        $page = 1;
                    }

                    // offset = (1 - 1) * 3 =  0;
                    $offset = ($page - 1) * $Limit;
                    // $Desc_Sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT 0,3";
                    $Desc_Sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT $offset,$Limit";
                    $Desc_Result = mysqli_query($Connect,$Desc_Sql) or die("DESC Failed");
                    if(mysqli_num_rows($Desc_Result)>0)
                    {
                        while($Row = mysqli_fetch_assoc($Desc_Result))
                        {
                            echo'
                                <tr>
                                    <td class="id">' . $Row['user_id'] . '</td>
                                    <td>' . $Row['first_name'] . " " . $Row['last_name'] . '</td>
                                    <td>' . $Row['username'] . '</td>
                                    <td>';  
                                            if($Row['role']==1)
                                            {
                                                echo "Admin";
                                            }
                                            else
                                            {
                                                echo "Normal";
                                            } 
                                    echo'</td>
                                    <td class="edit"><a href="update-user.php?id='.$Row['user_id'].'"><i class="fa fa-edit"></i></a></td>
                                    <td class="delete"><a href="delete-user.php?id='.$Row['user_id'].'"><i class="fa fa-trash-o"></i></a></td>
                                </tr>';
                        }
                    }
                    else
                    {
                        echo "<h1 style=color:red;>Empty Table</h1>";
                    }
                    echo '</tbody>
                    </table>';
                ?>
                    <?php
                    $User_SQL = "SELECT * FROM user";
                    $User_Result = mysqli_query($Connect,$User_SQL);
                    if(mysqli_num_rows($User_Result)>0)
                    {
                        $Total_Records = mysqli_num_rows($User_Result);
                        $Total_Page = ceil($Total_Records/$Limit);
                        // echo $Total_Page;
                        echo '<ul class="pagination admin-pagination">';
                        if($page > 1)
                        {
                            echo '<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
                        }
                        // echo $Total_Records;
                        for($i=1;$i<=$Total_Page;$i++)
                        {
                            if($i == $page)
                            {
                                $active = "active";
                            }
                            else
                            {
                                $active = "";
                            }
                            // echo '<li><a>' . $i . '</a></li>';
                            echo '<li class="'.$active.'"><a href="users.php?page='. $i .'">' . $i . '</a></li>';
                        }
                        if($Total_Page > $page)
                        {
                            echo '<li><a href="users.php?page='.($page+1).'">Next</a></li>';
                        }
                        echo'</ul>';
                    }

                ?>
                        <!-- <li class="active"><a>1</a></li> -->

            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>