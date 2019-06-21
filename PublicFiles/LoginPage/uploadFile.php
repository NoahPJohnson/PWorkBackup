<?php

$target_directory = "./testUploads";
$target_file = $target_directory . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
if (isset($_POST["submit"]))
{
    $checkSize = getimagesize($_FILES["fileToUpload"]["temp_name"]);
    if ($checkSize !== false)
    {
        echo "File is recognized as an image.";
    }
}


?>