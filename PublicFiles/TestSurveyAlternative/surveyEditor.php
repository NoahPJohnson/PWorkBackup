<?php


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
            <div class='BenefitRow row'>
                <button id='BB1' name='BenefitButton' value='1' class='Benefit col-md-5' type='submit'>
                    <div id='BL1' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][0]->BenefitLabel ?></div>
                    </div>
                    <div id='BC1' class='row'>
                        <img id='BI1' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][0]->BenefitImage ?>'></img>
                        <div id='BT1' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][0]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button id='BB2' name='BenefitButton' value='2' class='Benefit col-md-5' type='submit'>
                    <div id='BL2' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][1]->BenefitLabel ?></div>
                    </div>
                    <div id='BC2' class='row'>
                        <img id='BI2' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][1]->BenefitImage ?>'></img>
                        <div id='BT2' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][1]->BenefitText ?></div>
                        
                    </div>
                </button>
            </div>
            <div class='BenefitRow row'>
                <button id='BB3' name='BenefitButton' value='3' class='Benefit col-md-5' type='submit'>
                    <div id='BL3' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][2]->BenefitLabel ?></div>
                    </div>
                    <div id='BC3' class='row'>
                        
                        <img id='BI3' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][2]->BenefitImage ?>'></img>
                        <div id='BT3' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][2]->BenefitText ?></div>
                        
                    </div>
                </button>
                <button  id='BB4' name='BenefitButton' value='4' class='Benefit col-md-5' type='submit'>
                    <div id='BL4' class='row'>
                        <div class='BenefitTitle'><?php echo $pageArray[$pageNumber][3]->BenefitLabel ?></div>
                    </div>
                    <div id='BC4' class='row'>
                        <img id='BI4' class='BenefitImage col-md-6' src='<?php echo $pageArray[$pageNumber][3]->BenefitImage ?>'></img>
                        <div id='BT4' class='BenefitText col-md-6'><?php echo $pageArray[$pageNumber][3]->BenefitText ?></div>
                    </div>
                </button>
            </div>
        </form>
    </div>
    <footer>Page: <?php echo $pageNumber?></footer>
</body>
</html>