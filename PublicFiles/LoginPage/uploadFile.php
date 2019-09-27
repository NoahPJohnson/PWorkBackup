<?php

// Initialize the session
session_start();

global $wpdb;
// Include config file
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$rootURL = "https://prodigalcompany.com/TLCinsurance";

require_once "$root/TLCinsurance/wp-config.php";
require_once "$root/TLCinsurance/npjFiles/sendMail2.php";


$target_directory = "$root/TLCinsurance/npjFiles/uploads/";

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || !isset($_SESSION["admin"]) || $_SESSION["admin"] == 0)
{
    //header("location: login.php");
    echo "<script>document.location = '/TLCinsurance/login/';</script>";  
    exit;
}

if (isset($_POST["submit"]))
{
    for ($i = 0; $i < 10; $i += 1)
    {
        $target_file = $target_directory . basename($_FILES["fileToUpload" . $i]["name"]);
        $uploadOk = 1;
        $uploadFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $checkFile = finfo_file($fileInfo, $_FILES["fileToUpload" . $i]["tmp_name"]);//getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($checkFile === "application/vnd.ms-excel" || $checkFile === "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
        {
            echo "File is recognized as: " . $checkFile;
            $uploadOk = 1;
            if (file_exists($target_file))
            {
                echo "Error: File already exists in: " . $target_directory;
                $uploadOk = 0;
            }
            if ($_FILES["fileToUpload"]["size"] > 500000)
            {
                echo "Error: File size: " . $_FILES["fileToUpload". $i]["size"] . " is too large.";
                $uploadOk = 0;
            }
            /*if ($_FILES["fileToUpload"]["error"] != 0)
            {
                echo "Error: " . $_FILES["fileToUpload"]["error"];
            }*/
        }
        else
        {
            echo "File: " . $checkFile . " is not an Excel File.";
            $uploadOk = 0;
        }


        if ($uploadOk == 0)
        {
            echo "Upload Failed.";
        }
        else
        {
            //$target_file = temporaryRandomSuffix($target_directory, ".tmp");
            if (move_uploaded_file($_FILES["fileToUpload" . $i]["tmp_name"], $target_file))
            {
                echo "The file " . basename($_FILES["fileToUpload" . $i]["name"]). " successfully uploaded.";
                $sqlQuery = "INSERT INTO 08a_CommissionTable (UserID, Carrier, Date, ToDate, OriginalName, MimeType) VALUES (%s, %s, %s, %s, %s, %s);";
                //mysqli_stmt_bind_param($statement, "sss", $parameter_temporaryName, $parameter_originalName, $parameter_MimeType);
                $parameter_userID = $_POST["userID" . $i];
                $parameter_carrier = $_POST["carrier"];
                $parameter_date = $_POST["startDate"];
                $parameter_toDate = $_POST["endDate"];
                $parameter_originalName = basename($_FILES["fileToUpload". $i]["name"]);
                $parameter_mimeType = $_FILES["fileToUpload". $i]["type"];
                $wpdb->query($wpdb->prepare($sqlQuery,$parameter_userID,$parameter_carrier,$parameter_date,$parameter_toDate,$parameter_originalName,$parameter_mimeType));
                /*if (mysqli_stmt_execute($statement))
                {
                    echo "Database operation successful.";
                }*/
            }
            else
            {
                echo "Error: uploading process was unsuccessful.";
            }
        }
    }
}



function temporaryRandomSuffix($path, $suffix)
{
    $file = $path . "/" . random_int(0,12000) . $suffix;
    //$fp = fopen($file, 'x');
    return $file;
}

?>

<!DOCTYPE html>
<html>
<body>

<form action="uploadFile.php" method="post" enctype="multipart/form-data" style="padding-top:110px">
    <ul>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload0" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID0" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload1" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID1" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload2" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID2" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload3" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID3" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload4" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID4" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload5" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID5" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload6" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID6" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload7" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID7" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload8" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID8" id="userIDField">
        </li>
        <li>
            <p>Upload File: </p>
            <input type="file" name="fileToUpload9" id="fileToUpload">
            
            <p>UserID: </p>
            <input type="text" name="userID9" id="userIDField">
        </li>
        </ul>
    <p>Carrier:</p>
    <select name="carrier" id="carrierField">
        <option value='Anthem'>Anthem</option>
        <option value='BAC'>BAC</option>
        <option value='Bright Health'>Bright Health</option>
        <option value='Cigna Healthsprings'>Cigna Healthsprings</option>
        <option value='Delta Dental'>Delta Dental</option>
        <option value='Envision'>Envision</option>
        <option value='Excellus'>Excellus</option>
        <option value='Highmark PA'>Highmark PA</option>
        <option value='Hoover'>Hoover</option>
        <option value='Humana'>Humana</option>
        <option value='IAM'>IAM</option>
        <option value='IUE'>IUE</option>
        <option value='Med Mutual OH'>Med Mutual OH</option>
        <option value='Misc.'>Misc.</option>
        <option value='Molina'>Molina</option>
        <option value='Paramount'>Paramount</option>
        <option value='Sub GA'>Sub GA</option>
        <option value='The Health Plan'>The Health Plan</option>
        <option value='TLC Insurance Group'>TLC Insurance Group</option>
        <option value='TLC Wealth'>TLC Wealth</option>
        <option value='UHONE'>UHONE</option>
        <option value='UPMC'>UPMC</option>
        <option value='Wellcare'>Wellcare</option>
    </select>
    <p>Start Date:</p> 
    <input type="date" name="startDate" id="startDateField">
    <p>End Date:</p> 
    <input type="date" name="endDate" id="endDateField">
    <input type="submit" value="UploadTheFile" name="submit">
    
</form>

</body>
</html>