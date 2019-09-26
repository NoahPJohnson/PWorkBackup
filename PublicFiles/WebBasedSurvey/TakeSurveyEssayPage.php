<?php

$sql = "INSERT INTO SurveyResultTable (SurveyName, Page1Response, Page2Response, Page3Response, Page4Response, Page5Response, Page6Response, Page7Response, Page8Response, Page9Response, ExtendedResponse) VALUES ('TestSurvey', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
//echo $sql;

if ($statement = mysqli_prepare($link, $sql))
{
    echo "Statement Prepared.";
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($statement, "ssssssssss", $B1Title, $B2Title, $B3Title, $B4Title,
    $B5Title, $B6Title, $B7Title, $B8Title, $CBTitle, $EssayResponse);
    
    $finalBenefitArray = $_SESSION["finalbenefitlist"];
    
    
    $B1Title = $finalBenefitArray[0];
    $B2Title = $finalBenefitArray[1];
    $B3Title = $finalBenefitArray[2];
    $B4Title = $finalBenefitArray[3];
    $B5Title = $finalBenefitArray[4];
    $B6Title = $finalBenefitArray[5];
    $B7Title = $finalBenefitArray[6];
    $B8Title = $finalBenefitArray[7];
    $CBTitle = $finalBenefitArray[8];
    $EssayResponse = $_POST["EssayResponse"];
        
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
        echo "Statement Executed.";
        
        session_start();
        $_SESSION["pageNumber"] = 0;
        $_SESSION["finalBenefitArray"] = array();
        $_SESSION["EssayResponse"] = "";

    }
    session_start();
        $_SESSION["pageNumber"] = 0;
        $_SESSION["finalBenefitArray"] = array();
        $_SESSION["EssayResponse"] = "";
}

?>

<header>Survey: Question</header>
    <div class='SurveyPage'>
        <h2 class='SurveyQuestion'>Question</h2>
        <div class='container-fluid'>
            <form class='EssayResponseForm col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER[""]); ?>' method='post' enctype="multipart/form-data">
                <div class='EssayText row'>
                    <textarea rows='14' class='EssayTextArea' name='EssayResponse'></textarea>
                </div>
                <div id='SubmitEssay' class='SubmitBenefit row'>
                    <input id='SubmitEssayButton' type="submit" class="btn" value="Submit">
                </div> 
            </form>
        </div>