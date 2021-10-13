<?php include('partials/menu.php'); ?>

<?php
            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType > 1){
              header('location:'.SITEURL.'admin/logout.php');;
            }
        ?>
        

<div id="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

        // Check whether the id is set or not
        if (isset($_GET['id'])) {
            // Get the id and all the other details
            $id = $_GET['id'];
            //Create SQL Query to get all other details
            $sql = "SELECT * FROM tbl_category WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Get the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $available = $row['available'];
            } else {
                // Redirect back to the manage category page
                $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        } else {
            // Redirect to Manage Category page
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="">
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
                        <?php
                            // Display the image
                        } else {
                            // Display the message
                            echo "<div class='error'>Image not added.</div>";
                        }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        New Image:
                    </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Available: </td>
                    <td>
                        <input <?php if ($available == "Yes") {
                                    echo "checked";
                                } ?> type="radio" name="available" value="Yes"> Yes
                        <input <?php if ($available == "No") {
                                    echo "checked";
                                } ?> type="radio" name="available" value="No"> No
                    </td>

                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get all the values from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            //$current_image = $_POST['image_name'];
            $available = $_POST['available'];


            // Updating the new image if selected

            if (isset($_FILES['image']['name'])) {
                $image_name = $_FILES['image']['name'];
                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                $uploaded_size = $_FILES[ 'image' ][ 'size' ];

                if ($image_name != "") {
                    // Upload the new image and remove the current image
                    // Auto rename our image
                    // Get the extension or our image(jpg, png, gif)
                    $ext = end(explode('.', $image_name));

                    // Rename the image
                    $image_name = "Games_category" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Finally upload the image
                    if( ( $uploaded_type == "image/jpeg" || $uploaded_type == "image/png" ) && ( $uploaded_size < 2000 ) ){
                        $upload = move_uploaded_file($source_path, $destination_path);
                    }else{
                        $upload=false;
                    }

                    // Check whether the image is uploaded or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                        // Redirect back to add category page
                        header('location:' . SITEURL . 'admin/add-category.php');
                        die();
                    }

                    // Remove the current image
                    if ($current_image != "") {
                        $remove_path = "../images/category/" . $current_image;
                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        // and if it failed to remove the image display the message and stop the process
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image</div>";
                            header('location:' . SITEURL . 'admin/manage-category.php');
                            die();
                        }
                    }
                } else {
                    $image_name = $current_image;
                }
            } else {
                $image_name = $current_image;
            }

            // Update the database
            $sql2 = "UPDATE tbl_category SET
              title = '$title',
              image_name = '$image_name',
              available = '$available'
              WHERE id=$id
           ";

            $res2 = mysqli_query($conn, $sql2);


            // Redirect to the manage category with a message
            if ($res2 == true) {
                // Category updated
                $_SESSION['update'] = "<div class='success'>Category updated successfully!</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                header('location:' . SITEURL . 'admin/manage-category.php');
            }
        }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>