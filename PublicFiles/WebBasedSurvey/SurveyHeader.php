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
        echo "<ul id='signedInVersion' class='navigationMenu'>
            <li class='navMenuItem dropdown col'>
                <a class='dropdownButton' onClick='openDropdown()'>File</a>
                <ul id='userDropdownContent' class='dropdownContent col hiddenContent'>
                    <li class='dropdownItem col'><a href='SurveysDisplay.php'>Surveys</a></li>
                    <li class='dropdownItem col'><input type='submit' form='surveyForm' value='Save' name='submit'></li>
                    <li class='dropdownItem col'><a onClick='CreateSurveyShareLink(\"" . $surveyName . "\")'>Get Survey Link</a><p id='SurveyLinkField'></p></li>
                    <li class='dropdownItem col'><a href='SurveyLogout.php'>Log Out</a></li>
                </ul>
            </li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=title'>Title Page</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=0'>Page 1</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=1'>Page 2</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=2'>Page 3</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=3'>Page 4</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=4'>Page 5</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=5'>Page 6</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=6'>Page 7</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=7'>Page 8</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=8'>Page 9</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=9'>Page 10</a></li>
        </ul>";
    }
    else
    {
        echo "<ul id='signedOutVersion' class='navigationMenu'>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=title'>Title Page</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=0'>Page 1</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=1'>Page 2</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=2'>Page 3</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=3'>Page 4</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=4'>Page 5</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=5'>Page 6</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=6'>Page 7</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=7'>Page 8</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=8'>Page 9</a></li>
            <li class='navMenuItem col'><a href='SurveyIndex.php?surveyname=" . $surveyName . "&page=9'>Page 10</a></li>
        </ul>";
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