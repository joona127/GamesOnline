

<?php include('partials/menu.php'); ?>

<?php
ob_start();
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
        <h1>Update Game</h1>

        <br><br>

        <?php

        // Check whether the id is set or not
        if (isset($_GET['id'])) {
            // Get the id and all the other details
            $id = $_GET['id'];
            //Create SQL Query to get all other details
            $sql = "SELECT * FROM tbl_games WHERE id=$id";

            // Execute the query
            $res = mysqli_query($conn, $sql);

            // Count the rows to check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                // Get the data
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $description = $row['description'];
                $price = $row['price'];
                $current_image = $row['image_name'];
                $current_category = $row['category_id'];
                $available = $row['available'];
            } else {
                // Redirect back to the manage games page
                $_SESSION['no-games-found'] = "<div class='error'>Games not found</div>";
                header('location:' . SITEURL . 'admin/manage-games.php');
            }
        } else {
            // Redirect to Manage games page
        }

        ?>

        <form action="" method="POST" enctype="multitype/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                </tr>
                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" value="<?php echo $description; ?>"></textarea>
                    </td>
                </tr>


                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">

                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if ($current_image != "") {
                        ?>
                            <img src="<?php echo SITEURL; ?>images/games/<?php echo $current_image; ?>" width="150px">
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
                    <td>Category: </td>
                    <td>
                        <select name="category">
                            <?php
                            // Query to get active categories
                            $sql2 = "SELECT * FROM tbl_category";
                            // Executing the query
                            $res2 = mysqli_query($conn, $sql2);
                            // Counting the rows
                            $count2 = mysqli_num_rows($res2);

                            if ($count2 > 0) {
                                while ($row2 = mysqli_fetch_assoc($res2)) {
                                    $category_title = $row2['title'];
                                    $category_id = $row2['id'];

                                    // echo "<option value='$category_id'>$category_title</option>";
                            ?>
                                    <option <?php if ($current_category == $category_id) {
                                                echo "Selected";
                                            } ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                            <?php

                                }
                            } else {
                                echo "<option value='0'>Category not available.</option>";
                            }
                            ?>
                        </select>
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
                        <input type="submit" name="submit" value="Update game" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            // Get all the values from the form
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];
            $available = $_POST['available'];

             //SQL INJECTION
    $title = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $title);
    $title = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $title);
    $title = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $title);
    $title = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $title);
    $title = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $title);
    $title = str_replace('=', '', $title);
    $title = str_replace('"', '', $title);
    $title = str_replace(';', '', $title);
    $title = str_replace("'", '', $title);
    $title = str_replace('/', '', $title);
    $title = str_replace('%', '', $title);
    $title = str_replace('|', '', $title);
    $title = str_replace('(', '', $title);
    $title = str_replace(')', '', $title);
    $title = str_replace('.', '', $title);

    //XSS
    $title = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $title);
    $title = htmlspecialchars($title);

    //SQL INJECTION
    $description = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $description);
    $description = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $description);
    $description = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $description);
    $description = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $description);
    $description = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $description);
    $description = str_replace('=', '', $description);
    $description = str_replace('"', '', $description);
    $description = str_replace(';', '', $description);
    $description = str_replace("'", '', $description);
    $description = str_replace('/', '', $description);
    $description = str_replace('%', '', $description);
    $description = str_replace('|', '', $description);
    $description = str_replace('(', '', $description);
    $description = str_replace(')', '', $description);
    $description = str_replace('.', '', $description);

    //XSS
    $description = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $description);
    $description = htmlspecialchars($description);

    //SQL INJECTION
    $price = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $price);
    $price = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $price);
    $price = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $price);
    $price = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $price);
    $price = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $price);
    $price = str_replace('=', '', $price);
    $price = str_replace('"', '', $price);
    $price = str_replace(';', '', $price);
    $price = str_replace("'", '', $price);
    $price = str_replace('/', '', $price);
    $price = str_replace('%', '', $price);
    $price = str_replace('|', '', $price);
    $price = str_replace('(', '', $price);
    $price = str_replace(')', '', $price);
    $price = str_replace('.', '', $price);

    //XSS
    $price = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $price);
    $price = htmlspecialchars($price);


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
                    $image_name = "Game" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/games/" . $image_name;

                    // Finally upload the image
                    if( ( $uploaded_type == "image/jpeg" || $uploaded_type == "image/png" || $uploaded_type == "image/jpg") && ( $uploaded_size < 1000000 ) ){
                        $upload = move_uploaded_file($source_path, $destination_path);
                    }else{
                        $upload=false;
                    }

                    // Check whether the image is uploaded or not
                    if ($upload == false) {
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image</div>";
                        // Redirect back to manage games page
                        header('location:' . SITEURL . 'admin/manage-games.php');
                        die();
                    }

                    // Remove the current image
                    if ($current_image != "") {
                        $remove_path = "../images/games/" . $current_image;
                        $remove = unlink($remove_path);

                        //Check whether the image is removed or not
                        // and if it failed to remove the image display the message and stop the process
                        if ($remove == false) {
                            $_SESSION['failed-remove'] = "<div class='error'>Failed to remove the current image</div>";
                            header('location:' . SITEURL . 'admin/manage-games.php');
                            die();
                        }
                    }
                }
            } else {
                $image_name = $current_image;
            }



            // Update the database
            $sql3 = "UPDATE tbl_games SET
              title = '$title',
              description = '$description',
              price = '$price',
              image_name = '$image_name',
              category_id = '$category',
              available = '$available'
              WHERE id=$id
           ";

            $res3 = mysqli_query($conn, $sql3);


            // Redirect to the manage category with a message
            if ($res3 == true) {
                // Category updated
                $_SESSION['update'] = "<div class='success'>Game updated successfully!</div>";
                header('location:'.SITEURL.'admin/manage-games.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Failed to update game</div>";
                header('location:' . SITEURL . 'admin/manage-games.php');
            }
        }
        ?>
    </div>
</div>



<?php include('partials/footer.php'); ?>