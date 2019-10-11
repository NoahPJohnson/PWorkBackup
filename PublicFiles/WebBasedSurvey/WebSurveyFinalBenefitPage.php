<?php
if (isset($_POST["submit"]))
{
    $SurveyStructureObject = json_decode($jsonData);

    $SurveyStructureObject->QuestionsList[$pageNumber] = filter_input(INPUT_POST, "QuestionInput", FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);//strip_tags($_POST["QuestionInput"]);
    //var_dump($pageArray);
    $jsonDataOutput = json_encode($SurveyStructureObject);
    file_put_contents($surveyJSONFile, $jsonDataOutput);
}
?>
<!--<header>Survey: Question</header>-->
    <div class='SurveyPage'>
        
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>' method='post' enctype="multipart/form-data">
                <div class='QuestionRow row align-items-center'>
                    <input class='SurveyQuestion col-md-8 align-self-center' id='Question' name='QuestionInput' type='text'>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B1' class='Benefit col-md-6'>
                        <label id='BB1' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL1' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI1' src=''>
                                <!--<input type='file'  name='BU1' id='BU1' class='fileToUpload'>-->
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT1' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                    <div id='B2' class='Benefit col-md-6'>
                        <label id='BB2' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL2' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI2' src=''>
                                <!--<input type='file' name='BU2' id='BU2' class='fileToUpload'>-->
                            </div>
                            <div  class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT2' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B3' class='Benefit col-md-6'>
                        <label id='BB3' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL3' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI3' src=''>
                                <!--<input type='file'  name='BU3' id='BU3' class='fileToUpload'>-->
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT3' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                    <div id='B4' class='Benefit col-md-6'>
                        <label id='BB4' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL4' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI4' src=''>
                                <!--<input type='file' name='BU4' id='BU4' class='fileToUpload'>-->
                            </div>
                            <div  class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT4' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B5' class='Benefit col-md-6'>
                        <label id='BB5' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL5' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI5' src=''>
                                <!--<input type='file' name='BU5'  id='BU5' class='fileToUpload'>-->
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT5' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                    <div id='B6' class='Benefit col-md-6'>
                        <label id='BB6' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL6' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI6' src=''>
                                <!--<input type='file' name='BU6' id='BU6' class='fileToUpload'>-->
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT6' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B7' class='Benefit col-md-6'>
                        <label id='BB7' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL7' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI7' src=''>
                                <!--<input type='file'  name='BU7' id='BU7' class='fileToUpload'>-->
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT7' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                    <div id='B8' class='Benefit col-md-6'>
                        <label id='BB8' class='BenefitButton row' value='' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL8' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI8' src=''>
                                <!--<input type='file' name='BU8' id='BU8' class='fileToUpload'>-->
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT8' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </label>
                    </div>
                </div>
            
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo $pageNumber; ?>;
            var surveyJSONFile = '<?php echo $_SESSION["surveyjsonfile"]; ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>
        <script>
                
        </script>