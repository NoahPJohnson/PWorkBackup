<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//if (isset($_POST["submit"]))
//{
    $_SESSION["finalbenefitlist"][$pageNumber] = filter_input(INPUT_POST, "Selected", FILTER_SANITIZE_STRING);//$_POST['Selected'];  
    //var_dump($_POST);
    $pageNumber += 1;
    //location("header: SurveyIndex.php?surveyname=" . urlencode($surveyName) . "&page=" . urlencode($pageNumber));
    echo "<script>document.location = './SurveyIndex.php?surveyname=" . urlencode($surveyName) . "&page=" . urlencode($pageNumber) . "';</script>"; 
}

?>


<!--<header>Survey: Question</header>-->
    <div class='SurveyPage'>
        <div class='QuestionRow row align-items-center'>
            <h2 class='SurveyQuestion col-md-8 align-self-center' id='PageQuestion'>Question</h2>
        </div>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>' method='post' enctype="multipart/form-data">
                <div class='BenefitRow row align-items-center'>
                    <div id='B1' class='Benefit col-md-6'>
                        <button id='BB1' class='BenefitButton row' value='' type='button'>
                            <input id='Index1' class='BenefitIndex' style='display:none' value=''>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL1' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI1' src=''>
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT1' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                    <div id='B2' class='Benefit col-md-6'>
                        <button id='BB2' class='BenefitButton row' value='' type='button'>
                            <input id='Index2' class='BenefitIndex' style='display:none' value=''>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL2' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI2' src=''>
                            </div>
                            <div  class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT2' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B3' class='Benefit col-md-6'>
                        <button id='BB3' class='BenefitButton row' value='' type='button'>
                            <input id='Index3' class='BenefitIndex' style='display:none' value=''>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL3' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI3' src=''>
                            </div>
                            <div class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT3' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                    <div id='B4' class='Benefit col-md-6'>
                        <button id='BB4' class='BenefitButton row' value='' type='button'>
                            <input id='Index4' class='BenefitIndex' style='display:none' value=''>
                            <!--<div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL4' type='text'></h4>
                            </div>-->
                            <div class='BenefitImage col-sm-12 align-self-center'>
                                <img id='BI4' src=''>
                            </div>
                            <div  class='BenefitText col-sm-12 align-self-center'>
                                <p id='BT4' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                </div>
<div id='SubmitBenefit<?php if ($pageNumber != 'title') {echo htmlspecialchars($pageNumber);} else { echo 0; }  ?>' class='SubmitBenefit row'>
                    <input id='SubmitBenefitButton' type="submit" class="SubmitButton btn col-md-8" value="Submit" disabled>
                </div> 
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo htmlspecialchars($pageNumber); ?>;
            var surveyJSONFile = '<?php echo htmlspecialchars($_SESSION["surveyjsonfile"]); ?>';

            for (var i = 0; i < 10; i += 1)
            {

                //document.getElementsByClassName("navMenuItem")[1+i].style.visibility = 'hidden';
                document.getElementsByClassName("navMenuLink")[1+i].style.display = 'none';
                document.getElementsByClassName("navMenuText")[1+i].style.display = 'inline';
                if ((i) < pageNumber)
                {
                    //document.getElementsByClassName("navMenuItem")[1+i].style.visibility = 'visible';//href = ('SurveyIndex.php?page='+i);
                    document.getElementsByClassName("navMenuLink")[1+i].style.display = 'inline';
                    document.getElementsByClassName("navMenuText")[1+i].style.display = 'none';
                }
            }

        </script>
        <script type='text/javascript' src='ParseTakeSurveyJSON.js'></script>
        <!--<script type='text/javascript' src='ShuffleIndex.js'></script>-->