<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $sqlQuery = "SELECT SurveyOwnerID FROM SurveyBuildTable WHERE SurveyID = ?;";
    if ($statement = mysqli_prepare($link, $sqlQuery))
    {
        mysqli_stmt_bind_param($statement, "s", $_SESSION["surveyid"]);
        if (mysqli_stmt_execute($statement))
        {
            // Store result
            mysqli_stmt_store_result($statement);
            if (mysqli_stmt_bind_result($statement, $resultSurveyOwnerID))
            {
                if(mysqli_stmt_fetch($statement))
                {
                    $surveyOwnerID = $resultSurveyOwnerID;
                }
            }
        }
    }
    $sql = "INSERT INTO SurveyResultTable (SurveyName, SurveyOwnerID, Page1Response, Page2Response, Page3Response, Page4Response, Page5Response, Page6Response, Page7Response, Page8Response, Page9Response, ExtendedResponse, ExtendedResponse2) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    //echo $sql;

    if ($statement = mysqli_prepare($link, $sql))
    {
        //echo "Statement Prepared.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "sssssssssssss", $SurveyNameParameter, $SurveyOwnerIDParameter, $B1Title, $B2Title, $B3Title, $B4Title,
        $B5Title, $B6Title, $B7Title, $B8Title, $CBTitle, $EssayResponse, $EssayResponse2);
        
        $finalBenefitArray = $_SESSION["finalbenefitlist"];
        $SurveyNameParameter = $surveyName;
        $SurveyOwnerIDParameter = $surveyOwnerID;
        
        $B1Title = $finalBenefitArray[0];
        $B2Title = $finalBenefitArray[1];
        $B3Title = $finalBenefitArray[2];
        $B4Title = $finalBenefitArray[3];
        $B5Title = $finalBenefitArray[4];
        $B6Title = $finalBenefitArray[5];
        $B7Title = $finalBenefitArray[6];
        $B8Title = $finalBenefitArray[7];
        $CBTitle = $finalBenefitArray[8];
        $EssayResponse = filter_input(INPUT_POST, "EssayResponse", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);// $_POST["EssayResponse"];
        $EssayResponse2 = filter_input(INPUT_POST, "EssayResponse2", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        /*echo "  B1 = " . $B1Title;
        echo "  B2 = " . $B2Title;
        echo "  B3 = " . $B3Title;
        echo "  B4 = " . $B4Title;
        echo "  B5 = " . $B5Title;
        echo "  B6 = " . $B6Title;
        echo "  B7 = " . $B7Title;
        echo "  B8 = " . $B8Title;
        echo "  CB = " . $CBTitle;*/
        // Set parameters
        //$param_username = trim($_POST["username"]);
            
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            //echo "Statement Executed.";
            
            session_start();
            $_SESSION["page"] = 0;
            $_SESSION["finalBenefitArray"] = array();
            $_SESSION["EssayResponse"] = "";

            //header("location: TakeSurveyCompletePage.php");
            echo "<script>document.location = './TakeSurveyCompletePage.php';</script>";
        }
        else
        {
            echo "There was an error inserting into the database.";
        }
    }
}
?>

<!--<header>Survey: Question</header>-->
    <div class='SurveyPage'>
        <!--<h2 class='SurveyQuestion' id='PageQuestion'>Question</h2>-->
        <div class='container-fluid'>
            <form class='EssayResponseForm col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>' method='post' enctype="multipart/form-data">
                <div class='QuestionRow row align-items-center'>
                    <h2 class='SurveyQuestion col-md-8 align-self-center' id='EssayQuestion1'>Question</h2>
                </div>
                <div class='EssayText row'>
                    <textarea rows='10' class='EssayTextArea col-md-8' id='Essay1' name='EssayResponse'></textarea>
                </div>
                <div class='QuestionRow row align-items-center'>
                    <h2 class='SurveyQuestion col-md-8 align-self-center' id='EssayQuestion2'>Question</h2>
                </div>
                <div class='EssayText row'>
                    <textarea rows='10' class='EssayTextArea col-md-8' id='Essay2' name='EssayResponse2'></textarea>
                </div>
                <div id='SubmitEssay' class='SubmitBenefit row'>
                    <input id='SubmitEssayButton' type="submit" class="SubmitButton btn col-md-8" value="Submit">
                </div> 
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo htmlspecialchars($pageNumber); ?>;
            var surveyJSONFile = '<?php echo htmlspecialchars($_SESSION["surveyjsonfile"]); ?>';
        </script>