<?php

// Initialize the session
session_start();
global $wpdb;
// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

require_once "$root/TLCinsurance/wp-config.php";
require_once "$root/TLCinsurance/npjFiles/sendMail2.php";

$username = "";
$email = "";
$email_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Check if username is empty
    if (empty(trim($_POST["username"])))
    {
        $username_err = "Please enter email.";
    } 
    else
    {
        //Save value to username variable
        $username = trim($_POST["username"]);
    }
    
    
    /*if (empty(trim($_POST["email"])))
    {
        $email_err = "Please enter email.";
    } 
    else
    {
        //Save value to username variable
        $email = trim($_POST["email"]);
    }*/

    $newPassword = bin2hex(random_bytes(10));
    //$newPassword = "Pr0digal1!";
    //echo "Pass = " . $newPassword . "    ";
    $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
    //echo "Hashed Pass = " . $hashedNewPassword;
    //$sqlQuery = "UPDATE 08a_UserLoginTable SET Password = %s WHERE Username = %s";
    //$wpdb->query($wpdb->prepare($sqlQuery,$hashedNewPassword,$username));
    $sqlQuery2 = "SELECT Email FROM 08a_UserLoginTable WHERE Username = %s";
    $email = $wpdb->get_var($wpdb->prepare($sqlQuery2,$username));
    $emailMessage = "Password is: " . $newPassword;


    SendAnEmail($email,"Test Forgot Password",$emailMessage);

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
</head>
<body>
    <div class="wrapper">
    <!--action="/TLCinsurance/agent-home/"-->
        <form action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post">
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="username" placeholder="Username" id="UsernameField" class="form-control TextField" value="<?php echo $email; ?>">
                <p class="help-block"><?php echo $email_err; ?></p>
            </div>  
            <!--<div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <input type="text" name="email" placeholder="Email" id="EmailField" class="form-control TextField" value="<?php echo $email; ?>">
                <p class="help-block"><?php echo $email_err; ?></p>
            </div>-->    
            <div class="form-group">
                <input type="submit" class="btn btn-primary LoginButton" value="Send Email">
            </div>
        </form>
    </div>    
</body>
</html>