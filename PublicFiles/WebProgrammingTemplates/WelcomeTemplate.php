<?php
// Initialize the session
session_start();


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    //header("location: WelcomeLoggedOutTemplate.php");
    //header("location: IndexTemplate.php?page=welcome")
    //echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;
}

//require_once "TopMenuTemplate.php";

?>
 
<!--<!DOCTYPE html>
<html lang="en">
<body>-->
<div class='Page'>
    <div class=" row">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div>
    <div>
        <p>
            <!--<a href="PasswordResetTemplate.php" class="btn btn-warning">Reset Your Password</a>
            <a href="LogoutTemplate.php" class="btn btn-danger">Sign Out of Your Account</a>-->
        </p>
    </div>
<!--</body>
</html>-->