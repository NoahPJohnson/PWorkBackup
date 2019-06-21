<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{

    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "unityPHPConfig.php";
//echo "Welcome.";
// Processing form data when form is submitted
// Prepare a select statement
$sql = "SELECT * FROM NAICSCodeTable";
$statement = mysqli_prepare($link, $sql);
if ($statement)
{
    //echo "Successfully Prepared Statement.";
        // Bind variables to the prepared statement as parameters
        //mysqli_stmt_bind_param($statement, "s", $param_username);
        
        // Set parameters
        //$param_username = $username;
        
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($statement))
    {
        // Store result
        //mysqli_stmt_store_result($statement);
            
        // Check if username exists, if yes then verify password
        //if (mysqli_stmt_num_rows($statement) >= 1)
        //{                    
                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $NAICSCode, $Title, $Description, $MasterCategory))
                {
                    $count = 0;
                    while (mysqli_stmt_fetch($statement))
                    {
                        $count += 1;
                        echo $NAICSCode . " | " . $Title . " | " . $Description . " | " . $MasterCategory . "~";
                    
                    }
                }
                else
                {
                    echo "Bind failed.";
                }
        //} 
        //else
        //{
                // Display an error message if username doesn't exist
                //$username_err = "No account found with that username.";
        //    echo "No Rows in the statement."
        //}
    } 
    else
    {
        echo "Oops! Something went wrong. Please try again later.";
    }
}
else
{
    echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
}
    
// Close statement
mysqli_stmt_close($statement);
mysqli_close($link);
?>