<?php

//require_once "WebSurveyConfig.php";

function UploadFile() 
{
    //echo "UPLOAD.";
    global $link;
    global $jsonData;
    global $pageArray;
    global $pageNumber;
    global $surveyJSONFile;

    $target_directory = "./Assets/";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    for ($i = 0; $i < 4; $i += 1)
    {
        if ($_FILES["BU". ($i+1)]["name"] != "")
        {
            $uploadOk = 1;
            $target_file = $target_directory . basename($_FILES["BU". ($i+1)]["name"]);
            $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
            $checkFile = finfo_file($fileInfo, $_FILES["BU". ($i+1)]["tmp_name"]);
            if ($checkFile === "image/gif" || $checkFile === "image/png" || $checkFile === "image/jpg" || $checkFile === "image/jpeg")
            {
                //echo "File is recognized as: " . $checkFile;
                $uploadOk = 1;
                if (file_exists($target_file))
                {
                    echo "Error: File already exists in: " . $target_directory;
                    $uploadOk = 0;
                }
                if ($_FILES["BU". ($i+1)]["size"] > 500000)
                {
                    echo "Error: File size: " . $_FILES["BU". ($i+1)]["size"] . " is too large.";
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
        

            if ($uploadOk == 0)
            {
                echo "Upload Failed.";
            }
            else
            {
                $query = "SELECT TemporaryName, OriginalName FROM UploadTable WHERE OriginalName = ?";
                if ($statement = mysqli_prepare($link, $query))
                {
                    mysqli_stmt_bind_param($statement, "s", $parameter_originalName);
                    $parameter_originalName = basename($_FILES["BU". ($i+1)]["name"]);
                    if (mysqli_stmt_execute($statement))
                    {
                        mysqli_stmt_store_result($statement);
                
                        if (mysqli_stmt_num_rows($statement) >= 1)
                        {
                            echo "File exists on server.";
                            if (mysqli_stmt_bind_result($statement, $resultTempName, $resultOriginalName))
                            {
                                if(mysqli_stmt_fetch($statement))
                                {  
                                    $jsonData = file_get_contents($surveyJSONFile);
                                    $pageArray = json_decode($jsonData);
                                    $pageArray[$pageNumber][$i]->BenefitImage = $target_directory . $resultTempName;
                                    //echo $pageArray[$pageNumber][$i]->BenefitImage;
                                    $jsonDataOutput = json_encode($pageArray);
                                    file_put_contents($surveyJSONFile, $jsonDataOutput);
                                    $jsonData = file_get_contents($surveyJSONFile);
                                    $pageArray = json_decode($jsonData);
                                    echo "RESULT: " . $pageArray[$pageNumber][$i]->BenefitImage;
                                }
                            }
                        }
                        else
                        {
                            $target_file = temporaryRandomSuffix($target_directory, ".tmp");
                            if (move_uploaded_file($_FILES["BU". ($i+1)]["tmp_name"], $target_file))
                            {
                                //echo "The file " . basename($_FILES["BU". ($i+1)]["name"]). " successfully uploaded.";
                                $query = "INSERT INTO UploadTable (TemporaryName, OriginalName, MimeType) VALUES (?, ?, ?);";
                                //echo "Query: " . $query;
                                //echo "Link: " . mysqli_get_host_info($link);
                                
                                if ($statement = mysqli_prepare($link, $query))
                                {
                                    mysqli_stmt_bind_param($statement, "sss", $parameter_temporaryName, $parameter_originalName, $parameter_MimeType);
                                    $parameter_temporaryName = basename($target_file);
                                    $parameter_originalName = basename($_FILES["BU". ($i+1)]["name"]);
                                    $parameter_MimeType = $_FILES["BU". ($i+1)]["type"];
                                    if (mysqli_stmt_execute($statement))
                                    {
                                        echo "Database operation successful.";
                                        $jsonData = file_get_contents($surveyJSONFile);
                                        $pageArray = json_decode($jsonData);
                                        $pageArray[$pageNumber][$i]->BenefitImage = $target_file;
                                        //echo "Image src = " . $pageArray[$pageNumber][$i]->BenefitImage;
                                        $jsonDataOutput = json_encode($pageArray);
                                        file_put_contents($surveyJSONFile, $jsonDataOutput);
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
                    }
                }
            }
        }
    }
        /*
        if ($imageID != "")
        {
            if ($imageID == 'BU1')
            {
                $pageArray[$pageNumber][0]->BenefitImage = basename($target_file);
            }
            else if ($imageID == 'BU2')
            {
                $pageArray[$pageNumber][1]->BenefitImage = basename($target_file);
            }
            else if ($imageID == 'BU3')
            {
                $pageArray[$pageNumber][2]->BenefitImage = basename($target_file);
            } 
            else if ($imageID == 'BU4')
            {
                $pageArray[$pageNumber][3]->BenefitImage = basename($target_file);
            } 
            else
            {
                echo "No Image ID";
            }
        }
        */

}

function temporaryRandomSuffix($path, $suffix)
{
    $file = $path . "/" . random_int(0,12000) . $suffix;
    //$fp = fopen($file, 'x');
    return $file;
}

?>