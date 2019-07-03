<?php

session_start();
 
// Check if the user is logged in, if not then redirect to login page
/*if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    header("location: login.php");
    exit;
}*/

 
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$username = "";
$name = "";
$lastName = "";
$email = "";
$date = "";
$value = "";

$row = array("username" => $username, "name" => $name, "lastName" => $lastName, "email" => $email, "date" => $date, "value" => $value);
$table = array();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // Prepare a select statement
    $sql = "SELECT UserTable.username, UserTable.Name, UserTable.LastName, UserTable.Email, CommissionTable.Date, CommissionTable.Value FROM CommissionTable INNER JOIN UserTable ON CommissionTable.UserID = UserTable.UserID WHERE CommissionTable.UserID = ?";
    $statement = mysqli_prepare($link, $sql);
    //If the preparation operation is successful...
    if ($statement)
    {
        echo "Successfully Prepared Statement.";
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "s", $parameter_ID);
        
        // Set parameters
        $parameter_ID = 1;//$_SESSION["id"];
            
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            // Store result
            mysqli_stmt_store_result($statement);       
            
            $rowCount = mysqli_stmt_num_rows($statement);
            // Bind result variables
            mysqli_stmt_bind_result($statement, $username, $name, $lastName, $email, $date, $value);
            if (mysqli_stmt_fetch($statement))
            {
                //start a new session
                session_start();
                
                // Store data in session variables

                for ($i = 0; $i < $rowCount; $i += 1)
                {
                    $row["username"] = $username;
                    $row["name"] = $name;
                    $row["lastName"] = $lastName;
                    $row["email"] = $email;
                    $row["date"] = $date;                           
                    $row["value"] = "$ " . $value;
                    
                    $table[] = $row;
                }
                $_SESSION["Table"] = $table;
                for ($i = 0; $i < $rowCount; $i += 1)
                {
                    echo "Row: " . $i . " = " . $table[$i]["username"] . ", " . $table[$i]["date"] . ", " . $table[$i]["value"];
                }
            }
        } 
        else
        {
            echo "Something went wrong. Please try again later.";
        }
    }
    else
    {
        echo "Prepare failed: (" . $mysqli->errno . ") " . $mysqli->error;
    }
        
        // Close statement
    mysqli_stmt_close($statement);
    
    // Close connection
    mysqli_close($link);
}

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
        <h2>Commissions</h2>
        <p>Commissions: </p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="GET Commissions">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>