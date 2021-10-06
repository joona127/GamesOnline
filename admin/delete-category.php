<?php

include('../config/constants.php');

$id = $_GET['id'];

if( stripos( $_SERVER[ 'HTTP_REFERER' ] ,$_SERVER[ 'SERVER_NAME' ]) !== false ){


// Create Sql query to delete admin
$sql = "DELETE FROM tbl_category WHERE id=$id";

// Execute the query
$res = mysqli_query($conn, $sql);

if($res==TRUE)
{
    $_SESSION['delete-category'] = "<div class='success'>Category deleted succesfully</div>";
    header('location:'.SITEURL.'admin/manage-category.php');
}
else
{
$_SESSION['delete-category'] = "<div class='error'>Failed to delete category</div>";
header('location:'.SITEURL.'admin/manage-category.php');
}


}else
{
$_SESSION['delete-category'] = "<div class='error'>Failed to delete category</div>";
header('location:'.SITEURL.'admin/manage-category.php');
}

?>