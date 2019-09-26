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
$password = "";
$username_err = "";
$password_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if (!empty(trim($_POST["usernameOrEmail"])))
    {
            //Save value to usernameOrEmail variable
            $usernameOrEmail = trim($_POST["usernameOrEmail"]);

            $newPassword = bin2hex(random_bytes(10));
            $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            //echo "Hashed Pass = " . $hashedNewPassword;
            //$sqlQuery = "UPDATE 08a_UserLoginTable SET Password = %s WHERE Username = %s";
            //$wpdb->query($wpdb->prepare($sqlQuery,$hashedNewPassword,$username));
            $sqlQuery = "SELECT Email FROM 08a_UserLoginTable WHERE Username = %s OR Email = %s";
            $email = $wpdb->get_var($wpdb->prepare($sqlQuery,$usernameOrEmail, $usernameOrEmail));
            if ($email)
            {
                $sqlQuery = "UPDATE 08a_UserLoginTable SET Password = %s WHERE Username = %s OR Email = %s";
                $wpdb->query($wpdb->prepare($sqlQuery,$hashedNewPassword,$usernameOrEmail, $usernameOrEmail));
                //echo "Email = " . $email;
                $emailMessage = "Password is: " . $newPassword;

                SendAnEmail($email,"Test Forgot Password",$emailMessage);
            }
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
                        /*echo '<style type="text/css">
                            #wp-megamenu-item-204939 {
                                display: none;
                            }

                            </style>';*/
                        /*echo "<script type='text/javascript'>
                            document.getElementById('wp-megamenu-item-204939').style.display='none';
                            document.getElementById('wp-megamenu-item-204939').classList.add('hideMenuItem');
                            alert('logged in: ' + document.getElementById('wp-megamenu-item-204939').classList);
	                        document.getElementById('wp-megamenu-item-205692').style.display='none';
	                        document.getElementById('wp-megamenu-item-206544').style.display='block';
	                        document.getElementById('wp-megamenu-item-206547').style.display='block';
	                        document.getElementById('wp-megamenu-item-206258').style.display='block';
                            </script>";*/



                            /*if ($_SESSION["loggedin"] == true)
{
    echo "<script>
    alert('Logged in');
    document.getElementById('wp-megamenu-item-204939').classList.add('hideMenuItem');
    document.getElementById('wp-megamenu-item-205692').classList.add('hideMenuItem');
                            
    document.getElementById('wp-megamenu-item-206544').classList.remove('hideMenuItem');
    document.getElementById('wp-megamenu-item-206547').classList.remove('hideMenuItem');
    document.getElementById('wp-megamenu-item-206258').classList.remove('hideMenuItem');
    </script>";
                            
}
else
{
    echo "<script>
    document.getElementById('wp-megamenu-item-204939').classList.remove('hideMenuItem');
    document.getElementById('wp-megamenu-item-205692').classList.remove('hideMenuItem');
                            
    document.getElementById('wp-megamenu-item-206544').classList.add('hideMenuItem');
    document.getElementById('wp-megamenu-item-206547').classList.add('hideMenuItem');
    document.getElementById('wp-megamenu-item-206258').classList.add('hideMenuItem');
    </script>";
                            
}*/
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
        }
    }
}

session_start();

if (isset($_SESSION["loggedin"]))
{
    if ($_SESSION["loggedin"] == 1)
    { 
?>
        
        <script type="text/javascript">
        var loggedIn = true;
        </script>
<?php
    }
    else
    { 
?>
        <script type="text/javascript">
        var loggedIn = false;
        </script>
<?php
    }
                     
}
else
{
?>
    <script>
    var loggedIn = false;
    </script>
<?php
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .hiddenContent {
            display: none;
        }
    </style>
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
            <!--<h6>Forgot Password? <a href="../forgotPassword.php">Reset Password.</a></h6>-->
             
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
        <div>
            <h6>Don't have an account? <a href="become-an-agent/">Become an Agent.</a></h6> 
        </div>
    </div>    
</body>
</html>