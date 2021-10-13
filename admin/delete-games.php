<?php

include('../config/constants.php');


            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType > 1){
              header('location:'.SITEURL.'logout.php');;
            }


$id = $_GET['id'];



if( stripos( $_SERVER[ 'HTTP_REFERER' ] ,$_SERVER[ 'SERVER_NAME' ]) !== false ){

// Create Sql query to delete admin
$sql = "DELETE FROM tbl_games WHERE id=$id";

// Execute the query
$res = mysqli_query($conn, $sql);

if($res==TRUE)
{
    $_SESSION['delete-games'] = "<div class='success'>Game deleted succesfully</div>";
    header('location:'.SITEURL.'admin/manage-games.php');
}
else
{
$_SESSION['delete-games'] = "<div class='error'>Failed to delete game</div>";
header('location:'.SITEURL.'admin/manage-games.php');
}


}
else
{
$_SESSION['delete-games'] = "<div class='error'>Failed to delete game</div>";
header('location:'.SITEURL.'admin/manage-games.php');
}
