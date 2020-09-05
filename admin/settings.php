<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
         <div class="row">
             <div class="col-md-12">
                 <h1 class="admin-heading">Website Settings</h1>
             </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                  include "DB_Connection.php";

                  $Setting_SQL = "SELECT * FROM settings";

                  $Setting_Result = mysqli_query($Connect, $Setting_SQL) or die("Error : Setting_SQL");
                  if(mysqli_num_rows($Setting_Result) > 0){
                    while($Row = mysqli_fetch_assoc($Setting_Result)) {
                ?>
                  <!-- Form -->
                  <form  action="save-settings.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="website_name">Website Name</label>
                          <input type="text" name="website_name" value="<?php echo $Row['websitename']; ?>" class="form-control" autocomplete="off" required>
                      </div>
                      <div class="form-group">
                          <label for="logo">Website Logo</label>
                          <input type="file" name="logo">
                          <img src="images/<?php echo $Row['logo']; ?>">
                          <input type="hidden" name="old_logo" value="<?php echo $Row['logo']; ?>" >
                      </div>
                      <div class="form-group">
                          <label for="footer_desc">Footer Description</label>
                          <textarea name="footer_desc" class="form-control" rows="5" required><?php echo $Row['footerdesc']; ?></textarea>
                      </div>
                      <input type="submit" name="submit" class="btn btn-primary" value="Save" required />
                  </form>
                  <!--/Form -->
                  <?php
                      }
                    }
                  ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
