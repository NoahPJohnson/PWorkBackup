<?php


//echo "HEEEY: " . mysqli_get_host_info($link);
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    echo "Start.";
    $pageNumber = 0;
    //location("header: SurveyIndex.php?page=" . $pageNumber);
    echo "<script>document.location = './SurveyIndex.php?surveyname=" . $surveyName . "&page=" . $pageNumber . "';</script>"; 
}

?>

    <header>Survey: Title Page</header>
    <div class='SurveyPage'>
        <div class='container-fluid'>
            <form class='BenefitsCollection col' id='surveyForm' action='<?php echo htmlspecialchars($_SERVER[""]); ?>' method='post' enctype="multipart/form-data">
                <div class='row' style='text-align:center;'>
                    <h1 id='TitleInput' class='col-md-12' name='SurveyTitleValue'></h1>
                </div>
                <div class='row' style='text-align:center;'>
                    <input type='submit' id='StartSurveyButton' class='col-md-12' value='Start Survey'>
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
        <!--<script type='text/javascript' src='ParseSurveyJSON.js'></script>-->
        <script>

        </script>