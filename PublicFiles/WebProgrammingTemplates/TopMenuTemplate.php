<?php


?>


<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body { 
            font: 14px sans-serif; 
            text-align: center; 
        }
        
        .navigationHeader {
            text-align: right;
            margin-top: 5px !important;
            margin-left: 32px !important;
            margin-right: 32px !important;
            margin-bottom: 3px !important;
        }
        
        .navigationMenu {
            display: inline-block;
            list-style-type: none;
            margin-top: 3px !important;
            margin-bottom: 0px !important;
            padding: 0;
        }

        .navMenuItem {
            display: inline-block;
            text-align: center;
            border-left: 2px solid #eee;
            padding-top: 18px;
            padding-left: 15px;
            padding-right: 15px;
            padding-bottom: 18px;
            margin-left: 5px;
            margin-right: 5px;
            font-size: large;
        }

        .dropdownContent {
            /*display: "block";*/
            position: absolute;
            right: 5px;
            border-left: 2px solid #eee;
            padding-top: 3px !important;
            padding-left: 12px !important;
            padding-right: 12px !important;
            padding-bottom: 2px !important;
            /*border-bottom: 2px solid #eee;*/
            z-index: 5;
        }

        .dropdownItem {

            display: block;
            border-bottom: 2px solid #eee;
            font-size: large;
            padding-top: 5px !important;
            padding-bottom: 5px !important;
        }

        .hiddenContent {
            display: none;
        }


    </style>
</head>
<body>
    <div class="navigationHeader page-header row">
    <?php

    if ($_SESSION["loggedin"] == false)
    {
        echo "<ul id='signedOutVersion' class='navigationMenu'>
            <li class='navMenuItem col'><a href='WelcomeLoggedOutTemplate.php'>Welcome</a></li>
            <li class='navMenuItem col'><a href='SignUpTemplate.php'>Sign Up</a></li>
            <li class='navMenuItem col'><a href='LoginTemplate.php'>Log In</a></li>
        </ul>";
    }
    else
    {
        echo "<ul id='signedInVersion hiddenContent' class='navigationMenu'>
            <li class='navMenuItem col'><a href=IndexTemplate.php?page=welcome<!--'WelcomeLoggedOutTemplate.php-->'>Welcome</a></li>
            <li class='navMenuItem dropdown col'>
                <a class='dropdownButton' onClick='openDropdown()'>". htmlspecialchars($_SESSION["username"]) . 
                    "
                </a>

            </li>

        </ul>";
    }
    ?>
    </div>
    <ul id='userDropdownContent' class='dropdownContent col hiddenContent'>
        <li class='dropdownItem col'><a href='PasswordResetTemplate.php'>Reset Password</a></li>
        <li class='dropdownItem col'><a href='LogoutTemplate.php'>Log Out</a></li>
    </ul>

    <script>
        function openDropdown()
        {
            if (document.getElementById('userDropdownContent').classList.contains('hiddenContent'))
            {
                document.getElementById('userDropdownContent').classList.remove('hiddenContent');
            }
            else
            {
                document.getElementById('userDropdownContent').classList.add('hiddenContent');
            }
        }
    </script>
</body>

