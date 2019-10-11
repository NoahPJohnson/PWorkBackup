<?php


//echo "HEEEY: " . mysqli_get_host_info($link);
if (isset($_POST["submit"]))
{
    UploadLogo();
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
                
                $_SESSION["surveyname"] = filter_input(INPUT_POST, "SurveyTitleValue", FILTER_SANITIZE_STRING);// $_POST["SurveyTitleValue"];
                rename($surveyJSONFile, $_SESSION["surveyname"] . ".json");
                $surveyName = filter_input(INPUT_POST, "SurveyTitleValue", FILTER_SANITIZE_STRING);
                $_SESSION["surveyjsonfile"] = $_SESSION["surveyname"] . ".json";
                $surveyJSONFile = $_SESSION["surveyjsonfile"];
                header("location: SurveyIndex.php?surveyname=" . urlencode($surveyName) . "&page=" . urlencode("title"));
            }
        }
    }
}

?>

    <!--<header>Survey: Title Page</header>-->
    <div class='SurveyPage'>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>' method='post' enctype="multipart/form-data">
                <div class='row' style='text-align:center;'>
                    <input id='TitleInput' class='col-md-6' name='SurveyTitleValue' type='text'>
                </div>
                <div class='row'>
                    <div class='LogoContainer col-md-6'>
                        <h4 style='text-align:center'>Company Logo (Header)</h4>
                        <img id='LogoImage1' class='logo' src=''>
                        <input type='file' name='LogoUpload1' id='LogoUpload1' class='logoFileUpload'>
                    </div>
                </div>
                <div class='row'>
                    <div class='LogoContainer col-md-6'>
                        <h4 style='text-align:center'>Agency Logo (Footer)</h4>
                        <img id='LogoImage2' class='logo' src=''>
                        <input type='file' name='LogoUpload2' id='LogoUpload2' class='logoFileUpload'>
                    </div>
                </div>
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = '<?php echo $pageNumber; ?>';
            var surveyJSONFile = '<?php echo $surveyJSONFile; ?>';

            document.getElementById('TitleInput').value = '<?php echo htmlspecialchars($surveyName); ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>
        <script>

        </script>