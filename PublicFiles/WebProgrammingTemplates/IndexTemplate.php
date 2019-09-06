<?php


require_once "ConfigurationTemplate.php";

session_start();
$_SESSION['page'] = $_GET['page'];
//echo " :( " . var_dump($_SESSION);

require_once "HeaderTemplate.php";

if (isset($_SESSION["page"]))
{
    //echo "The Page is " . $_SESSION["page"];

    if ($_SESSION["page"] == "welcome")
    {
        //echo "Page: " . $_SESSION["page"];
        if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
        {
            require_once "WelcomeTemplate.php";
        }
        else
        {
            require_once "WelcomeLoggedOutTemplate.php";
        }
    }
    else if ($_SESSION["page"] == "map")
    {
        require_once "MapTemplate.php";
    }
    else if ($_SESSION["page"] == "signup")
    {
        if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
        {
            require_once "WelcomeTemplate.php";
        }
        else
        {
            require_once "SignUpTemplate.php";
        }
    }
    else if ($_SESSION["page"] == "login")
    {
        //echo "page = " . $_SESSION["page"];
        if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
        {
            require_once "WelcomeTemplate.php";
        }
        else
        {
            require_once "LoginTemplate.php";
        }
    }
    else if ($_SESSION["page"] == "changepassword")
    {
        if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
        {
            require_once "PasswordResetTemplate.php";
        }
        else
        {
            require_once "LoginTemplate.php";
        }
    }
}
else
{
    if (isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] == true)
    {
        require_once "WelcomeTemplate.php";
    }
    else
    {
        require_once "WelcomeLoggedOutTemplate.php";
    }
}


require_once "FooterTemplate.php";

?>