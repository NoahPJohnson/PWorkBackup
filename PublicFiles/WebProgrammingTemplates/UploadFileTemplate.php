<?php

//require_once "ConfigurationTemplate.php";

$target_directory = "testUploads/";
$target_file = $target_directory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"]))
{
    var_dump($_FILES);
    $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
    $checkFile = finfo_file($fileInfo, $_FILES["fileToUpload"]["tmp_name"]);//getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($checkFile === "image/gif" || $checkFile === "image/png" || $checkFile === "image/jpg" || $checkFile === "image/jpeg")
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
        echo "File: " . $checkFile . " is not an image.";
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
        $query = "INSERT INTO UploadTable (TemporaryName, OriginalName, MimeType) VALUES (?, ?, ?);";
        if ($statement = mysqli_prepare($link, $query))
        {
            mysqli_stmt_bind_param($statement, "sss", $parameter_temporaryName, $parameter_originalName, $parameter_MimeType);
            $parameter_temporaryName = basename($target_file);
            $parameter_originalName = basename($_FILES["fileToUpload"]["name"]);
            $parameter_MimeType = $_FILES["fileToUpload"]["type"];
            if (mysqli_stmt_execute($statement))
            {
                echo "Database operation successful.";
            }
        }
        else
        {
            echo "Prepare no good.";
        }
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
<div class='Page'>
<form action="<?php echo htmlspecialchars($_SERVER[""]); ?>" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <!--<input type="text" name="userID" id="userIDField">
    <input type="text" name="carrier" id="carrierField">
    <input type="date" name="startDate" id="startDateField">
    <input type="date" name="endDate" id="endDateField">-->
    <input type="submit" value="UploadTheFile" name="submit">
</form>