<?php
//echo "HEEEY: " . mysqli_get_host_info($link);
if (isset($_POST["submit"]))
{
    //var_dump($_POST);
    UploadFile();
    $SurveyStructureObject = json_decode($jsonData);
    for ($i = 0; $i < 4; $i += 1)
    {
        if (isset($_POST["BT" . ($i+1)]))
        {
            $SurveyStructureObject->PageList[$pageNumber][$i]->BenefitText = filter_input(INPUT_POST,"BT" . ($i+1),FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);//$_POST["BT" . ($i+1)];
            //echo "TEXT: " . $SurveyStructureObject->PageList[$pageNumber][$i]->BenefitText;
        }
        if (isset($_POST["imageFit" . ($i+1)]))
        {
            $SurveyStructureObject->PageList[$pageNumber][$i]->ImageFitType = $_POST["imageFit" . ($i+1)];
            
        }
        if (isset($_POST["imagePosition" . ($i+1)]))
        {
            $SurveyStructureObject->PageList[$pageNumber][$i]->ImagePosition = $_POST["imagePosition" . ($i+1)];
            
        }
    }
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
                        <label id='BB1' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][0]->BenefitIndex; ?>' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL1' name='BL1' type='text'>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI1' src='' style='object-position: 50% 50%'>
                                <input type='file' name='BU1' id='BU1' class='fileToUpload' onchange="DisableUpload(this.id)">
                                <select name='imageFit1' class='imageFitSelector' id='FS1' onchange="ChangeImageFit(this.value, 'BI1')">
                                    <option value='contain'>Contain</option>
                                    <option value='cover'>Cover</option>
                                    <option value='fill'>Stretch</option>
                                    <option value='none'>None</option>
                                </select>
                                <input type='button' name='DI1' id='DI1' class='deleteImageButton' value='X' onclick="DeleteImage('BI1', 'BU1')"> 
                            </div>
                            <input type='hidden' id='IP1' class='imagePositionTracker' name='imagePosition1'>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <textarea id='BT1' name='BT1' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                    <div id='B2' class='Benefit col-md-6'>
                        <label id='BB2' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][1]->BenefitIndex; ?>' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL2' name='BL2' type='text'>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI2' src='' style='object-position: 50% 50%'>
                                <input type='file' name='BU2' id='BU2' class='fileToUpload' onchange="DisableUpload(this.id)">
                                <select name='imageFit2' class='imageFitSelector' id='FS2' onchange="ChangeImageFit(this.value, 'BI2')">
                                    <option value='contain'>Contain</option>
                                    <option value='cover'>Cover</option>
                                    <option value='fill'>Stretch</option>
                                    <option value='none'>None</option>
                                </select>
                                <input type='button' name='DI2' id='DI2' class='deleteImageButton' value='X' onclick="DeleteImage('BI2', 'BU2')">
                            </div>
                            <input type='hidden' id='IP2' class='imagePositionTracker' name='imagePosition2'>
                            <div  class='BenefitText col-sm-12 align-self-center'>
                                <textarea id='BT2' name='BT2' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B3' class='Benefit col-md-6'>
                        <label id='BB3' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][2]->BenefitIndex; ?>' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL3' name='BL3' type='text'>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI3' src='' style='object-position: 50% 50%'>
                                <input type='file' name='BU3'  id='BU3' class='fileToUpload' onchange="DisableUpload(this.id)">
                                <select name='imageFit3' class='imageFitSelector' id='FS3' onchange="ChangeImageFit(this.value, 'BI3')">
                                    <option value='contain'>Contain</option>
                                    <option value='cover'>Cover</option>
                                    <option value='fill'>Stretch</option>
                                    <option value='none'>None</option>
                                </select>
                                <input type='button' name='DI3' id='DI3' class='deleteImageButton' value='X' onclick="DeleteImage('BI3', 'BU3')">
                            </div>
                            <input type='hidden' id='IP3' class='imagePositionTracker' name='imagePosition3'>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <textarea id='BT3' name='BT3' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                    <div id='B4' class='Benefit col-md-6'>
                        <label id='BB4' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][3]->BenefitIndex; ?>' type='submit'>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL4' name='BL4' type='text'>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI4' src='' style='object-position: 50% 50%'>
                                <input type='file' name='BU4'  id='BU4' class='fileToUpload' onchange="DisableUpload(this.id)">
                                <select name='imageFit4' class='imageFitSelector' id='FS4' onchange="ChangeImageFit(this.value, 'BI4')">
                                    <option value='contain'>Contain</option>
                                    <option value='cover'>Cover</option>
                                    <option value='fill'>Stretch</option>
                                    <option value='none'>None</option>
                                </select>
                                <input type='button' name='DI4' id='DI4' class='deleteImageButton' value='X' onclick="DeleteImage('BI4', 'BU4')">
                            </div>
                            <input type='hidden' id='IP4' class='imagePositionTracker' name='imagePosition4'>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <textarea id='BT4' name='BT4' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                </div>
            
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo htmlspecialchars($pageNumber); ?>;
            var surveyJSONFile = '<?php echo htmlspecialchars($surveyJSONFile); ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>
        <script type='text/javascript' src='ImageManipulation.js'></script>
    <!--</div>
    <footer>Page: </footer>-->