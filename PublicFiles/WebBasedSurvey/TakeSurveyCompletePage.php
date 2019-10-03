<?php 

session_destroy();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SurveyComplete</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
        

        .hiddenContent {
            display: none;
        }
    
    </style>
</head>
<body>
    <header>Survey Complete</header>
<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
    <div class='container-fluid'>
        <div class='col-md-8'>
            <p>The Survey is complete.</p>
        </div>

    </div>
</form>
</body>