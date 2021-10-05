<?php
include('partials/menu.php');
?>



<div id="main-content">
  <div class="wrapper">
    <h1 class="text-center">Admin page</h1>
    <br />
    <br />

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add']; // displaying session message
      unset($_SESSION['add']); //Removing session message
    }
    if (isset($_SESSION['delete'])) {
      echo $_SESSION['delete'];
      unset($_SESSION['delete']);
    }

    if (isset($_SESSION['update'])) {
      echo $_SESSION['update'];
      unset($_SESSION['update']);
    }

    if (isset($_SESSION['user-not-found'])) {
      echo $_SESSION['user-not-found'];
      unset($_SESSION['user-not-found']);
    }

    if (isset($_SESSION['password-not-match'])) {
      echo $_SESSION['password-not-match'];
      unset($_SESSION['password-not-match']);
    }

    if (isset($_SESSION['change-password'])) {
      echo $_SESSION['change-password'];
      unset($_SESSION['change-password']);
    }



    ?>

    <br><br><br>


    <?php
            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType == 1){
              echo '<a href="add-admin.php" class="btn-primary">Add Admin</a>
              <br />
              <br />';
            }
    ?>

    <!-- Button to add Admin -->
    



    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Full Name</th>
        <th>Username</th>
        <th>Actions</th>
      </tr>

      <?php
      // Query to get all admins
      $sql = "SELECT * FROM tbl_admin";
      // Execute the query
      $res = mysqli_query($conn, $sql);

      $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
      $res2 = mysqli_query($conn, $sql2);
      if ($res2 == TRUE){
        $rows2 = mysqli_fetch_assoc($res2);
        $userType = $rows2['userType'];
      }



      // Check whether the query is executed or not
      if ($res == TRUE) {
        // Count rows to check whether we have data in database or not
        $count = mysqli_num_rows($res); // Function to get all the rows in database

        $sn = 1;
        // Check the num of rows
        if ($count > 0) {
          while ($rows = mysqli_fetch_assoc($res)) {
            // Using while loop to get all the data from database
            if($_SESSION['user'] == $rows['username']  || $userType == 1){
              $id = $rows['id'];
              $full_name = $rows['full_name'];
              $username = $rows['username'];
              //$username = $userType;

            // display the values in our table
      ?>


            <tr>
              <td><?php echo $sn++; ?></td>
              <td><?php echo $full_name; ?></td>
              <td><?php echo $username; ?></td>
              <td>
                <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
              </td>
            </tr>




      <?php

            }
            

          }
        } else {
        }
      }

      ?>



    </table>
  </div>

</div>
<?php
include('partials/footer.php');
?>