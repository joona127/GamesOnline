<?php include('../config/constants.php');
include('login-check.php');


?>


<html>

<head>
  <title>GamesOnline Website - Home Page</title>
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="menu text-center">
    <div class="wrapper">

      <nav class="navbar navbar-expand-lg navbar-light lg-light">
        <a class="navbar-brand" href="#">GamesOnline</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
    <?php
            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType <= 1){
              echo '<li class="nav-item">
              <a class="nav-link" href="manage-admin.php">Admin</a>
              </li>';
            }
    ?>
            
            <li class="nav-item">
              <a class="nav-link" href="manage-category.php">Categories</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="manage-games.php">Games</a>
            </li>

            <li class="nav-item" style="margin-right: 100px">
              <a class="nav-link disabled" href="logout.php">Logout</a>
            </li>
          </ul>
        </div>
    </div>
    </nav>

  </div>
  </div>
</body>

</html>