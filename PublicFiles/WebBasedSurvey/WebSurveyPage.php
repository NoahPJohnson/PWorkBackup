<?php
//echo "HEEEY: " . mysqli_get_host_info($link);
if (isset($_POST["submit"]))
{
    //var_dump($_POST);
    UploadFile();
    $pageArray = json_decode($jsonData);
    for ($i = 0; $i < 4; $i += 1)
    {
        if (isset($_POST["BT" . ($i+1)]))
        {
            $pageArray[$pageNumber][$i]->BenefitText = htmlspecialchars($_POST["BT" . ($i+1)]);
            echo "TEXT: " . $pageArray[$pageNumber][$i]->BenefitText;
        }
        if (isset($_POST["BL" . ($i+1)]))
        {
            $pageArray[$pageNumber][$i]->BenefitLabel = $_POST["BL" . ($i+1)];
            echo "TITLE: " . $pageArray[$pageNumber][$i]->BenefitLabel;
        }
    }
    //var_dump($pageArray);
    $jsonDataOutput = json_encode($pageArray);
    file_put_contents($surveyJSONFile, $jsonDataOutput);
}

?>

    <header>Survey: Question</header>
    <div class='SurveyPage'>
        <div class='SurveyQuestion'>Question</div>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER[""]); ?>' method='post' enctype="multipart/form-data">
                <div class='BenefitRow row align-items-center'>
                    <div id='B1' class='Benefit col-sm-6'>
                        <label id='BB1' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][0]->BenefitIndex; ?>' type='submit'>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL1' name='BL1' type='text'>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI1' src=''>
                                <input type='file'  name='BU1' id='BU1' class='fileToUpload'>
                            </div>
                            <div class='BenefitText col-sm-6 align-self-center'>
                                <textarea id='BT1' name='BT1' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                    <div id='B2' class='Benefit col-sm-6'>
                        <label id='BB2' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][1]->BenefitIndex; ?>' type='submit'>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL2' name='BL2' type='text'>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI2' src=''>
                                <input type='file' name='BU2' id='BU2' class='fileToUpload'>
                            </div>
                            <div  class='BenefitText col-sm-6 align-self-center'>
                                <textarea id='BT2' name='BT2' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B3' class='Benefit col-sm-6'>
                        <label id='BB3' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][2]->BenefitIndex; ?>' type='submit'>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL3' name='BL3' type='text'>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI3' src=''>
                                <input type='file' name='BU3'  id='BU3' class='fileToUpload'>
                            </div>
                            <div class='BenefitText col-sm-6 align-self-center'>
                                <textarea id='BT3' name='BT3' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                    <div id='B4' class='Benefit col-sm-6'>
                        <label id='BB4' class='BenefitButton row' value='<?php echo $pageArray[$pageNumber][3]->BenefitIndex; ?>' type='submit'>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <input id='BL4' name='BL4' type='text'>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI4' src=''>
                                <input type='file' name='BU4'  id='BU4' class='fileToUpload'>
                            </div>
                            <div class='BenefitText col-sm-6 align-self-center'>
                                <textarea id='BT4' name='BT4' rows='12' class='BenefitTextArea'></textarea>
                            </div>
                        </label>
                    </div>
                </div>
            
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo $pageNumber; ?>;
            var surveyJSONFile = '<?php echo $surveyJSONFile; ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>
        <script>

        </script>
    <!--</div>
    <footer>Page: </footer>-->