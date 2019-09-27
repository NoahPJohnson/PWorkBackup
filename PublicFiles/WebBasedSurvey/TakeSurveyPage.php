<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
//if (isset($_POST["submit"]))
//{
    $_SESSION["finalbenefitlist"][$pageNumber] = $_POST['Selected'];  
    //var_dump($_POST);
    $pageNumber += 1;
    //location("header: SurveyIndex.php?page=" . $pageNumber);
    echo "<script>document.location = './SurveyIndex.php?surveyname=" . $surveyName . "&page=" . $pageNumber . "';</script>"; 
}

?>


<header>Survey: Question</header>
    <div class='SurveyPage'>
        <h2 class='SurveyQuestion'>Question</h2>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER[""]); ?>' method='post' enctype="multipart/form-data">
                <div class='BenefitRow row align-items-center'>
                    <div id='B1' class='Benefit col-sm-6'>
                        <button id='BB1' class='BenefitButton row' value='' type='button'>
                            <input id='Index1' class='BenefitIndex' style='display:none' value=''>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL1' type='text'></h4>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI1' src=''>
                            </div>
                            <div class='BenefitText col-sm-6 align-self-center'>
                                <p id='BT1' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                    <div id='B2' class='Benefit col-sm-6'>
                        <button id='BB2' class='BenefitButton row' value='' type='button'>
                            <input id='Index2' class='BenefitIndex' style='display:none' value=''>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL2' type='text'></h4>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI2' src=''>
                            </div>
                            <div  class='BenefitText col-sm-6 align-self-center'>
                                <p id='BT2' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                </div>
                <div class='BenefitRow row align-items-center'>
                    <div id='B3' class='Benefit col-sm-6'>
                        <button id='BB3' class='BenefitButton row' value='' type='button'>
                            <input id='Index3' class='BenefitIndex' style='display:none' value=''>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL3' type='text'></h4>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI3' src=''>
                            </div>
                            <div class='BenefitText col-sm-6 align-self-center'>
                                <p id='BT3' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                    <div id='B4' class='Benefit col-sm-6'>
                        <button id='BB4' class='BenefitButton row' value='' type='button'>
                            <input id='Index4' class='BenefitIndex' style='display:none' value=''>
                            <div class='BenefitTitle col-sm-12 align-items-start'>
                                <h4 id='BL4' type='text'></h4>
                            </div>
                            <div class='BenefitImage col-sm-6 align-self-center'>
                                <img id='BI4' src=''>
                            </div>
                            <div  class='BenefitText col-sm-6 align-self-center'>
                                <p id='BT4' rows='12' class='BenefitTextArea'></p>
                            </div>
                        </button>
                    </div>
                </div>
                <div id='SubmitBenefit<?php if ($pageNumber != 'title') {echo $pageNumber;} else { echo 0; }  ?>' class='SubmitBenefit row'>
                    <input id='SubmitBenefitButton' type="submit" class="btn" value="Submit" disabled>
                </div> 
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = <?php echo $pageNumber; ?>;
            var surveyJSONFile = '<?php echo $_SESSION["surveyjsonfile"]; ?>';

            for (var i = 0; i < 10; i += 1)
            {

                document.getElementsByClassName("navMenuItem")[1+i].style.visibility = 'hidden';
                if ((i) < pageNumber)
                {
                    document.getElementsByClassName("navMenuItem")[1+i].style.visibility = 'visible';//href = ('SurveyIndex.php?page='+i);
                }
            }

        </script>
        <script type='text/javascript' src='ParseTakeSurveyJSON.js'></script>
        <!--<script type='text/javascript' src='ShuffleIndex.js'></script>-->