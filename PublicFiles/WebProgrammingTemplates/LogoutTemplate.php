<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
//header("location: LoginTemplate.php");
echo "<script>document.location = '/npjTest/Templates/IndexTemplate.php?page=welcome';</script>";
exit;
?>