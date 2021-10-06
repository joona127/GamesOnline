<?php

include('../config/constants.php');

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
