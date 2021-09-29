<?php include('partials/menu.php'); ?>

<div id="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Old Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current password">

                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" placeholder="New password">

                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm password">

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php

// Check whether the submit button is clicked or not
if (isset($_POST['submit'])) {
    // echo "Clicked";

    // 1. Get the data from form
    $id = $_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    // 2. Check whether the user with current ID and current password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND 
    password='$current_password'";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // User exists and password can be changed
            if ($new_password == $confirm_password) {
                // Update the password
                $sql2 = "UPDATE tbl_admin SET
                 password='$new_password'
                 WHERE id=$id
                 ";

                // Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    // Display success message
                    $_SESSION['change-password'] = "<div class='success'>Password changed successfully</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                } else {
                    $_SESSION['change-password'] = "<div class='error'>Failed to change password</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['password-not-match'] = "<div class='error'>Password did not match</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        } else {
            // User does not exist
            $_SESSION['user-not-found'] = "<div class='error'>Password did not match</div>";
            // Redirect the user
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
    // 3. Check whether the new password and confirm password match or not

    // 4. Change password if all above is true
}

?>


<?php include('partials/footer.php'); ?>