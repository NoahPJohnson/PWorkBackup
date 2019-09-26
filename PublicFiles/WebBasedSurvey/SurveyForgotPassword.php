<?php

// Initialize the session
//session_start();
global $wpdb;
// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

//require_once "$root/TLCinsurance/wp-config.php";
require_once "ConfigurationTemplate.php";
require_once "SendMailTemplate.php";

function ForgotPassword($inputUsernameOrEmail)
{
    //Save value to usernameOrEmail variable
    $usernameOrEmail = $inputUsernameOrEmail;

    $newPassword = bin2hex(random_bytes(10));
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    //echo "Hashed Pass = " . $hashedNewPassword;
    //$sqlQuery = "UPDATE 08a_UserLoginTable SET Password = %s WHERE Username = %s";
    //$wpdb->query($wpdb->prepare($sqlQuery,$hashedNewPassword,$username));
    $sqlQuery = "SELECT Email FROM UserTable WHERE username = ? OR Email = ?";
    $statement = mysqli_prepare($link, $sqlQuery);
    if ($statement)
    {
        //echo "Successfully Prepared Statement.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "ss", $param_usernameOrEmail, $param_usernameOrEmail);

        // Set parameters
        $param_usernameOrEmail = $usernameOrEmail;

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            // Store result
            mysqli_stmt_store_result($statement);

            // Check if username or email exists, if yes then verify password
            if (mysqli_stmt_num_rows($statement) >= 1)
            {                    
                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $resultEmail))
                {
            
                    if(mysqli_stmt_fetch($statement))
                    {
                        if ($resultEmail)
                        {
                            $sqlQuery = "UPDATE UserTable SET password = ? WHERE Email = ?";
                            $statement = mysqli_prepare($link, $sqlQuery);
                            if ($statement)
                            {
                                mysqli_stmt_bind_param($statement, "ss", $param_newPassword, $param_email);

                                $param_newPassword = $hashedNewPassword;
                                $param_email = $resultEmail;

                                if (mysqli_stmt_execute($statement))
                                {
                                    // Store result
                                    mysqli_stmt_store_result($statement);
                  
                                    // Bind result variables
                                    //if (mysqli_stmt_bind_result($statement, $resultEmail))
                                    //{
            
                                        //if(mysqli_stmt_fetch($statement))
                                        //{
                                            //echo "Email = " . $email;
                                            $emailMessage = "Password is: " . $newPassword;

                                            SendAnEmail($resultEmail,"Test Forgot Password",$emailMessage);
                                        //}
                                    //}
                                }
                            }
                        }
                    }
                }
            }
        }
    }
                        //$wpdb->query($wpdb->prepare($sqlQuery,$hashedNewPassword,$usernameOrEmail, $usernameOrEmail));

}
?>
