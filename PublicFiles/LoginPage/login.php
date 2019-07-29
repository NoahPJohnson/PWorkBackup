<?php
// Initialize the session
session_start();
global $wpdb;
// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

require_once "$root/TLCinsurance/wp-config.php";

$username = "";
$password = "";
$username_err = "";
$password_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
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
        $sql = "SELECT UserID, Username, Password, Activated FROM 08a_UserLoginTable WHERE Username =  %s";
        $results = $wpdb->get_row($wpdb->prepare($sql, $username), ARRAY_A);
        //If the preparation operation is successful...
        //echo "Results: " . count($results);
        //echo var_dump($results);
        if ($results)
        {
                        //echo "Password: " . $results["Password"];
                        if (password_verify($password, $results["Password"]))
                        {
                            if ($results["Activated"] == true)
                            {
                                // Password is correct, so start a new session
                                session_start();
                            
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $results["UserID"];
                                $_SESSION["username"] = $results["Username"];                            
                                //echo "LOGGED IN!!";
                                echo "<script>document.location = '/TLCinsurance/agent-home-access/';</script>";  
                                //$_SESSION["loggedin"] = false;                              
                            }
                            else
                            {
                                //echo "Please verifiy account by clicking link in email.";
                            }
                        } 
                        else
                        {
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
        }
        /*else
        {
            echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error . " | " . $link;
        }*/
        
    }
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
            <input type="button" class="btn btn-primary ForgotButton" value="Forgot Password?" onClick="document.location.href='./forgotPassword.php'">
        </div>
    </div>    
</body>
</html>