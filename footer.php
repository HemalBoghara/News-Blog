<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <?php
                    
                    $SQL = "SELECT * FROM settings";
                    $Result = mysqli_query($Connect,$SQL) or die("Error: SQL");
                    if(mysqli_num_rows($Result)>0)
                    {
                        while($Row = mysqli_fetch_assoc($Result))
                        {
                            echo'<span>'.$Row['footerdesc'].'</span>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
