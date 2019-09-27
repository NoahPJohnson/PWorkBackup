<?php


require_once "WebSurveyConfig.php";

session_start();
$_SESSION['page'] = $_GET['page'];

if (!isset($_SESSION['surveyid']))
{
    $_SESSION['surveyid'] = $_GET["surveyid"];
}

if (!isset($_SESSION["surveyjsonfile"]))
{
    $_SESSION["surveyjsonfile"] = $_GET["surveyname"] . ".json";
    if (isset($_SESSION["surveyname"]))
    {
        $surveyName = $_SESSION["surveyname"];
    }
    else
    {
        $surveyName = $_GET["surveyname"];
    }
    $surveyJSONFile = $_SESSION["surveyjsonfile"];
}
else
{
    if (isset($_SESSION["surveyname"]))
    {
        $surveyName = $_SESSION["surveyname"];
    }
    else
    {
        $surveyName = $_GET["surveyname"];
    }
    $surveyJSONFile = $_SESSION["surveyjsonfile"];
}

if (!isset($surveyName) || $surveyName == "")
{
    header("location: SurveyLogout.php");
}
//echo " :( " . var_dump($_SESSION);

require_once "SurveyHeader.php";

require_once "UploadFileFunction.php";


class Benefit
{
    public $BenefitText;
    public $BenefitImage;
    public $BenefitLabel;
    public $BenefitIndex;

    function __construct()
    {
        $this->BenefitText = "BenefitText";
        $this->BenefitImage = "./Assets/";
        $this->BenefitLabel = "Benefit Title";
        $this->BenefitIndex = "";
    }
}




$jsonData = file_get_contents($surveyJSONFile);
$pageArray = json_decode($jsonData);

if (!isset($pageArray) || $pageArray == NULL)
{
    echo "page array is empty";
    $pageArray = array();/*json_decode($jsonData);*/
    for ($i = 0; $i < 8; $i += 1)
    {
        $benefitArray = array();
        for ($j = 0; $j < 4; $j += 1)
        {
            $benefitArray[] = new Benefit();
        }
        $benefitArray[0]->BenefitIndex = ($i+1) . "-a";
        $benefitArray[1]->BenefitIndex = ($i+1) . "-b";
        $benefitArray[2]->BenefitIndex = ($i+1) . "-c";
        $benefitArray[3]->BenefitIndex = ($i+1) . "-d";
        $pageArray[] = $benefitArray;
    }
    $jsonDataOutput = json_encode($pageArray);
    file_put_contents($surveyJSONFile, $jsonDataOutput);
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    
}


    if (isset($_SESSION["page"]))
    {
        //echo "The Page is " . $_SESSION["page"];

        if ($_SESSION["page"] == "title")
        {
            $pageNumber = $_SESSION["page"];
            if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
            {
                require_once "WebSurveyTitlePage.php";
            }
            else
            {
                require_once "TakeSurveyTitlePage.php";
            }
        }
        else
        {
            $pageNumber = $_SESSION["page"];
            if ($_SESSION["page"] == 8)
            {
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
                {
                    require_once "WebSurveyFinalBenefitPage.php";
                }
                else
                {
                    require_once "TakeSurveyFinalBenefitPage.php";
                }
            }
            else if ($_SESSION["page"] == 9)
            {
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
                {
                    require_once "WebSurveyEssayPage.php";
                }
                else
                {
                    require_once "TakeSurveyEssayPage.php";
                }
            }
            else
            {
                if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
                {
                    require_once "WebSurveyPage.php";
                }
                else
                {
                    require_once "TakeSurveyPage.php";
                }
            }
        }
    }
    else
    {
        $finalBenefitArray = array();
        $pageNumber = 'title';
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true)
        {
            require_once "WebSurveyTitlePage.php";
        }
        else
        {
            require_once "TakeSurveyTitlePage.php";
        }
    }


require_once "SurveyFooter.php";

?>