<?php

//require_once "surveyConfig.php";



$jsonData = file_get_contents('zipSurvey.json');
$pageArray = json_decode($jsonData);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();

    $_SESSION["pageNumber"] += 1;
    $pageNumber = $_SESSION["pageNumber"];
    if ($_POST['BenefitButton'][2] == 'a')
    {
        $_SESSION["finalBenefitArray"][] = $pageArray[$pageNumber-1][0];
        
    }
    else if ($_POST['BenefitButton'][2] == 'b')
    {
        $_SESSION["finalBenefitArray"][] = $pageArray[$pageNumber-1][1];
        
    }
    else if ($_POST['BenefitButton'][2] == 'c')
    {
        $_SESSION["finalBenefitArray"][] = $pageArray[$pageNumber-1][2];
        
    }
    else if ($_POST['BenefitButton'][2] == 'd')
    {
        $_SESSION["finalBenefitArray"][] = $pageArray[$pageNumber-1][3];
        
    }
    $finalBenefitArray = $_SESSION["finalBenefitArray"];
    if ($pageNumber >= 8)
    {
        if (isset($_SESSION["finalBenefitArray"]))
        {
            header("location: surveyFinalPage.php");

            exit();
        }
    }
}


if (!isset($_SESSION["pageNumber"]) || $_SESSION["pageNumber"] == 0)
{
    $finalBenefitArray = array();
    $pageNumber = 0;
    //echo "S: " . $_SESSION["pageNumber"];
}

class Benefit
{
        public $BenefitText;
        public $BenefitImage;
        public $BenefitLabel;
        public $BeneiftIndex;

        function __construct()
        {
            $this->BenefitText = "BenefitText";
            $this->BenefitImage = "./Assets";
            $this->BenefitLabel = "Benefit Title";
            $this->BenefitIndex = "";
        }
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Survey Page</title>
    
    <!-- Bootstrap -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css' integrity='sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu' crossorigin='anonymous'>
    <style>


    .BenefitRow {
        margin: auto;
        padding: 10px 0;
        height: 45%;
    }

    .Benefit {

        border: 1px solid blue;
        margin: 10px;
        padding: 5px;
        height: 300px;
    }

    .BenefitTitle {
        text-align: center;
        height: 10%;
    }

    .BenefitImage {
        padding: 5px 0;
        object-fit: contain;
    }
    </style>

</head>
<body>
    <header>Survey: Question</header>
    <div class='Survey Page'>
        <div class='SurveyQuestion'>Question</div>
        <form class='BenefitsCollection container' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='post'>
            <div class='BenefitRow row'>
                <div id='B1'>
                    <button id='BB1' name='BenefitButton' value='<?php echo $pageArray[$pageNumber][0]->BenefitIndex ?>' class='Benefit col-md-5' type='submit'>
                        <div id='BL1' class='row'>
                            <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][0]->BenefitLabel ?></div>
                        </div>
                        <div id='BC1' class='row'>
                            <img id='BI1' class='BenefitImage col-md-6' src='<?php echo substr($pageArray[$pageNumber][0]->BenefitImage, 11)  ?>'></img>
                            <div id='BT1' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][0]->BenefitText ?></div>
                        
                        </div>
                    </button>
                </div>
                <div id='B2'>
                    <button id='BB2' name='BenefitButton' value='<?php echo $pageArray[$pageNumber][1]->BenefitIndex ?>' class='Benefit col-md-5' type='submit'>
                        <div id='BL2' class='row'>
                            <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][1]->BenefitLabel ?></div>
                        </div>
                        <div id='BC2' class='row'>
                            <img id='BI2' class='BenefitImage col-md-6' src='<?php echo substr($pageArray[$pageNumber][1]->BenefitImage, 11)  ?>'></img>
                            <div id='BT2' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][1]->BenefitText ?></div>
                        
                        </div>
                    </button>
                </div>
            </div>
            <div class='BenefitRow row'>
                <div id='B3'>
                    <button id='BB3' name='BenefitButton' value='<?php echo $pageArray[$pageNumber][2]->BenefitIndex ?>' class='Benefit col-md-5' type='submit'>
                        <div id='BL3' class='row'>
                            <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][2]->BenefitLabel ?></div>
                        </div>
                        <div id='BC3' class='row'>
                        
                            <img id='BI3' class='BenefitImage col-md-6' src='<?php echo substr($pageArray[$pageNumber][2]->BenefitImage, 11)  ?>'></img>
                            <div id='BT3' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][2]->BenefitText ?></div>
                        
                        </div>
                    </button>
                </div>
                <div id='B4'>
                    <button  id='BB4' name='BenefitButton' value='<?php echo $pageArray[$pageNumber][3]->BenefitIndex ?>' class='Benefit col-md-5' type='submit'>
                        <div id='BL4' class='row'>
                            <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][3]->BenefitLabel ?></div>
                        </div>
                        <div id='BC4' class='row'>
                            <img id='BI4' class='BenefitImage col-md-6' src='<?php echo substr($pageArray[$pageNumber][3]->BenefitImage, 11) ?>'></img>
                            <div id='BT4' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][3]->BenefitText ?></div>
                        </div>
                    </button>
                </div>
            </div>
        </form>
        <script>
        
                var indexArray = [0,1,2,3];
                var indexOptionList = [0,1,2,3];
                
                var tempIndexList = [indexOptionList];
                for (var i = 0; i < 4; i++)
                {
                    var randomInt = Math.floor(Math.random()*(4-i));
                    indexArray[i] = tempIndexList[i][randomInt];
                    tempIndexList[i].splice(randomInt, 1);
                    tempIndexList.push(tempIndexList[i]);
                    
                }
                for (var i = 0; i < 4; i++)
                {
                    var currentParent = document.getElementById('B'.concat(i+1));
                    currentParent.appendChild(document.getElementById('BB'.concat(indexArray[i]+1)).cloneNode(true));
                    //currentParent.appendChild(document.getElementById('BC'.concat(indexArray[i]+1)).cloneNode(true));
                }
                for (var i = 0; i < 4; i++)
                {
                    var currentParent = document.getElementById('B'.concat(i + 1));
                    currentParent.removeChild(currentParent.childNodes[1]);
                    //currentParent.removeChild(currentParent.firstChild);
                    //currentParent.removeChild(currentParent.firstChild);
                    //currentParent.removeChild(currentParent.firstChild);
                }
        </script>
    </div>
    <footer>Page: <?php echo $pageNumber?></footer>
</body>
</html>