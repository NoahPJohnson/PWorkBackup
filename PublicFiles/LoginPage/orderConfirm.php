<?php

session_start();

global $wpdb;

// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

require_once "$root/TLCinsurance/wp-config.php";


$orderAmounts = $_SESSION["amounts"];

$sqlQuery = "SELECT 08a_UserLoginTable.UserID, 08a_UserLoginTable.Username, 08a_UserLoginTable.Name, 08a_UserLoginTable.LastName, 08a_UserLoginTable.Email, 08a_OrderTable.OrderNumber, 08a_OrderTable.ProductID, 08a_OrderTable.Total, 08a_OrderTable.OrderDate FROM 08a_OrderTable INNER JOIN 08a_UserLoginTable ON 08a_OrderTable.UserID = 08a_UserLoginTable.UserID WHERE 08a_OrderTable.UserID = %d";

$results = $wpdb->get_results($wpdb->prepare($sqlQuery, 1));


foreach ($results as $resultRow)
{
    $row["userID"] = $resultRow->UserID;
    $row["username"] = $resultRow->Username;
    $row["name"] = $resultRow->Name;
    $row["lastName"] = $resultRow->LastName;
    $row["email"] = $resultRow->Email;
    $row["orderNumber"] = $resultRow->OrderNumber;
    $row["productID"] = $resultRow->ProductID;
    $row["total"] = "$" . $resultRow->Total;
    $row["orderDate"] = $resultRow->OrderDate;
    $table[] = $row;
    //echo "result row added to table.";
}

echo "<table class='CommissionTableDisplay>'
<tr>
    <th>User ID</th><th>Username</th><th>Name</th><th>Last Name</th><th>Email</th><th>Order Number</th><th>Product ID</th><th>Total</th><th>OrderDate</th>
</tr>";

for ($i = 0; $i < count($table); $i += 1)
{
    echo "<tr>
        <td>"
        . $table[$i]["userID"] . "</td> <td>"
        . $table[$i]["username"] . "</td> <td>"
        . $table[$i]["name"] . "</td> <td>"
        . $table[$i]["lastName"] . "</td> <td>"
        . $table[$i]["email"] . "</td> <td>"
        . $table[$i]["orderNumber"] . "</td> <td>" 
        . $table[$i]["productID"] . "</td> <td>"
        . $table[$i]["total"] . "</td> <td>"
        . $table[$i]["orderDate"] . "</td>
    </tr>";
}
echo "</table>";

$finalTotal = 0;
for ($i = 0; $i < count($table); $i++)
{
    $finalTotal += $table[$i]["total"];
}

echo "Total = $" . $finalTotal;  

?>