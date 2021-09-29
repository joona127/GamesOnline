<?php
include('partials/menu.php');
?>
<div id="main-content">
  <div class="wrapper">
    <h1 class="text-center">Games</h1>

    <br />
    <br />

    <!-- Button to add Admin -->
    <a href="<?php echo SITEURL; ?>admin/add-games.php" class="btn-primary">Add Games</a>
    <br />
    <br />

    <?php
    if (isset($_SESSION['add'])) {
      echo $_SESSION['add'];
      unset($_SESSION['add']);
    }

    if (isset($_SESSION['delete-games'])) {
      echo $_SESSION['delete-games'];
      unset($_SESSION['delete-games']);
    }
    ?>



    <table class="tbl-full">
      <tr>
        <th>S.N.</th>
        <th>Title</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
        <th>Available</th>
        <th>Actions</th>
      </tr>

      <?php
      // Create a SQL Query to get all the food
      $sql = "SELECT * FROM tbl_games";

      // Execute the query
      $res = mysqli_query($conn, $sql);

      $count = mysqli_num_rows($res);

      // Number variable for id
      $sn = 1;

      // Count rows to check do we have food or not
      if ($count > 0) {
        while ($rows = mysqli_fetch_assoc($res)) {
          $id = $rows['id'];
          $title = $rows['title'];
          $description = $rows['description'];
          $price = $rows['price'];
          $image_name = $rows['image_name'];
          $available = $rows['available'];
      ?>
          <tr>
            <td><?php echo $sn++; ?></td>
            <td><?php echo $title; ?></td>
            <td><?php echo $description; ?></td>
            <td><?php echo $price; ?>€</td>
            <td>
              <?php
              if ($image_name == "") {
                echo "<div class='error'>Image is not added.</div>";
              } else {
              ?>
                <img src="<?php echo SITEURL; ?>/images/games/<?php echo $image_name; ?>" width="100px">

              <?php
              }
              ?>
            </td>
            <td><?php echo $available; ?></td>
            <td>
              <a href="<?php echo SITEURL; ?>admin/update-games.php?id=<?php echo $id; ?>" class="btn-secondary">Update Game</a>
              <a href="<?php echo SITEURL; ?>admin/delete-games.php?id=<?php echo $id; ?>" class="btn-danger">Delete Game</a>


            </td>
          </tr>
      <?php
        }
      } else {
        echo "<tr><td colspan='7' class='error'>No games added.</td></tr>";
      }
      ?>

    </table>

  </div>

</div>

<?php
include('partials/footer.php');
?>