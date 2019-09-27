<?php

require_once "DonateConfig.php";

session_start();

$sql = "SELECT Month FROM DonationMonthsTable WHERE Month IS NOT NULL";
$statement = mysqli_prepare($link, $sql);
if ($statement)
{
    //echo "Successfully Prepared Statement.";
    // Bind variables to the prepared statement as parameters
    //mysqli_stmt_bind_param($statement, "s", $param_username);

    // Set parameters
    //$param_username = $username;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($statement))
    {
        // Store result
        mysqli_stmt_store_result($statement);

        // Check if username exists, if yes then verify password
        if (mysqli_stmt_num_rows($statement) >= 1)
        {                    
            // Bind result variables
            if (mysqli_stmt_bind_result($statement, $resultMonth))
            {
                $monthArray = array();
                while (mysqli_stmt_fetch($statement))
                {
                    $monthArray[] = $resultMonth;
                }
                echo "Success.";
                var_dump($monthArray);
            }
        }
    } 
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Donate</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body { 
            font: 14px sans-serif; 
        }
    </style>
</head>
<body>
    <div>
        <form action="<?php /*echo htmlspecialchars($_SERVER[""]);*/ ?>" method="post">
            <select name="fund" id="fundField">
                <option value='X'>X</option>
                <option value='Y'>Y</option>
                <option id='MonthlyDonation' value='HealthyKids'>Healthy Kids</option>
            </select>
            
            <div id='MonthlyDonationForm' class='hideContent'>
                <p>Select an available Month: </p>
                <select name="MonthSelection" id="monthField">
                    <option id='January' value='January'>January</option>
                    <option id='February' value='February'>February</option>
                    <option id='March' value='March'>March</option>
                    <option id='April' value='April'>April</option>
                    <option id='May' value='May'>May</option>
                    <option id='June' value='June'>June</option>
                    <option id='July' value='July'>July</option>
                    <option id='August' value='August'>August</option>
                    <option id='September' value='September'>September</option>
                    <option id='October' value='October'>October</option>
                    <option id='November' value='November'>November</option>
                    <option id='December' value='December'>December</option>
                    <option value=''>None</option>
                </select>
            </div>

            <p>Amount: </p>
            <input name='Amount' type='text'> 
        </form>
    </div>
<script type='text/javascript'>
    var monthArray = new Array();
    <?php 
        for ($i = 0; $i < count($monthArray); $i += 1)
        {
            ?> monthArray.push('<?php echo $monthArray[$i]; ?>'); <?php
        }
    ?>
    for (var i = 0; i < monthArray.length; i += 1)
    {
        document.getElementById(monthArray[i]).style.display="none";
    }
</script>

</body>


</html>