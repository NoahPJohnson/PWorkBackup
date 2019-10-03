<?php

require_once "WebSurveyConfig.php";

session_start();
if (isset($_SESSION["surveyname"]))
{
    unset($_SESSION["surveyname"]);
}

if (isset($_SESSION["surveyjsonfile"]))
{
    unset($_SESSION["surveyjsonfile"]);
}

// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: SurveyLogin.php");
    //echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;
}

//echo "OwnerID = " . $_SESSION["id"];

 
// Define variables and initialize with empty values
$userID = "";
$email = "";
$surveyName = "";

$row = array("SurveyOwnerID" => $surveyOwnerID, "Email" => $email, "SurveyName" => $surveyName);
$table = array();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $insertOk = true;
    $sqlQuery = "SELECT SurveyName FROM SurveyBuildTable WHERE SurveyOwnerID = ?";
    $statement = mysqli_prepare($link, $sql);
    if ($statement)
    {
        //echo "Successfully Prepared Statement.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "s", $param_ownerID);

        // Set parameters
        $param_ownerID = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            // Store result
            mysqli_stmt_store_result($statement);
    
            // Check if username exists, if yes then verify password
            if (mysqli_stmt_num_rows($statement) >= 1)
            {
                echo "Error: that survey name is already used in another survey associated with this account.";
                $insertOk = false;
            }

        }
    }
    if ($insertOk == true)
    {
        $sqlQuery = "INSERT INTO SurveyBuildTable (SurveyOwnerID, SurveyName) VALUES (?, ?)";
        if ($statement = mysqli_prepare($link, $sqlQuery))
        {
            //echo "Next statement prepared.";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement, "ss", $param_ownerID, $param_surveyName);
            
            // Set parameters
            $param_ownerID = $_SESSION["id"];
            $param_surveyName = filter_input(INPUT_POST, "NewSurveyName", FILTER_SANITIZE_STRING);//trim($_POST["NewSurveyName"]);
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement))
            {
                $_SESSION["surveyname"] = $param_surveyName;

                
                $fileManager = fopen($_SESSION["surveyname"] . '.json', 'w');
                fwrite($fileManager, json_encode (json_decode ("")));
                fclose($fileManager);

                $sqlQuery = "SELECT SurveyID FROM SurveyBuildTable WHERE SurveyOwnerID = ? AND SurveyName = ?";
                if ($statement = mysqli_prepare($link, $sqlQuery))
                {
                    mysqli_stmt_bind_param($statement, "ss", $param_ownerID, $param_surveyName);
                    if (mysqli_stmt_execute($statement))
                    {
                        // Store result
                        mysqli_stmt_store_result($statement);
                        if (mysqli_stmt_bind_result($statement, $resultSurveyID))
                        {
                            if(mysqli_stmt_fetch($statement))
                            { 
                                $_SESSION["surveyid"] = $resultSurveyID;

                                location("header: SurveyIndex.php?surveyname=" . urlencode($_SESSION["surveyname"]) . "&surveyid=" . urlencode($_SESSION["surveyid"]));
                            }
                        }
                    }
                }   
            }
        }
    }   
}
    // Prepare a select statement
    //$sql = "SELECT 08a_UserLoginTable.username, 08a_UserLoginTable.Name, 08a_UserLoginTable.LastName, 08a_UserLoginTable.Email, 08a_CommissionTable.Date, 08a_CommissionTable.Value FROM 08a_CommissionTable INNER JOIN 08a_UserLoginTable ON 08a_CommissionTable.UserID = 08a_UserLoginTable.UserID WHERE 08a_CommissionTable.UserID = ?";
    $sqlQuery = "SELECT SurveyOwnerTable.SurveyOwnerID, SurveyOwnerTable.Email, SurveyBuildTable.SurveyID, SurveyBuildTable.SurveyName FROM SurveyOwnerTable INNER JOIN SurveyBuildTable ON SurveyBuildTable.SurveyOwnerID = SurveyOwnerTable.SurveyOwnerID WHERE SurveyBuildTable.SurveyOwnerID = ?";
    $statement = mysqli_prepare($link, $sqlQuery); 
    mysqli_stmt_bind_param($statement, "s", $id);
        // Set parameters
        $id = $_SESSION["id"];
        
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            
            // Store result
            mysqli_stmt_store_result($statement);
            if (mysqli_stmt_bind_result($statement, $resultSurveyOwnerID, $resultEmail, $resultSurveyID, $resultSurveyName))
            {
                $row = array();
                while (mysqli_stmt_fetch($statement))
                {
                    $row["SurveyID"] = $resultSurveyID;
                    $row["SurveyOwnerID"] = $resultSurveyOwnerID;
                    $row["Email"] = $resultEmail;
                    $row["SurveyName"] = $resultSurveyName;
                    $table[] = $row;
                }
            }
        }
    
    $_SESSION["Table"] = $table;
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
    <header>Surveys</header>
    <table class='CommissionTableDisplay'>
        <tr>
            <th>SurveyOwnerID</th><th>Email</th><th>SurveyName</th>
        </tr>
    <?php
    for ($i = 0; $i < count($table); $i += 1)
    {
    ?>
        <tr>
            <td width='110px'><?php echo htmlspecialchars($table[$i]["SurveyOwnerID"]); ?></td> 
            <td width='150px'><?php echo htmlspecialchars($table[$i]["Email"]); ?></td> 
            <td width='120px'>
                <a href='SurveyIndex.php?surveyname=<?php echo urlencode($table[$i]["SurveyName"]); ?>&surveyid=<?php echo urlencode($table[$i]["SurveyID"]); ?>'>
                    <?php echo urlencode($table[$i]["SurveyName"]); ?>
                </a>
            </td>
        </tr>
    <?php
    }
    ?>
    </table>

<form action="<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>" method="post">
    <div>
        <p>Survey Name: </p>
        <input type="text" name="NewSurveyName">
        <input type="submit" value="New Survey">
    </div>
</form>
</body>
   