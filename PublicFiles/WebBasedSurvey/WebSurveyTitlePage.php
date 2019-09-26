<?php


//echo "HEEEY: " . mysqli_get_host_info($link);
if (isset($_POST["submit"]))
{
    if ($_POST["SurveyTitleValue"] != $surveyName)
    {
        $sqlQuery = "UPDATE SurveyBuildTable SET SurveyName = ? WHERE SurveyName = ? AND SurveyOwnerID = ?";
        if ($statement = mysqli_prepare($link, $sqlQuery))
        {
            //echo "Next statement prepared.";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement, "sss", $param_surveyName, $param_surveyOldName, $param_ownerID);
            
            // Set parameters
            
            $param_surveyName = $_POST["SurveyTitleValue"];
            $param_surveyOldName = $surveyName;
            $param_ownerID = $_SESSION["id"];
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement))
            {
                rename($surveyJSONFile, $_POST["SurveyTitleValue"] . ".json");
                $_SESSION["surveyname"] = $_POST["SurveyTitleValue"];
                $surveyName = $_POST["SurveyTitleValue"];
                $_SESSION["surveyjsonfile"] = $_POST["SurveyTitleValue"] . ".json";
                $surveyJSONFile = $_SESSION["surveyjsonfile"];
                header("location: SurveyIndex.php?surveyname=" . $surveyName . "&page=title");
            }
        }
    }
}

?>

    <header>Survey: Title Page</header>
    <div class='SurveyPage'>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER[""]); ?>' method='post' enctype="multipart/form-data">
                <div class='row' style='text-align:center;'>
                    <input id='TitleInput' class='col-md-6' name='SurveyTitleValue' type='text'>
                </div>
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = '<?php echo $pageNumber; ?>';
            var surveyJSONFile = '<?php echo $surveyJSONFile; ?>';

            document.getElementById('TitleInput').value = '<?php echo $surveyName; ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>
        <script>

        </script>