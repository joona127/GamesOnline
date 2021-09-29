<?php

   include('../config/constants.php');

$id = $_GET['id'];

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


?>