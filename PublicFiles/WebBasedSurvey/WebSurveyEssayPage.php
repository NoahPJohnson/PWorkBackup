<?php
if (isset($_POST["submit"]))
{
    $SurveyStructureObject = json_decode($jsonData);

    $SurveyStructureObject->QuestionsList[$pageNumber] = filter_input(INPUT_POST, "QuestionInput1", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);//strip_tags($_POST["QuestionInput"]);
    $SurveyStructureObject->QuestionsList[$pageNumber+1] = filter_input(INPUT_POST, "QuestionInput2", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);//strip_tags($_POST["QuestionInput"]);
    //var_dump($pageArray);
    $jsonDataOutput = json_encode($SurveyStructureObject);
    file_put_contents($surveyJSONFile, $jsonDataOutput);
}
?>


<!--<header>Survey: Question</header>-->
    <div class='SurveyPage'>
        <div class='container-fluid'>
            <form class='EssayQuestions col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>' method='post' enctype="multipart/form-data">
                <div class='QuestionRow row align-items-center'>
                    <input class='SurveyQuestion col-md-8 align-self-center' id='EssayQuestion1' name='QuestionInput1' type='text'>
                </div>
                <div class='QuestionRow row align-items-center'>
                    <input class='SurveyQuestion col-md-8 align-self-center' id='EssayQuestion2' name='QuestionInput2' type='text'>
                </div>
            </form> 
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo $pageNumber; ?>;
            var surveyJSONFile = '<?php echo $_SESSION["surveyjsonfile"]; ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>