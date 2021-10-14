<?php include('partials/menu.php'); ?>

<?php
ob_start();
            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType > 0){
              header('location:'.SITEURL.'admin/logout.php');;
            }
    ?>

<div id="main-content">
    <div class="wrapper">
        <h1>Add Admin</h1>

        <br><br>

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Full Name: </td>
                    <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td><input type="text" name="username" placeholder="Your username"></td>
                </tr>
                <tr>
                    <td>Password: </td>
                    <td><input type="password" name="password" placeholder="Your password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">

                    </td>
                </tr>

            </table>

        </form>

    </div>


</div>


<?php include('partials/footer.php'); ?>

<?php
// Process the value from the form and save it in the db

// Check whether the submit button is clicked or not

if (isset($_POST['submit'])) {
    // Button clicked 
    // echo "Button clicked";

    // Get the data from form
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']); //Password Encryption with MD5

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

    //2. SQL Query to save data into the database
    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password',
    userType=1
    ";

    // 3. Execute query and save data in database
    $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    // 4. Check whether the data is inserted or not and
    // display appropriate message



    if ($res == TRUE) {
        // echo "Data inserted";
        // Create a session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin added succesfully</div>";
        //Redirect page to manage admin
        header("location:" . SITEURL . 'admin/manage-admin.php');
    } else {
        // echo "Failed";
        // Create a session variable to display message
        $_SESSION['add'] = "<div class='error'>Failed to add Admin</div>";
        //Redirect page to add admin
        header("location:" . SITEURL . 'admin/add-admin.php');
    }
}

?>