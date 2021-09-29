<?php
include('../config/constants.php');

//1. Destroy the session
session_destroy();

// 2. Redirect to the login page
header('location:'.SITEURL.'admin/login.php');
?>