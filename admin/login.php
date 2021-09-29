<?php
include('../config/constants.php');
?>



<html>

<head>
    <title>Login - Food Order System</title>
    <link rel="stylesheet" href="../css/admin.css">
</head>

<body>
    <div class="login">
        <h1 class="text-center">Login</h1><br><br>

        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>

        <br><br>

        <!-- Login form starts here -->

        <form action="" method="POST" class="text-center">
            Username: <br>
            <input type="text" name="username" placeholder="Enter username" class="login-text"> <br><br>
            Password: <br>
            <input type="password" name="password" placeholder="Enter password" class="login-text"><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary">


            <!-- Login form ends here -->

            <p class="text-center">Created by Joona Sorjonen</p>
    </div>
</body>

</html>

<?php

// Check whether submit button is clicked or not
if (isset($_POST['submit'])) {
    // Process for login
    // 1. Get the data from form
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    // 2. SQL to check whether the user with username and
    // password exists or not
    $sql = "SELECT * FROM tbl_admin WHERE username = '$username' AND password = '$password'";

    // 3. Execute the query
    $res = mysqli_query($conn, $sql);

    // 4. Count rows to check whether the user exists or not
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        // User available and login success
        $_SESSION['login'] = "<div class='success'>Login successful</div>";
        $_SESSION['user'] = $username; // This is to check is the user logged out succesfully or not
        // Redirect to home page
        header('location:' . SITEURL . 'admin/');
    } else {
        // User not available and login failed
        $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect. Try again</div>";
        // Redirect to login.php
        header('location:' . SITEURL . 'admin/login.php');
    }
}





?>