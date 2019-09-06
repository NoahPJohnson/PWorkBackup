<?php
//This is a page for testing a secure upload of data to a database


// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
{
    header("location: login.php");
    exit;
}
 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$dataList = array("id" => 000000, "name" => "", "lastName" => "", "pInfoInt" => 000000, "pInfoString" => "");

$errorList = array("idError" => "", "nameError" => "", "lastNameError" => "", "pInfoIntError" => "", "pInfoStringError" => "");

$requiredList = array(false, true, true, false, true);
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
 
    // Check if required fields are empty
    for ($i = 0; $i < count($requiredList); $i += 1)
    {
        if ($requiredList[$i] == true)
        {
            if ($dataList[$i] == "")
            {
                $errorList[$i] = "The " . key($dataList[$i]) . " field is required and cannot be empty.";
            }
        }
    }

    // Validate credentials
    $errorOccured = false;
    for ($i = 0 ; $i < count($errorList); $i += 1)
    {
        if (!empty($errorList[$i]))
        {
            $errorOccured = true;
            break;
        }
    }

    if ($errorOccured == false)
    {
        // Prepare a select statement
        $sql = "SELECT id FROM PersonalInfoTable WHERE pInfoInt = ?";
        echo "Statement Created.";
        $statement = mysqli_prepare($link, $sql);
        if ($statement)
        {
            echo "Statement Prepared.";
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement, "s", $parameter);
            
            // Set parameters
            $parameter = trim($_POST["pInfoInt"]);
            
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement))
            {
                echo "Statement Executed.";
                /* store result */
                mysqli_stmt_store_result($statement);
                
                if(mysqli_stmt_num_rows($statement) == 1)
                {
                    $errorList[3] = "This user's information is already entered.";
                } 
                else
                {
                    $dataList[1] = trim($_POST["name"]);
                    $dataList[2] = trim($_POST["lastName"]);
                    $dataList[3] = trim($_POST["pInfoInt"]);
                    $dataList[4] = trim($_POST["pInfoString"]);
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
    
        // Prepare an insert statement
        $sql = "INSERT INTO PersonalInfoTable (name,lastName,pInfoInt,pInfoString) VALUES (?, ?, ?, ?)";
             
            if($statement = mysqli_prepare($link, $sql))
            {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($statement, "ssss", $parameter_name, $parameter_lastName, $parameter_pInfoInt, $parameter_pInfoString);
                
                // Set parameters to hashed values of the data
                $parameter_name = password_hash($dataList[1], PASSWORD_DEFAULT);
                $parameter_lastName = password_hash($dataList[2], PASSWORD_DEFAULT); // Creates a password hash
                $parameter_pInfoInt = password_hash($dataList[3], PASSWORD_DEFAULT);
                $parameter_pInfoString = password_hash($dataList[4], PASSWORD_DEFAULT);
                
                // Attempt to execute the prepared statement
                if(mysqli_stmt_execute($statement))
                {
    
                    // Redirect to login page
                    //header("location: login.php");
                    echo "User's information encrypted and posted successfully.";
                } 
                else
                {
                    echo "Something went wrong. Please try again later.";
                }
            }
             
            // Close statement
            mysqli_stmt_close($statement);
        }
    }
    // Close connection
    mysqli_close($link);

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
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Form</h2>
        <p>Please fill in your client's credentials.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($errorList[1])) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $dataList[1]; ?>">
                <span class="help-block"><?php echo $errorList[1]; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($errorList[2])) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="text" name="lastName" class="form-control" value="<?php echo $dataList[2]; ?>">
                <span class="help-block"><?php echo $errorList[2]; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($errorList[3])) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="pInfoInt" class="form-control">
                <span class="help-block"><?php echo $errorList[3]; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($errorList[4])) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="pInfoString" class="form-control">
                <span class="help-block"><?php echo $errorList[4]; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>    
</body>
</html>