<?php include('partials/menu.php'); ?>

<div id="main-content">
  <div class="wrapper">
    <h1>Update Admin</h1>

    <br><br>

    <?php

    // 1. Get the ID of selected admin
    $id = $_GET['id'];

    // 2. Create SQL Query to get the details
    $sql = "SELECT * FROM tbl_admin WHERE id=$id";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check whether the query is executed or not
    if ($res == true) {
      $count = mysqli_num_rows($res);

      if ($count == 1) {
        // echo "Admin available";
        $row = mysqli_fetch_assoc($res);

        $full_name = $row['full_name'];
        $username = $row['username'];
      } else {
        header('location:' . SITEURL . 'admin/manage-admin.php');
      }
    }

    ?>

    <form action="" method="POST">

      <table class="tbl-30">
        <tr>
          <td>Full name: </td>
          <td>
            <input type="text" name="full_name" value="<?php echo $full_name; ?>">
          </td>
        </tr>

        <tr>
          <td>Username: </td>
          <td>
            <input type="text" name="username" value="<?php echo $username; ?>">
          </td>
        </tr>

        <tr>
          <td colspan="2">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
          </td>
        </tr>

      </table>



    </form>

  </div>

</div>

<?php

// Check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
  // echo "Button clicked";
  //Get all the values from form to update
  $id = $_POST['id'];
  $full_name = $_POST['full_name'];
  $username = $_POST['username'];

  //SQL INJECTION
  $full_name = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $full_name);
  $full_name = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $full_name);
  $full_name = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $full_name);
  $full_name = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $full_name);
  $full_name = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $full_name);
  $full_name = str_replace('=', '', $full_name);
  $full_name = str_replace('"', '', $full_name);
  $full_name = str_replace(';', '', $full_name);
  $full_name = str_replace("'", '', $full_name);
  $full_name = str_replace('/', '', $full_name);
  $full_name = str_replace('%', '', $full_name);
  $full_name = str_replace('|', '', $full_name);
  $full_name = str_replace('(', '', $full_name);
  $full_name = str_replace(')', '', $full_name);
  $full_name = str_replace('.', '', $full_name);

  //XSS
  $full_name = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $full_name);
  $full_name = htmlspecialchars($full_name);

  //SQL INJECTION
  $username = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $username);
  $username = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $username);
  $username = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $username);
  $username = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $username);
  $username = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $username);
  $username = str_replace('=', '', $username);
  $username = str_replace('"', '', $username);
  $username = str_replace(';', '', $username);
  $username = str_replace("'", '', $username);
  $username = str_replace('/', '', $username);
  $username = str_replace('%', '', $username);
  $username = str_replace('|', '', $username);
  $username = str_replace('(', '', $username);
  $username = str_replace(')', '', $username);
  $username = str_replace('.', '', $username);

  //XSS
  $username = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $username);
  $username = htmlspecialchars($username);

  //SQL INJECTION
  $password = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $password);
  $password = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $password);
  $password = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $password);
  $password = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $password);
  $password = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $password);
  $password = str_replace('=', '', $password);
  $password = str_replace('"', '', $password);
  $password = str_replace(';', '', $password);
  $password = str_replace("'", '', $password);
  $password = str_replace('/', '', $password);
  $password = str_replace('%', '', $password);
  $password = str_replace('|', '', $password);
  $password = str_replace('(', '', $password);
  $password = str_replace(')', '', $password);
  $password = str_replace('.', '', $password);

  //XSS
  $password = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $password);
  $password = htmlspecialchars($password);

  //Create SQL Query to update admin
  $sql = "UPDATE tbl_admin SET 
  full_name = '$full_name',
  username = '$username'
  WHERE id='$id'
  ";

  // Execute the Query
  $res = mysqli_query($conn, $sql);

  if ($res == true) {
    $_SESSION['update'] = "<div class='success'>Admin updated succesfully.</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
  } else {
    $_SESSION['update'] = "<div class='error'>Failed to update Admin</div>";
    header('location:' . SITEURL . 'admin/manage-admin.php');
  }
}


?>




<?php include('partials/footer.php'); ?>