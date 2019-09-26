<?php


//echo "HEEEY: " . mysqli_get_host_info($link);
if (isset($_POST["submit"]))
{
    //var_dump($_POST);
    /*UploadFile();
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
    file_put_contents($surveyJSONFile, $jsonDataOutput);*/
}

?>

    <header>Survey: Title Page</header>
    <div class='SurveyPage'>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER[""]); ?>' method='post' enctype="multipart/form-data">
                <div class='row' style='text-align:center;'>
                    <h1 id='TitleInput' class='col-md-12' name='SurveyTitleValue'></h1>
                </div>
            </form>
        </div>
        <script type='text/javascript'>
            var pageNumber = '<?php echo $pageNumber; ?>';
            var surveyJSONFile = '<?php echo $surveyJSONFile; ?>';

            for (var i = 0; i < 10; i += 1)
            {

                document.getElementsByClassName("navMenuItem")[1+i].style.visibility = 'hidden';
            }

            document.getElementById('TitleInput').innerHTML = '<?php echo $surveyName; ?>';
        </script>
        <script type='text/javascript' src='ParseSurveyJSON.js'></script>
        <script>

        </script>