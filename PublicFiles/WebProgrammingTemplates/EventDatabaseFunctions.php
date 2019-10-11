<?php


function PerformSQLSelect($sqlQuery, $parameter)
{
    global $locationsTable;
    global $link;
    //$statement = "Hey";
    //$sql = "SELECT * FROM EventsTable";
    $statement = mysqli_prepare($link, $sqlQuery);
    //var_dump($statement);
    //echo "SQL: " . $statement;
    if ($statement)
    {
        echo "Successfully Prepared Statement.";
        // Bind variables to the prepared statement as parameters
        
        if ($parameter != "")
        {
            mysqli_stmt_bind_param($statement, "s", $parameter);
        }
        
        // Set parameters
        //$param_eventName = '%' . $textInputValue . '%';
        //echo "Statement: " . $statement;
        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_store_result($statement);
            //echo "Statement Executed";
            // Check if events exist, if yes then bind variables
            if (mysqli_stmt_num_rows($statement) >= 1)
            {
                
                //$locationsCount = mysqli_stmt_num_rows($statement);
                            
                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $resultEventID, $resultEventName, $resultState, $resultCity, $resultAddress, $resultStartTime, $resultEndTime, $resultOrganizerID, $resultRecurring, $resultType))
                {
                    $row = array();
                    while (mysqli_stmt_fetch($statement))
                    {
                        
                        $row["EventID"] = $resultEventID;
                        $row["EventName"] = $resultEventName;
                        $row["State"] = $resultState;
                        $row["City"] = $resultCity;
                        $row["Address"] = $resultAddress;
                        $row["StartTime"] = $resultStartTime;
                        $row["EndTime"] = $resultEndTime;
                        $row["OrganizerID"] = $resultOrganizerID;
                        $row["Recurring"] = $resultRecurring;
                        $row["Type"] = $resultType;
                        //echo "NAME: " . $row["EventName"];
                        if (!in_array($row, $locationsTable))
                        {
                            $locationsTable[] = $row;
                        }
                    }
                }
            }
        }
    }
}

function PerformSQLTAGSelect() 
{
    global $link;
    
    //SELECT EventTagJoinTable.EventID, EventTagJoinTable.EventTaggedAmount, TagTable.TagID, TagTable.TagName, TagTable.TagTotal, TagTable.TagDescription FROM EventTagJoinTable INNER JOIN TagTable ON EventTagJoinTable.TagID = TagTable.TagID
    $sqlQuery = "SELECT EventTagJoinTable.EventID, EventTagJoinTable.EventTaggedAmount, TagTable.TagID, TagTable.TagName, TagTable.TagTotal, TagTable.TagDescription FROM EventTagJoinTable INNER JOIN TagTable ON EventTagJoinTable.TagID = TagTable.TagID";
    
    $outputTable = array();

    $statement = mysqli_prepare($link, $sqlQuery);

    if ($statement)
    {
        // Bind variables to the prepared statement as parameters

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_store_result($statement);

            // Check if events exist, if yes then bind variables
            if (mysqli_stmt_num_rows($statement) >= 1)
            {

                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $resultEventID, $resultEventTaggedAmount, $resultTagID, $resultTagName, $resultTagTotal, $resultTagDescription))
                {
                    $row = array();
                    while (mysqli_stmt_fetch($statement))
                    {
                        $row["EventID"] = $resultEventID;
                        $row["EventTaggedAmount"] = $resultEventTaggedAmount;
                        $row["TagID"] = $resultTagID;
                        $row["TagName"] = $resultTagName;
                        $row["TagTotal"] = $resultTagTotal;
                        $row["TagDescription"] = $resultTagDescription;

                        $outputTable[] = $row;
                    }
                }
            }
        }
    }
    return $outputTable;
}

function ConvertDateTime($dateTimeString)
{
    $DateAndTimeArray = explode(' ', $dateTimeString);
    $DateArray = explode('-', $DateAndTimeArray[0]);
    $TimeArray = explode(':', $DateAndTimeArray[1]);
    $timeValue = ((int)$TimeArray[0] * 100) + (int)$TimeArray[1];
    if ($timeValue >= 1159 && $timeValue < 2400)
    {
        $amPMString = "pm";
    }
    else
    {
        $amPMString = "am";
    }
    $timeString = ((int)$TimeArray[0]%12). ":" . $TimeArray[1] . " " . $amPMString;
    $outputString = $DateArray[1] . "/" . $DateArray[2] . "/" . $DateArray[0] . ",  " . $timeString;
    return $outputString;
}

?>