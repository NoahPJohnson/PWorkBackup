<?php
session_start();
require_once "surveyConfig.php";




$jsonData = file_get_contents('testSurveyFile.json');
$pageArray = json_decode($jsonData);
if (isset($_SESSION["finalBenefitArray"]))
{
    echo "Good.";
    $finalBenefitArray = $_SESSION["finalBenefitArray"];
}
else
{
    echo "Bad.";
}
$chiefBenefit = new Benefit();

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
    if ($_POST['BenefitButton'] == '1')
    {
        $chiefBenefit = $finalBenefitArray[0];
        
    }
    else if ($_POST['BenefitButton'] == '2')
    {
        $chiefBenefit = $finalBenefitArray[1];
        
    }
    else if ($_POST['BenefitButton'] == '3')
    {
        $chiefBenefit = $finalBenefitArray[2];
        
    }
    else if ($_POST['BenefitButton'] == '4')
    {
        $chiefBenefit = $finalBenefitArray[3];
        
    }
    else if ($_POST['BenefitButton'] == '5')
    {
        $chiefBenefit = $finalBenefitArray[4];
        
    }
    else if ($_POST['BenefitButton'] == '6')
    {
        $chiefBenefit = $finalBenefitArray[5];
        
    }
    else if ($_POST['BenefitButton'] == '7')
    {
        $chiefBenefit = $finalBenefitArray[6];
        
    }
    else if ($_POST['BenefitButton'] == '8')
    {
        $chiefBenefit = $finalBenefitArray[7];
        
    }


    $sql = "INSERT INTO SurveyTable2 (SurveyName, Page1Response, Page2Response, Page3Response, Page4Response, Page5Response, Page6Response, Page7Response, Page8Response, Page9Response) VALUES ('TestSurvey', ?, ?, ?, ?, ?, ?, ?, ?, ?);";


    if ($statement = mysqli_prepare($link, $sql))
    {
        echo "Statement Prepared.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "sssssssss", $B1Title, $B2Title, $B3Title, $B4Title,
        $B5Title, $B6Title, $B7Title, $B8Title, $CBTitle);

        $B1Title = $finalBenefitArray[0]->BenefitIndex;
        $B2Title = $finalBenefitArray[1]->BenefitIndex;
        $B3Title = $finalBenefitArray[2]->BenefitIndex;
        $B4Title = $finalBenefitArray[3]->BenefitIndex;
        $B5Title = $finalBenefitArray[4]->BenefitIndex;
        $B6Title = $finalBenefitArray[5]->BenefitIndex;
        $B7Title = $finalBenefitArray[6]->BenefitIndex;
        $B8Title = $finalBenefitArray[7]->BenefitIndex;
        $CBTitle = $chiefBenefit->BenefitIndex;
            
        echo "  B1 = " . $B1Title;
        echo "  B2 = " . $B2Title;
        echo "  B3 = " . $B3Title;
        echo "  B4 = " . $B4Title;
        echo "  B5 = " . $B5Title;
        echo "  B6 = " . $B6Title;
        echo "  B7 = " . $B7Title;
        echo "  B8 = " . $B8Title;
        echo "  CB = " . $CBTitle;
        // Set parameters
        //$param_username = trim($_POST["username"]);
            
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            echo "Statement Executed.";
            
            session_start();
            $_SESSION["pageNumber"] = 0;
            $_SESSION["finalBenefitArray"] = array();

        }
        session_start();
            $_SESSION["pageNumber"] = 0;
            $_SESSION["finalBenefitArray"] = array();
    }
}


class Benefit
{
    public $BenefitText;
    public $BenefitImage;
    public $BenefitLabel;
    public $BenefitIndex;

    function __construct()
    {
        $this->BenefitText = "BenefitText";
        $this->BenefitImage = "./Assets";
        $this->BenefitLabel = "Benefit Title";
        $this->BenefitIndex = "";
        //echo $BenefitText;
        //$BeneiftScore = 0;
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


    /*.BenefitsCollection {
        height: 800px;
    }*/

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
            <!--<div class='BenefitRow row'>-->
                <button id='BB1' name='BenefitButton' value='1' class='Benefit col-sm-3' type='submit'>
                    <div id='BL1' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[0]->BenefitLabel ?></div>
                    </div>
                    <div id='BC1' class='row'>
                        <img id='BI1' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[0]->BenefitImage ?>'></img>
                        <div id='BT1' class='BenefitText col-md-6'><?php echo $finalBenefitArray[0]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button id='BB2' name='BenefitButton' value='2' class='Benefit col-sm-3' type='submit'>
                    <div id='BL2' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[1]->BenefitLabel ?></div>
                    </div>
                    <div id='BC2' class='row'>
                        <img id='BI2' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[1]->BenefitImage ?>'></img>
                        <div id='BT2' class='BenefitText col-md-6'><?php echo $finalBenefitArray[1]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button id='BB3' name='BenefitButton' value='3' class='Benefit col-sm-3' type='submit'>
                    <div id='BL3' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[2]->BenefitLabel ?></div>
                    </div>
                    <div id='BC3' class='row'>
                        <img id='BI3' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[2]->BenefitImage ?>'></img>
                        <div id='BT3' class='BenefitText col-md-6'><?php echo $finalBenefitArray[2]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button id='BB4' name='BenefitButton' value='4' class='Benefit col-sm-3' type='submit'>
                    <div id='BL4' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[3]->BenefitLabel ?></div>
                    </div>
                    <div id='BC4' class='row'>
                        <img id='BI4' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[3]->BenefitImage ?>'></img>
                        <div id='BT4' class='BenefitText col-md-6'><?php echo $finalBenefitArray[3]->BenefitText ?></div>
                        
                    </div>
                </button>
            <!--</div>-->
            <!--<div class='BenefitRow row'>-->
                <button id='BB5' name='BenefitButton' value='5' class='Benefit col-sm-3' type='submit'>
                    <div id='BL5' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[4]->BenefitLabel ?></div>
                    </div>
                    <div id='BC5' class='row'>
                        
                        <img id='BI5' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[4]->BenefitImage ?>'></img>
                        <div id='BT5' class='BenefitText col-md-6'><?php echo $finalBenefitArray[4]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button  id='BB6' name='BenefitButton' value='6' class='Benefit col-sm-3' type='submit'>
                    <div id='BL6' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[5]->BenefitLabel ?></div>
                    </div>
                    <div id='BC6' class='row'>
                        <img id='BI6' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[5]->BenefitImage ?>'></img>
                        <div id='BT6' class='BenefitText col-md-6'><?php echo $finalBenefitArray[5]->BenefitText ?></div>
                    </div>
                </button>
                <button id='BB7' name='BenefitButton' value='7' class='Benefit col-sm-3' type='submit'>
                    <div id='BL7' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[6]->BenefitLabel ?></div>
                    </div>
                    <div id='BC7' class='row'>
                        <img id='BI7' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[6]->BenefitImage ?>'></img>
                        <div id='BT7' class='BenefitText col-md-6'><?php echo $finalBenefitArray[6]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button id='BB8' name='BenefitButton' value='8' class='Benefit col-sm-3' type='submit'>
                    <div id='BL8' class='row'>
                        <div class='BenefitTitle'><?php echo $finalBenefitArray[7]->BenefitLabel ?></div>
                    </div>
                    <div id='BC8' class='row'>
                        <img id='BI8' class='BenefitImage col-md-6' src='<?php echo $finalBenefitArray[7]->BenefitImage ?>'></img>
                        <div id='BT8' class='BenefitText col-md-6'><?php echo $finalBenefitArray[7]->BenefitText ?></div>
                        
                    </div>
                </button>
            <!--</div>-->
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
                    var currentParent = document.getElementById('BB'.concat(i+1));
                    currentParent.appendChild(document.getElementById('BL'.concat(indexArray[i]+1)).cloneNode(true));
                    currentParent.appendChild(document.getElementById('BC'.concat(indexArray[i]+1)).cloneNode(true));
                }
                for (var i = 0; i < 4; i++)
                {
                    var currentParent = document.getElementById('BB'.concat(i + 1));
                    currentParent.removeChild(currentParent.firstChild);
                    currentParent.removeChild(currentParent.firstChild);
                    currentParent.removeChild(currentParent.firstChild);
                    currentParent.removeChild(currentParent.firstChild);
                }
        </script>
    </div>
    <footer>Page: <?php echo $pageNumber?></footer>
</body>
</html>