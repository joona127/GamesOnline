<?php

   include('../config/constants.php');

$id = $_GET['id'];


            $sql2 = "SELECT * FROM tbl_admin WHERE username='".$_SESSION['user']."'";
            $res2 = mysqli_query($conn, $sql2);
            if ($res2 == TRUE){
              $rows2 = mysqli_fetch_assoc($res2);
              $userType = $rows2['userType'];
            }

            if($userType > 0){
              header('location:'.SITEURL.'admin/logout.php');;
            }



if( stripos( $_SERVER[ 'HTTP_REFERER' ] ,$_SERVER[ 'SERVER_NAME' ]) !== false ){

// Create SQL Query to Delete Admin
$sql = "DELETE FROM tbl_admin WHERE id=$id";

// Execute the query
$res = mysqli_query($conn, $sql);

  if($res==TRUE)
  {
    $_SESSION['delete'] = "<div class='success'>Admin deleted succesfully</div>";
  
    header('location:'.SITEURL.'admin/manage-admin.php');
  }
  else 
  {
    $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again.</div>";
    header('location:'.SITEURL.'admin/manage-admin.php');
  }

}else 
{
  $_SESSION['delete'] = "<div class='error'>Failed to delete admin. Try again.</div>";
  header('location:'.SITEURL.'admin/manage-admin.php');
}




?>