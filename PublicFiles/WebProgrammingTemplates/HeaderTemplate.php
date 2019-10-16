<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="StyleTemplate.css"> 
</head>
<body>
    <div class="navigationHeader page-header row">
    <?php

    if ($_SESSION["loggedin"] == false)
    {
    ?>
        <ul id='signedOutVersion' class='navigationMenu'>
            <li class='navMenuItem col'><a href='IndexTemplate.php?page=welcome'>Welcome</a></li>
            <li class='navMenuItem col'><a href='IndexTemplate.php?page=map'>Map</a></li>
            <!--<li class='navMenuItem col'><a href='IndexTemplate.php?page=upload'>Upload</a></li>-->
            <li class='navMenuItem col'><a href='IndexTemplate.php?page=signup'>Sign Up</a></li>
            <li class='navMenuItem col'><a href='IndexTemplate.php?page=login'>Log In</a></li>
        </ul>
    <?php
    }
    else
    {
    ?>
        <ul id='signedInVersion hiddenContent' class='navigationMenu'>
            <li class='navMenuItem col'><a href='IndexTemplate.php?page=welcome'>Welcome</a></li>
            <li class='navMenuItem col'><a href='IndexTemplate.php?page=map'>Map</a></li>
            <li class='navMenuItem dropdown col'>
                <a class='dropdownButton' onClick='openDropdown()'><?php echo htmlspecialchars($_SESSION["username"]); ?>
                </a>
                <ul id='userDropdownContent' class='dropdownContent col hiddenContent'>
                    <li class='dropdownItem col'><a href='IndexTemplate.php?page=account'>Account</a></li>
                    <li class='dropdownItem col'><a href='IndexTemplate.php?page=changepassword'>Reset Password</a></li>
                    <li class='dropdownItem col'><a href='LogoutTemplate.php'>Log Out</a></li>
                </ul>
            </li>

        </ul>
    <?php
    }
    ?>
    </div>
    

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