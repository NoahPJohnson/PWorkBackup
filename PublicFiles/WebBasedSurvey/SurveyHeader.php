<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="SurveyStyle.css"> 
</head>
<body>
    <div class="navigationHeader page-header row">
    <?php
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
    { 
    ?>
        <ul id='signedInVersion' class='navigationMenu'>
            <li class='navMenuItem dropdown col'>
                <a class='dropdownButton' onClick='openDropdown()'>File</a>
                <ul id='userDropdownContent' class='dropdownContent col hiddenContent'>
                    <li class='dropdownItem col'><a href='SurveysDisplay.php'>Surveys</a></li>
                    <li class='dropdownItem col'><input type='submit' form='surveyForm' value='Save' name='submit'></li>
                    <li class='dropdownItem col'><a onClick='CreateSurveyShareLink("<?php echo urlencode($surveyName); ?>")'>Get Survey Link</a><p id='SurveyLinkField'></p></li>
                    <li class='dropdownItem col'><a href='SurveyLogout.php'>Log Out</a></li>
                </ul>
            </li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode('title'); ?>'>Title Page</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(0); ?>'>Page 1</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(1); ?>'>Page 2</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(2); ?>'>Page 3</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(3); ?>'>Page 4</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(4); ?>'>Page 5</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(5); ?>'>Page 6</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(6); ?>'>Page 7</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(7); ?>'>Page 8</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(8); ?>'>Page 9</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(9); ?>'>Page 10</a></li>
        </ul>
    <?php 
    }
    else
    {
    ?>
        <ul id='signedOutVersion' class='navigationMenu'>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode('title'); ?>'>Title Page</a><p class='navMenuText'>Title Page</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(0); ?>'>Page 1</a><p class='navMenuText'>Page 1</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(1); ?>'>Page 2</a><p class='navMenuText'>Page 2</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(2); ?>'>Page 3</a><p class='navMenuText'>Page 3</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(3); ?>'>Page 4</a><p class='navMenuText'>Page 4</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(4); ?>'>Page 5</a><p class='navMenuText'>Page 5</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(5); ?>'>Page 6</a><p class='navMenuText'>Page 6</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(6); ?>'>Page 7</a><p class='navMenuText'>Page 7</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(7); ?>'>Page 8</a><p class='navMenuText'>Page 8</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(8); ?>'>Page 9</a><p class='navMenuText'>Page 9</p></li>
            <li class='navMenuItem col'><a class='navMenuLink' href='SurveyIndex.php?surveyname=<?php echo urlencode($surveyName); ?>&page=<?php echo urlencode(9); ?>'>Page 10</a><p class='navMenuText'>Page 10</p></li>
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