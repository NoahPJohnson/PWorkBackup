<?php

session_start();

global $wpdb;

// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

require_once "$root/TLCinsurance/wp-config.php";


// Check if the user is logged in, if not then redirect to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    //header("location: login.php");
    echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;
}

 
// Include config file
//require_once "config.php";
 
// Define variables and initialize with empty values
$userID = "";
$username = "";
$name = "";
$lastName = "";
$email = "";
$carrier = "";
$date = "";
$toDate = "";
$value = "";
$receipt = "";

$row = array("userID" => $userID, /*"username" => $username,*/ "name" => $name, "lastName" => $lastName, "email" => $email, "carrier" => $carrier, "date" => $date, "toDate" => $toDate, "value" => $value, "receipt" => $receipt);
$table = array();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    session_start();
 
    // Unset all of the session variables
    $_SESSION = array();
 
    // Destroy the session.
    session_destroy();
 
    // Redirect to login page
    echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;

}
    // Prepare a select statement
    //$sql = "SELECT 08a_UserLoginTable.username, 08a_UserLoginTable.Name, 08a_UserLoginTable.LastName, 08a_UserLoginTable.Email, 08a_CommissionTable.Date, 08a_CommissionTable.Value FROM 08a_CommissionTable INNER JOIN 08a_UserLoginTable ON 08a_CommissionTable.UserID = 08a_UserLoginTable.UserID WHERE 08a_CommissionTable.UserID = ?";
    $sqlQuery = "SELECT 08a_UserLoginTable.UserID, 08a_UserLoginTable.Name, 08a_UserLoginTable.LastName, 08a_UserLoginTable.Email, 08a_CommissionTable.Carrier, 08a_CommissionTable.Date, 08a_CommissionTable.ToDate, 08a_CommissionTable.Value, 08a_CommissionTable.Receipt FROM 08a_CommissionTable INNER JOIN 08a_UserLoginTable ON 08a_CommissionTable.UserID = 08a_UserLoginTable.UserID WHERE 08a_CommissionTable.UserID = %d";
    //$statement = mysqli_prepare($link, $sql); 
    $results = $wpdb->get_results($wpdb->prepare($sqlQuery, $_SESSION["id"]));
    //$results = $wpdb->get_row($wpdb->prepare($sql, $username), ARRAY_A);
    //echo var_dump($results);
    foreach ($results as $resultRow)
    {
        $row["userID"] = $resultRow->UserID;
        //$row["username"] = $resultRow->Username;
        $row["name"] = $resultRow->Name;
        $row["lastName"] = $resultRow->LastName;
        $row["email"] = $resultRow->Email;
        $row["carrier"] = $resultRow->Carrier;
        $row["date"] = $resultRow->Date;
        $row["toDate"] = $resultRow->ToDate;
        $row["value"] = "$ " . $resultRow->Value;
        $row["receipt"] = "<a href=" . $rootURL . $resultRow->Receipt . " download>Download</a>";
        $table[] = $row;
        //echo "result row added to table.";
    }
    $_SESSION["Table"] = $table;
    echo "<table class='CommissionTableDisplay>'
              <tr>
                  <th>UserID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Carrier</th><th>Dates</th><th>Receipt</th>
              </tr>";

    for ($i = 0; $i < count($table); $i += 1)
    {
        echo "<tr>
                  <td width=\"110px\">" . $table[$i]["userID"] . "</td> <td width=\"150px\">" /*. $table[$i]["username"] . "</td> <td>"*/ . $table[$i]["name"] . "</td> <td width=\"140px\">" . $table[$i]["lastName"] 
                  . "</td> <td width=\"230px\">" . $table[$i]["email"] . "</td> <td width=\"120px\">" . $table[$i]["carrier"] . "</td> <td width=\"160px\">"
                  . date("y",strtotime($table[$i]["date"])) . "." . date("m",strtotime($table[$i]["date"])) . "." . date("d",strtotime($table[$i]["date"]))
                  . " \ " . date("y",strtotime($table[$i]["toDate"])) . "." . date("m",strtotime($table[$i]["toDate"])) . "." . date("d",strtotime($table[$i]["toDate"]))
                  . "</td> <td width=\"120px\">" . $table[$i]["receipt"] . "</td>
              </tr>";
        //echo "Row: " . $i . " = ". $table[$i]["username"] . ", " . $table[$i]["name"] . ", " . $table[$i]["date"] . ", " . $table[$i]["value"];
        //echo $table[$i];
    }
    echo "</table>";
//}


/*<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Commissions</title>
</head>
<body>
    <div>
        <h2>Commissions</h2>
        <p>Commissions: </p>
        <form action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post">
            <div>
                <input type="submit" value="GET Commissions">
            </div>
            <p>Don't have an account? <a href="register.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
</html>*/

?>

<!DOCTYPE html>
<html lang="en">
<body>
<form action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post">
    <div>
        <input type="submit" value="Log Out">
    </div>
</form>
   
</body>
</html>