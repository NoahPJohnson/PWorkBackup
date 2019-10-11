<?php
// Initialize the session
session_start();



// Check if the user is logged in, if not then redirect him to login page
if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
{
    //header("location: WelcomeTemplate.php");
    //echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;
}

//require_once "TopMenuTemplate.php";

?>
<div class='Page'>
    <div class="row">
        <h2>Welcome to the site.</h2>
    </div>
    <div>
        <p>
            <!--<a href="SignUpTemplate.php" class="btn btn-warning">Sign Up</a>
            <a href="LoginTemplate.php" class="btn btn-primary">Log In</a>-->
        </p>
    </div>
