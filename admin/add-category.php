<?php include('partials/menu.php');

?>

<?php 
ob_start();
?>


<div id="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>

        <br><br>

        <?php if (isset($_SESSION['add'])) {

            echo $_SESSION['add']; // displaying session message
            unset($_SESSION['add']); //Removing session message
        }

        ?>

        <?php if (isset($_SESSION['upload'])) {

            echo $_SESSION['upload']; // displaying session message
            unset($_SESSION['upload']); //Removing session message
        }

        ?>

        <br><br>

        <!-- Add Category Form starts -->

        <form action="" method="POST" enctype="multipart/form-data">

            <table id="category" class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">

                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Available:</td>
                    <td>
                        <input type="radio" name="available" value="Yes">
                        <label for="yes">Yes</label>

                        <input type="radio" name="available" value="No">
                        <label for="no">No</label>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        <!-- Add Category Form ends -->


        <?php


        // Check whether the button is clicked or not
        if (isset($_POST['submit'])) {

            //  echo "Button Clicked";

            // Get the data from the form
            $title = $_POST['title'];
            $available = $_POST['available'];


            if (isset($_FILES['image']['name'])) {
                // Upload the image
                $image_name = $_FILES['image']['name'];
                $uploaded_name = $_FILES[ 'image' ][ 'name' ];
                $uploaded_type = $_FILES[ 'image' ][ 'type' ];
                $uploaded_size = $_FILES[ 'image' ][ 'size' ];

                //Upload the image only it is selected
                if ($image_name != "") {
                    // Auto rename our image
                    // Get the extension or our image(jpg, png, gif)
                    $arrayVar = explode('.', $image_name);
                    $ext = end($arrayVar);
                    // $ext = (explode('.', $image_name));


                    // Rename the image
                    $image_name = "Games_category" . rand(000, 999) . '.' . $ext;
                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category/" . $image_name;

                    // Finally upload the image
                    if( ( $uploaded_type == "image/jpeg" || $uploaded_type == "image/png" || $uploaded_type == "image/jpg") && ( $uploaded_size < 1000000 ) ){
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
                }
            } else {
                // Don't upload the image and set the image_name value as blank
                $image_name = "";
            }

            // SQL Query to save data into the database
            $sql = "INSERT INTO tbl_category SET
  title='$title',
  image_name='$image_name',
  available='$available'
  
  ";

            // Execute the query and save data in the database
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

            // Check whether the data is inserted or not and display appropriate message

            if ($res == TRUE) {
                // Create a session variable to display message in the website
                $_SESSION['add-category'] = "<div class='success'>Category added succesfully</div>";

                // Redirect page to manage category
                header("location:" . SITEURL . 'admin/manage-category.php');
            } else {
                $_SESSION['add-category'] = "<div class='error'>Failed to add a category</div>";

                header("location:" . SITEURL . 'admin/add-category.php');
            }
        }

        ?>

    </div>


</div>

<?php include('partials/footer.php'); ?>