<?php 

function SQLGetUser()
{
    global $link;

    $outputArray = array();

    if (isset($_SESSION["id"]))
    {
        //SELECT EventTagJoinTable.EventID, EventTagJoinTable.EventTaggedAmount, TagTable.TagID, TagTable.TagName, TagTable.TagTotal, TagTable.TagDescription FROM EventTagJoinTable INNER JOIN TagTable ON EventTagJoinTable.TagID = TagTable.TagID
        $sqlQuery = "SELECT username, Name, LastName, Email, State, City, Student, Educator, CommunityLeader, STEMAsset FROM UserTable WHERE UserID = ?";
        
        $statement = mysqli_prepare($link, $sqlQuery);

        if ($statement)
        {
            //echo "Statement Prepared.";

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement, "i", $parameterID);

            $parameterID = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement))
            {
                //echo "Statement EXECUTED.";

                mysqli_stmt_store_result($statement);

                // Check if user exists, if yes then bind variables
                if (mysqli_stmt_num_rows($statement) >= 1)
                {
                    //echo "User Exists";
                    // Bind result variables
                    if (mysqli_stmt_bind_result($statement, $resultUsername, $resultName, $resultLastName, $resultEmail, $resultState, $resultCity, $resultStudent, $resultEducator, $resultCommunityLeader, $resultSTEMAsset))
                    {
                        if(mysqli_stmt_fetch($statement))
                        {   
                              
                            $outputArray["Username"] = $resultUsername;
                            $outputArray["Name"] = $resultName;
                            $outputArray["LastName"] = $resultLastName;
                            $outputArray["Email"] = $resultEmail;
                            $outputArray["State"] = $resultState;
                            $outputArray["City"] = $resultCity;
                            $outputArray["Student"] = $resultStudent;
                            $outputArray["Educator"] = $resultEducator;
                            $outputArray["CommunityLeader"] = $resultCommunityLeader;
                            $outputArray["STEMAsset"] = $resultSTEMAsset;
                        }
                    }
                }
            }
        }
    }

    return $outputArray;
}

function SQLGetUserTags()
{
    global $link;

    $outputTable = array();

    if (isset($_SESSION["id"]))
    {
        //echo "START";
        //SELECT EventTagJoinTable.EventID, EventTagJoinTable.EventTaggedAmount, TagTable.TagID, TagTable.TagName, TagTable.TagTotal, TagTable.TagDescription FROM EventTagJoinTable INNER JOIN TagTable ON EventTagJoinTable.TagID = TagTable.TagID
        $sqlQuery = "SELECT UserTagJoinTable.TagID, UserTagJoinTable.PrimaryTag, TagTable.TagName, TagTable.TagDescription FROM UserTagJoinTable INNER JOIN TagTable ON UserTagJoinTable.TagID = TagTable.TagID WHERE UserTagJoinTable.UserID = ?";
        
        $statement = mysqli_prepare($link, $sqlQuery);

        if ($statement)
        {
            //echo "Statement Prepared.";

            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($statement, "i", $parameterID);

            $parameterID = $_SESSION["id"];

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($statement))
            {
                //echo "Statement EXECUTED.";

                mysqli_stmt_store_result($statement);

                // Check if user exists, if yes then bind variables
                if (mysqli_stmt_num_rows($statement) >= 1)
                {
                    //echo "Tags Exist";
                    // Bind result variables
                    if (mysqli_stmt_bind_result($statement, $resultTagID, $resultPrimaryTag, $resultTagName, $resultTagDescription))
                    {
                        while (mysqli_stmt_fetch($statement))
                        {   
                            $row = array();

                            $row["TagID"] = $resultTagID;
                            $row["PrimaryTag"] = $resultPrimaryTag;
                            $row["TagName"] = $resultTagName;
                            $row["TagDescription"] = $resultTagDescription;

                            $outputTable[] = $row;
                        }
                    }
                }
            }
        }
    }

    return $outputTable;
}

function GetPrimaryInterestTag($inputTable)
{
    $outputArray = array();
    for ($i = 0; $i < count($inputTable); $i += 1)
    {
        if ($inputTable[$i]["PrimaryTag"] == 1)
        {
            $outputArray = $inputTable[$i];
            return $outputArray;
        }
    }
    return $outputArray;
}

?>