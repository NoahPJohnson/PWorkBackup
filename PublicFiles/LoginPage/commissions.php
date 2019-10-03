<?php

session_start();

global $wpdb;

// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance/npjFiles/uploads/";

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
    $sqlQuery = "SELECT 08a_UserLoginTable.UserID, 08a_UserLoginTable.Name, 08a_UserLoginTable.LastName, 08a_UserLoginTable.Email, 08a_CommissionTable.Carrier, 08a_CommissionTable.Date, 08a_CommissionTable.ToDate, 08a_CommissionTable.Value, 08a_CommissionTable.OriginalName FROM 08a_CommissionTable INNER JOIN 08a_UserLoginTable ON 08a_CommissionTable.UserID = 08a_UserLoginTable.UserID WHERE 08a_CommissionTable.UserID = %d";
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
        $row["OriginalName"] = $rootURL . $resultRow->OriginalName;
        $table[] = $row;
        //echo "result row added to table.";
    }
    $_SESSION["Table"] = $table;
    
//}



?>

<!DOCTYPE html>
<html lang="en">
<body>
    <table class='CommissionTableDisplay'>
        <tr>
            <th>UserID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Carrier</th><th>Dates</th><th>Receipt</th>
        </tr>
    <?php
    $table = $_SESSION["Table"];
    for ($i = 0; $i < count($table); $i += 1)
    {
    ?>
        <tr>
            <td width='110px'><?php echo htmlspecialchars($table[$i]["userID"]); ?></td> 
            <td width='150px'><?php echo htmlspecialchars($table[$i]["name"]); ?> </td>
            <td width='140px'><?php echo htmlspecialchars($table[$i]["lastName"]); ?> </td> 
            <td width='230px'><?php echo htmlspecialchars($table[$i]["email"]); ?> </td> 
            <td width='120px'><?php echo htmlspecialchars($table[$i]["carrier"]); ?> </td>
            <td width='160px'>
                <?php 
                    echo htmlspecialchars(date("y",strtotime($table[$i]["date"])) . "." . date("m",strtotime($table[$i]["date"])) . "." . date("d",strtotime($table[$i]["date"]))
                  . " \ " . date("y",strtotime($table[$i]["toDate"])) . "." . date("m",strtotime($table[$i]["toDate"])) . "." . date("d",strtotime($table[$i]["toDate"]))); 
                ?>
            </td> 
            <td width='120px'><a href="<?php echo htmlspecialchars($table[$i]["OriginalName"]); ?>" download>Download</a></td>
        </tr>
    <?php
    }
    ?>
    </table>
</body>
</html>