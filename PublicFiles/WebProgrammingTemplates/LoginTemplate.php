<?php
// Initialize the session
/*session_start();

// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
require_once "ConfigurationTemplate.php";*/
require_once "ForgotPasswordTemplate.php";


$username = "";
$password = "";
$username_err = "";
$password_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty(trim($_POST["usernameOrEmail"])))
    {
        //Save value to usernameOrEmail variable
        ForgotPassword(trim($_POST["usernameOrEmail"]));
    }
    else
    {
 
        // Check if username is empty
        if (empty(trim($_POST["username"])))
        {
            $username_err = "Please enter username.";
        } 
        else
        {
            //Save value to username variable
            $username = trim($_POST["username"]);
        }
    
        // Check if password is empty
        if (empty(trim($_POST["password"])))
        {
            $password_err = "Please enter your password.";
        } 
        else
        {
            //Save value to password variable
            $password = trim($_POST["password"]);
        }
    
        // Validate credentials
        if (empty($username_err) && empty($password_err))
        {
            // Prepare a select statement
            //echo "Query database";
            $sql = "SELECT UserID, username, password FROM UserTable WHERE username = ?";
            $statement = mysqli_prepare($link, $sql);
            if ($statement)
            {
                //echo "Successfully Prepared Statement.";
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($statement, "s", $param_username);
        
                // Set parameters
                $param_username = $username;
        
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($statement))
                {
                    // Store result
                    mysqli_stmt_store_result($statement);
            
                    // Check if username exists, if yes then verify password
                    if (mysqli_stmt_num_rows($statement) >= 1)
                    {                    
                        // Bind result variables
                        if (mysqli_stmt_bind_result($statement, $resultUserID, $resultUsername, $hashedPassword))
                        {
                        
                            if(mysqli_stmt_fetch($statement))
                            {   
                                //echo "ID: " . $resultUserID;
                                //echo "Username: " . $resultUsername;
                                //echo "Password: " . $hashedPassword;
                                if (password_verify($password, $hashedPassword))
                                {
                                    // Password is correct, so start a new session
                                    session_start();
                            
                                    // Store data in session variables
                                    $_SESSION["loggedin"] = true;
                                    $_SESSION["id"] = $resultUserID;
                                    $_SESSION["username"] = $resultUsername;                            
                                    //echo "LOGGED IN!!";
                                    //header("location: WelcomeTemplate.php");
                                    echo "<script>document.location = '/npjTest/Templates/IndexTemplate.php?page=welcome';</script>";  
                                    //$_SESSION["loggedin"] = false;                              
                                } 
                                else
                                {
                                    // Display an error message if password is not valid
                                    $password_err = "The password you entered was not valid.";
                                }
                            }
                        }
                        else
                        {
                            //echo "bind failed.";
                        }
                    }
                    else
                    {
                        //echo "user doesn't exist.";
                    }
                }
                else
                {
                    //echo "execute fail.";
                }
            }
            else
            {
                //echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . " | " . $link;
            }        
        }   
    }

    
}

//require_once "TopMenuTemplate.php";

?>
 
<!--<!DOCTYPE html>
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
<body>-->
<div class='Page'>
    <div class="wrapper">
    <!--action="/TLCinsurance/agent-home/"-->
        <form action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                
                <input type="text" name="username" placeholder="Username" id="UsernameField" class="form-control TextField" value="<?php echo $username; ?>">
                <p class="help-block"><?php echo $username_err; ?></p>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                
                <input type="password" name="password" placeholder="Password" id="PasswordField" class="form-control TextField">
                <p class="help-block"><?php echo $password_err; ?></p>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary LoginButton" value="Login">
            </div>
            <h6>Don't have an account? <a href="register.php">Sign up now</a></h6>  
        </form>
        <div>
            <input type="button" class="btn btn-primary ForgotButton" value="Forgot Password?" onClick="openForgotForm()">
            <script>
                function openForgotForm()
                {
                    document.getElementById("ForgotForm").classList.remove("hiddenContent");
                }
            </script>
        </div>
        <div>
            <form id="ForgotForm" class="hiddenContent" action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post">
                <div class="form-group">
                    <input type="text" name="usernameOrEmail" placeholder="Username or Email" id="ForgotField" class="form-control TextField">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary ForgotButton" value="Send Recovery Email">
                </div>
            </form>
        </div>
    </div>    