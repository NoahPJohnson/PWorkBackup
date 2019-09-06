<?php
session_start();
require_once "surveyConfig.php";


if (isset($_SESSION["finalBenefitArray"]))
{
    echo "Good.";
    $finalBenefitArray = $_SESSION["finalBenefitArray"];
}
else
{
    echo "Bad.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();



    $sql = "INSERT INTO SurveyTable2 (SurveyName, Page1Response, Page2Response, Page3Response, Page4Response, Page5Response, Page6Response, Page7Response, Page8Response, Page9Response, ExtendedResponse) VALUES ('TestSurvey', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";
    echo $sql;

    if ($statement = mysqli_prepare($link, $sql))
    {
        echo "Statement Prepared.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "ssssssssss", $B1Title, $B2Title, $B3Title, $B4Title,
        $B5Title, $B6Title, $B7Title, $B8Title, $CBTitle, $EssayResponse);

        $B1Title = $finalBenefitArray[0]->BenefitIndex;
        $B2Title = $finalBenefitArray[1]->BenefitIndex;
        $B3Title = $finalBenefitArray[2]->BenefitIndex;
        $B4Title = $finalBenefitArray[3]->BenefitIndex;
        $B5Title = $finalBenefitArray[4]->BenefitIndex;
        $B6Title = $finalBenefitArray[5]->BenefitIndex;
        $B7Title = $finalBenefitArray[6]->BenefitIndex;
        $B8Title = $finalBenefitArray[7]->BenefitIndex;
        $CBTitle = $finalBenefitArray[8]->BenefitIndex;
        $EssayResponse = $_POST["EssayResponse"];
            
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
            $_SESSION["EssayResponse"] = "";

        }
        session_start();
            $_SESSION["pageNumber"] = 0;
            $_SESSION["finalBenefitArray"] = array();
            $_SESSION["EssayResponse"] = "";
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
    <header>Survey: Essay Question</header>
    <div class='Survey Page'>
        <div class='SurveyQuestion'>Please write a brief explanation for your final benefit choice.</div>
        <form class='container' action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method='post'>
            <input type="text" name="EssayResponse" class="form-control" value="<?php echo $EssayResponse; ?>">
            <button  id='EssayButton' name='EssaySubmit' class='btn' type="submit" value="Submit">
        </form>
     </div>
</body>