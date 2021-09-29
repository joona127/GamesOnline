<?php include('partials/menu.php'); ?>

<div id="main-content">
    <div class="wrapper">
        <h1>Add games</h1>

        <br><br>

        <?php

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Game title">

                    </td>
                </tr>
                <tr>
                    <td>
                        Description:
                    </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Description of the game"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">

                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">

                    </td>
                </tr>
                <tr>
                    <td> Category:
                    </td>
                    <td>
                        <select name="category">

                            <?php
                            // Create PHP Code to display categories from Database
                            // 1. Create SQL to get all the active categories from the database
                            $sql = "SELECT * FROM tbl_category";

                            $res = mysqli_query($conn, $sql);

                            // Count rows to check whether we have categories or not
                            $count = mysqli_num_rows($res);

                            if ($count > 0) {

                                while ($row = mysqli_fetch_assoc($res)) {
                                    // Get the details of categories
                                    $id = $row['id'];
                                    $title = $row['title'];
                            ?>
                                    <option value="<?php echo $id; ?>"><?php echo $title; ?></option>
                                <?php
                                }
                            } else {
                                ?>
                                <option value="0">No Categories found</option>
                            <?php
                            }

                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Available: </td>
                    <td>
                        <input type="radio" name="available" value="Yes"> Yes
                        <input type="radio" name="available" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Game" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <?php

        // Check whether the button is clicked or not
        if (isset($_POST['submit'])) {
            // echo "Clicked!";
            // 1. Get the data from the form
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

            // Check whether radio button for featured and active are checked or not
            if (isset($_POST['available'])) {
                $available = $_POST['available'];
            } else {
                $available = "No";
            }




            // 2. Upload the image if selected
            if (isset($_FILES['image']['name'])) {
                // Get the details of the selected image
                $image_name = $_FILES['image']['name'];

                if ($image_name != "") {
                    // Image is selected
                    $arrayVar = explode('.', $image_name);
                    $ext = end($arrayVar);

                    $image_name = "Game-Name-" . rand(0000, 9999) . "." . $ext; // New image name

                    // Upload the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image
                    $destination = "../images/games/" . $image_name;

                    $upload = move_uploaded_file($src, $destination);

                    if ($upload == false) {
                        // Failed to upload the image
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>";
                        header('location:' . SITEURL . 'admin/add-food.php');
                        die(); // Stop the process
                    }
                }
            } else {
                $image_name = "";
            }

            // 3. Insert into the database

            // SQL Query
            $sql2 = "INSERT INTO tbl_games SET
   title = '$title',
   description = '$description',
   price = $price,
   image_name = '$image_name',
   category_id = $category,
   available = '$available'
   ";

            // Execute the query
            $res2 = mysqli_query($conn, $sql2);

            if ($res2 == true) {
                // Data successfull
                $_SESSION['add'] = "<div class='success'>Game added succesfully.</div>";
                header('location:' . SITEURL . 'admin/manage-games.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Failed to add game.</div>";
                header('location:' . SITEURL . 'admin/manage-games.php');
            }
        }

        ?>
    </div>

</div>


<?php include('partials/footer.php'); ?>