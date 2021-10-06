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

    //$username = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $username);
    //$password = mysqli_real_escape_string($GLOBALS["___mysqli_ston"], $password);


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
    
    
    $password = preg_replace('/s(.*)e(.*)l(.*)e(.*)c(.*)t(.*)/i', '', $password);
    $password = preg_replace('/d(.*)e(.*)l(.*)e(.*)t(.*)e(.*)/i', '', $password);
    $password = preg_replace('/u(.*)p(.*)d(.*)a(.*)t(.*)e(.*)/i', '', $password);
    $password = preg_replace('/u(.*)n(.*)i(.*)o(.*)n(.*)/i', '', $password);
    $password = str_replace('=', '', $password);
    $password = preg_replace('/u(.*)n(.*)h(.*)e(.*)x(.*)/i', '', $password);
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
    $username = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $username);
    $password = preg_replace('/<(.*)s(.*)c(.*)r(.*)i(.*)p(.*)t(.*)/i', '', $password);
    $username = htmlspecialchars($username);
    $password = htmlspecialchars($password);

    //CSRF



    // 2. SQL to check whether the user with username and
    // password exists or not
    //echo $username;
    //echo $password;
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
        sleep(5);
        $_SESSION['login'] = "<div class='error text-center'>Username or password is incorrect. Try again</div>";
        // Redirect to login.php
        header('location:' . SITEURL . 'admin/login.php');
    }
}





?>