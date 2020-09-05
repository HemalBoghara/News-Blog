<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
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
                            $offSet = ($page - 1) * $Limit;
                            // $Catagory_Select_SQl = "SELECT * FROM category ORDER BY category_id DESC LIMIT $offSet,$Limit";
                            $Catagory_Select_SQl = "SELECT * FROM category ORDER BY category_id ASC LIMIT $offSet,$Limit";
                            $Catagory_Select_Result = mysqli_query($Connect,$Catagory_Select_SQl) or die("Catagory_Select_Result");
                            if(mysqli_num_rows($Catagory_Select_Result)>0)
                            {
                                while($Row = mysqli_fetch_assoc($Catagory_Select_Result))
                                {
                                echo'<tr>
                                        <td class="id">'. $Row['category_id'] .'</td>
                                        <td>' . $Row['category_name'] . '</td>
                                        <td>' . $Row['post'] . '</td>
                                        <td class="edit"><a href="update-category.php?id='.$Row['category_id'].'"><i class="fa fa-edit"></i></a></td>
                                        <td class="delete"><a href="delete-category.php?id='.$Row['category_id'].'"><i class="fa fa-trash-o"></i></a></td>
                                    </tr>';
                                }
                            }
                            else
                            {
                                echo '<h2 style="color:red";>Table Is Empty</h2>';
                            }
                            echo'</tbody>
                        </table>';
                        ?>
                        <?php
                
                    $Catagory_Select_SQL = "SELECT * FROM category";
                    $Catagory_Select_Result = mysqli_query($Connect,$Catagory_Select_SQL) or die("Catagory_Select_Result");

                    if(mysqli_num_rows($Catagory_Select_Result)>0)
                    {
                        $Total_Record = mysqli_num_rows($Catagory_Select_Result);
                        $Total_page = ceil($Total_Record/$Limit);
                        echo '<ul class="pagination admin-pagination">';
                        if($page > 1)
                        {
                            echo '<li><a href="category.php?page='.($page-1).'">Prev</a></li>';
                        }
                        for($i=1;$i<=$Total_page;$i++)
                        {
                            if($i == $page)
                            {
                                $active = "active";
                            }
                            else
                            {
                                $active = "";
                            }
                            echo '<li class="'.$active.'"><a href="category.php?page='.$i.'">'.$i.'</a></li>';
                        }
                        if($Total_page > $page)
                        {
                            echo '<li><a href="category.php?page='.($page+1).'">Next</a></li>';
                        }
                        echo '</ul>';
                    }
                ?>
                        <!-- <li class="active"><a>1</a></li> -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>