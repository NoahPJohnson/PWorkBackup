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
$target_file = $target_directory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$uploadFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"]))
{
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $checkFile = finfo_file($fileInfo, $_FILES["fileToUpload"]["tmp_name"]);//getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
            echo "Error: File size: " . $_FILES["fileToUpload"]["size"] . " is too large.";
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
}

if ($uploadOk == 0)
{
    echo "Upload Failed.";
}
else
{
    $target_file = temporaryRandomSuffix($target_directory, ".tmp");
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
    {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]). " successfully uploaded.";
        $sqlQuery = "INSERT INTO 08a_CommissionTable (UserID, Carrier, Date, ToDate, TemporaryName, OriginalName, MimeType) VALUES (%s, %s, %s, %s, %s, %s, %s);";
        //mysqli_stmt_bind_param($statement, "sss", $parameter_temporaryName, $parameter_originalName, $parameter_MimeType);
        $parameter_userID = $_POST["userID"];
        $parameter_carrier = $_POST["carrier"];
        $parameter_date = $_POST["startDate"];
        $parameter_toDate = $_POST["endDate"];
        $parameter_temporaryName = basename($target_file);
        $parameter_originalName = basename($_FILES["fileToUpload"]["name"]);
        $parameter_mimeType = $_FILES["fileToUpload"]["type"];
        $wpdb->query($wpdb->prepare($sqlQuery,$parameter_userID,$parameter_carrier,$parameter_date,$parameter_toDate,$parameter_temporaryName,$parameter_originalName,$parameter_mimeType));
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

function temporaryRandomSuffix($path, $suffix)
{
    $file = $path . "/" . random_int(0,12000) . $suffix;
    //$fp = fopen($file, 'x');
    return $file;
}

?>