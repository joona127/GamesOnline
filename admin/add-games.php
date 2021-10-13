<?php include('partials/menu.php'); ?>

<?php
            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType > 1){
              header('location:'.SITEURL.'logout.php');;
            }
    ?>


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
                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                $uploaded_size = $_FILES[ 'image' ][ 'size' ];


                if ($image_name != "") {
                    // Image is selected
                    $arrayVar = explode('.', $image_name);
                    $ext = end($arrayVar);

                    $image_name = "Game-Name-" . rand(0000, 9999) . "." . $ext; // New image name

                    // Upload the image
                    $src = $_FILES['image']['tmp_name'];

                    // Destination path for the image
                    $destination = "../images/games/" . $image_name;

                    if( ( $uploaded_type == "image/jpeg" || $uploaded_type == "image/png" ) && ( $uploaded_size < 1000 ) ){
                        $upload = move_uploaded_file($src, $destination);
                    }else{
                        $upload=false;
                    }

                    
                    if ($upload == false) {
                        // Failed to upload the image
                        $_SESSION['upload'] = "<div class='error'>Failed to upload the image.</div>";
                        header('location:' . SITEURL . 'admin/add-games.php');
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