<?php
// Include config file
require_once "config.php";

require_once "sendMail.php";
// Define variables and initialize with empty values
$username = "";
$password = "";
$confirm_password = "";
$email = "";
$username_err = "";
$password_err = "";
$confirm_password_err = "";
$email_error = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Validate username
    if (empty(trim($_POST["username"])))
    {
        $username_err = "Please enter a username.";
    } 
    else
    {
        // Prepare a select statement
        $sql = "SELECT UserID FROM UserTable WHERE username = ?";
        echo "Statement Created.";
        
        if ($statement = mysqli_prepare($link, $sql))
        {
            echo "Statement Prepared.";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement))
            {
                echo "Statement Executed.";
                /* store result */
                mysqli_stmt_store_result($statement);
                
                if(mysqli_stmt_num_rows($statement) == 1)
                {
                    $username_err = "This username is already taken.";
                } 
                else
                {
                    $username = trim($_POST["username"]);
                }
            } 
            else
            {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        else
        {
            echo "Preparing the statment failed? Statement = " . $statement;
        } 
        // Close statement
        mysqli_stmt_close($statement);
    }
    
    // Validate password
    if(empty(trim($_POST["password"])))
    {
        $password_err = "Please enter a password.";     
    } 
    elseif(strlen(trim($_POST["password"])) < 6)
    {
        $password_err = "Password must have atleast 6 characters.";
    } 
    else
    {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = "Please confirm password.";     
    } 
    else
    {
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password))
        {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate email
    if(empty(trim($_POST["email"])))
    {
        $email_error = "Please enter an email address.";     
    }
    else
    { 
        $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
        if ($email == false)
        {
            $email_error = "Email is invalid.";
        } 
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_error))
    {
        echo "No errors: Proceed.";
        // Prepare an insert statement
        $sql = "INSERT INTO UserTable (admin, username, password, Email, verificationCode, Activated) VALUES (0, ?, ?, ?, ?, 0)";
        
        
        if ($statement2 = mysqli_prepare($link, $sql))
        {
            echo "Next statement prepared.";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement2, "ssss", $param_username, $param_password, $parameter_email, $parameter_verificationCode);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $parameter_email = $email;
            $parameter_verificationCode = bin2hex(random_bytes(50));
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement2))
            {
                echo "Next statement executed, send Email.";
                // Redirect to login page
                echo "Pass: " . $param_password;
                //sendVerificationEmail($parameter_email, $parameter_verificationCode);
                //header("location: login.php");
            } 
            else
            {
                echo "Something went wrong. Please try again later.";
            }
        }
        else
        {
            echo "Statement not prepared. :[ statement = " . $statement2;
        }
         
        // Close statement
        mysqli_stmt_close($statement2);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body { 
            font: 14px sans-serif; 
        }
        .wrapper { 
            width: 350px; padding: 20px; 
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
                <span class="help-block"><?php echo $confirm_password_err; ?></span>
            </div>

            <div class="form-group <?php echo (!empty($email_error)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_error; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>