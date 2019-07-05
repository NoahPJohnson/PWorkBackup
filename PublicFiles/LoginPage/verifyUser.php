<?php

require_once "config.php";

session_start();
if (isset($_GET['verificationCode'])) 
{
    $verificationCode = $_GET['verificationCode'];
    $sql = "SELECT * FROM UserTable WHERE verificationCode = ? LIMIT 1";

    $statement = mysqli_prepare($link, $sql);
    //If the preparation operation is successful...
    if ($statement)
    {
        //echo "Successfully Prepared Statement.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "s", $parameter_VCode);
        
        // Set parameters
        $parameter_VCode = $verificationCode;
            
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            // Store result
            mysqli_stmt_store_result($statement);       
            if (mysqli_stmt_num_rows($statement) > 0)
            {                    
                // Bind result variables
                mysqli_stmt_bind_result($statement, $id);
                if (mysqli_stmt_fetch($statement))
                {
                    $_SESSION['id'] = $id;
                }
            }
        }
    }       
    mysqli_stmt_close($statement);
                    
    $sql = "UPDATE UserTable SET Activated = 1 WHERE UserID = ? LIMIT 1";
                    
    $statement = mysqli_prepare($link, $sql);

    if ($statement)
    {
        mysqli_stmt_bind_param($statement, "s", $parameter_ID)
        
        $parameter_ID = $_SESSION['id'];
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_store_result($statement);
            echo "EMAIL VERIFIED.";
            //header('location: login.php');
        }
        
    }
}
?>