<?php


session_start();

global $wpdb;

// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

require_once "$root/TLCinsurance/wp-config.php";


// Check if the user is logged in, if not then redirect to login page
/*if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
    //header("location: login.php");
    echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;
}*/

$productID = "";
$productName = "";
$productCategory = "";
$unitPrice = "";


$row = array("productID" => $productID, "productName" => $productName, "productCategory" => $productCategory, "unitPrice" => $unitPrice);
$table = array();


$sqlQuery = "SELECT * FROM 08a_TestProductTable;";
$results = $wpdb->get_results($sqlQuery);


foreach ($results as $resultRow)
{
    $row["productID"] = $resultRow->ProductID;
    $row["productName"] = $resultRow->Name;
    $row["productCategory"] = $resultRow->Category;
    $row["unitPrice"] = $resultRow->Price;
    $table[] = $row;
    //echo "result row added to table.";
}

$amounts = array(0,0,0);

echo "<table class='CommissionTableDisplay>'
<tr>
    <th>ProductID</th><th>Name</th><th>Category</th><th>Price</th><th>Amount</th>
</tr>";

for ($i = 0; $i < count($table); $i += 1)
{
    echo "<tr>
        <td>" 
        . $table[$i]["productID"] . "</td> <td>" . $table[$i]["productName"] . "</td> <td>"
        . $table[$i]["productCategory"] . "</td> <td>" . $table[$i]["unitPrice"] . "</td> 
        <td>
            <input type='button' name='orderButton'>

            </input>
        </td>
    </tr>";
}
echo "</table>";

//echo var_dump($_POST);
echo "Total = $" . ($amounts[0] * $table[0]["unitPrice"]) + ($amounts[1] * $table[1]["unitPrice"]) + ($amounts[2] * $table[2]["unitPrice"]);  


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    //$_SESSION["amounts"] = $amounts;
    echo var_dump($_POST);
    $totalProductPrice = 0;
    for ($i = 0; $i < count($amounts[$i]); $i++)
    {
        $amounts[$i] = (is_numeric($_POST['Amount0']) ? (int)$_POST['Amount0'] : 0);
        $totalProductPrice += ($amounts[$i] * $table[$i]["unitPrice"]);
    }
    //var_dump($amounts);
    //$sqlQuery = "INSERT INTO 08a_OrderTable (UserID, Total) VALUES ('1', '$totalProductPrice');";
    $dataArray = array('UserID' => 1,'Total' => $totalProductPrice);
    $wpdb->insert("08a_OrderTable", $dataArray);
    $lastOrderNumber = $wpdb->insert_id;
    
    for ($i = 0; $i < count($amounts); $i++)
    {
        $currentProductID = $table[$i]["productID"];
        //echo "product ID: " . $i . " = " . $currentProductID;
        $currentCount = $amounts[$i];
        $dataArray2 = array('OrderNumber'=>$lastOrderNumber, 'ProductID'=>$currentProductID, 'Amount' => $currentCount);
        //echo var_dump($dataArray2);
        //$sqlQuery2 = "INSERT INTO 08a_OrderandProductTable (OrderNumber, ProductID, Amount) VALUES ($lastOrderNumber, $currentProductID, $currentCount);";
        $wpdb->insert("08a_OrderandProductTable", $dataArray2);
        //echo " The id = " . $wpdb->insert_id . " | ";
    }

    session_start();
    
    //session_start();
    //header("location: orderConfirm.php");
    /*echo "<script>document.location = '/TLCinsurance/orderConfirm/';</script>";*/  
    //exit;
}



?>


<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <input type="submit" value="Submit Order">
    </div>
    <div>
        <input type="text" name="a">
    </div>
</form>
   
</body>
</html>