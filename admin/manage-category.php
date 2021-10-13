<?php
include('partials/menu.php');
?>
<div id="main-content">
  <div class="wrapper">
    <h1 class="text-center">Categories</h1>

    <br />
    <br />

    <?php if (isset($_SESSION['add-category'])) {
      echo $_SESSION['add-category']; // displaying session message
      unset($_SESSION['add-category']); //Removing session message
    }
    if (isset($_SESSION['delete-category'])) {
      echo $_SESSION['delete-category'];
      unset($_SESSION['delete-category']);
    }

    if (isset($_SESSION['no-category-found'])) {
      echo $_SESSION['no-category-found'];
      unset($_SESSION['no-category-found']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['upload'])) {
      echo $_SESSION['upload'];
      unset($_SESSION['upload']);
    }

    if (isset($_SESSION['failed-remove'])) {
      echo $_SESSION['failed-remove'];
      unset($_SESSION['failed-remove']);
    }

    ?>

    <br><br>

    <!-- Button to add category -->
    <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
    <br />
    <br />



    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Image</th>
        <th>Available</th>
        <th>Actions</th>
      </tr>

      <?php
      // Query to get all categories
      $sql = "SELECT * FROM tbl_category";

      // Execute the query
      $res = mysqli_query($conn, $sql);

      // Check whether the query is ecexuted or not
      if ($res == TRUE) {
        $count = mysqli_num_rows($res);

        $sn = 1;
        // Check the number of rows
        if ($count > 0) {
          while ($rows = mysqli_fetch_assoc($res)) {
            // Using the while loop to get all the data from database
            $id = $rows['id'];
            $title = $rows['title'];
            $image_name = $rows['image_name'];
            $available = $rows['available'];


      ?>
            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $title; ?></td>
              <td>
                <?php
                // Check whether the image is available or not
                if ($image_name != "") {
                  // Display the image
                ?>
                  <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">

                <?php
                } else {
                  // Display the message
                  echo "<div class='error'>Image not added</div>";
                }
                ?>

              </td>
              <td><?php echo $available; ?></td>


              <td>
    <?php
            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType <= 1){
              echo '<a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>" class="btn-danger">Delete Category</a>';
            }
    ?>
                
              </td>
            </tr>


          <?php
          }
        } else {
          ?>
          <tr>
            <td colspan="6">
              <div class="error">No category added.</div>
            </td>
          </tr>

      <?php
        }
      }
      ?>




    </table>

  </div>

</div>

<?php
include('partials/footer.php');
?>