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
        //echo "Successfully Prepared Statement.";
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

function GetEventsCreated()
{
    global $link;
    $sqlQuery = "SELECT EventUserJoinTable.Attending, EventsTable.* FROM EventUserJoinTable INNER JOIN EventsTable ON EventUserJoinTable.EventID = EventsTable.EventID WHERE EventsTable.OrganizerID = ?";
    //$sqlQuery = "SELECT * FROM EventsTable WHERE OrganizerID = ?";

    $outputTable = array();
    $statement = mysqli_prepare($link, $sqlQuery);

    if ($statement)
    {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "i", $parameter_OrgID);

        $parameter_OrgID = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_store_result($statement);

            // Check if events exist, if yes then bind variables
            if (mysqli_stmt_num_rows($statement) >= 1)
            {

                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $resultAttending, $resultEventID, $resultEventName, $resultState, $resultCity, $resultAddress, $resultStartTime, $resultEndTime, $resultOrganizerID, $resultRecurring, $resultType))
                {
                    $row = array();
                    while (mysqli_stmt_fetch($statement))
                    {
                        $row["Attending"] = $resultAttending;
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
                        if (!in_array($row, $outputTable))
                        {
                            $outputTable[] = $row;
                        }
                    }
                }
            }
        }
    }
    return $outputTable;
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

function GetEventsAttending()
{
    global $link;

    $sqlQuery = "SELECT EventID, UserID, Attending FROM EventUserJoinTable WHERE UserID = ?";
  
    $outputTable = array();

    $statement = mysqli_prepare($link, $sqlQuery);

    if ($statement)
    {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "i", $parameter_UserID);

        $parameter_UserID = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_store_result($statement);

            // Check if events exist, if yes then bind variables
            if (mysqli_stmt_num_rows($statement) >= 1)
            {

                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $resultEventID, $resultEventUserID, $resultAttending))
                {
                    $row = array();
                    while (mysqli_stmt_fetch($statement))
                    {
                        $row["EventID"] = $resultEventID;
                        $row["UserID"] = $resultUserID;
                        $row["Attending"] = $resultAttending;

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


function UpdateAttending($inputEventID)
{
    global $link;
    global $attendingTable;

    $newAttendingValue = 1;
    for ($i = 0; $i < count($attendingTable); $i += 1)
    {
        if ($attendingTable[$i]["EventID"] == $inputEventID)
        {
            if ($attendingTable[$i]["Attending"] == 1)
            {
                $newAttendingValue = 0;
            }
            else
            {
                $newAttendingValue = 1;
            }
            $attendingTable[$i]["Attending"] = $newAttendingValue;
            //echo "New Value = " . $newAttendingValue . " | TableValue: " . $attendingTable[$i]["Attending"]; 
        }
    }
    //SELECT EventTagJoinTable.EventID, EventTagJoinTable.EventTaggedAmount, TagTable.TagID, TagTable.TagName, TagTable.TagTotal, TagTable.TagDescription FROM EventTagJoinTable INNER JOIN TagTable ON EventTagJoinTable.TagID = TagTable.TagID
    $sqlQuery = "SELECT EventID, UserID, Attending FROM EventUserJoinTable WHERE EventID = ? AND UserID = ?";

    
    $statement = mysqli_prepare($link, $sqlQuery);

    if ($statement)
    {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($statement, "ii", $parameter_EventID, $parameter_UserID);

        $parameter_EventID = $inputEventID;

        $parameter_UserID = $_SESSION["id"];

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($statement))
        {
            mysqli_stmt_store_result($statement);

            // Check if events exist, if yes then bind variables
            if (mysqli_stmt_num_rows($statement) >= 1)
            {

                // Bind result variables
                if (mysqli_stmt_bind_result($statement, $resultEventID, $resultUserID, $resultAttending))
                {
                    $resultRow = array();
                    if (mysqli_stmt_fetch($statement))
                    {
                        $resultRow["EventID"] = $resultEventID;
                        $resultRow["UserID"] = $resultUserID;
                        $resultRow["Attending"] = $resultAttending;

                        var_dump($resultRow);

                        $sqlQuery = "UPDATE EventUserJoinTable SET Attending = ? WHERE EventID = ? AND UserID = ?";

                        $statement = mysqli_prepare($link, $sqlQuery);

                        //var_dump($statement);

                        if ($statement)
                        {
                            //echo "Statment PREPARED.";
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($statement, "iii", $parameter_Attending, $parameter_EventID, $parameter_UserID);

                            $parameter_Attending = $newAttendingValue;

                            $parameter_EventID = $inputEventID;

                            $parameter_UserID = $_SESSION["id"];

                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($statement))
                            {
                                //echo "Statement Executed.";
                            }
                        }
                    }
                }
            }
            else
            {
                //echo "No Rows.";

                $sqlQuery = "INSERT INTO `EventUserJoinTable`VALUES ((SELECT EventID FROM EventsTable WHERE EventID = ?),(SELECT UserID FROM UserTable WHERE UserID = ?),?)";

                $statement = mysqli_prepare($link, $sqlQuery);

                //var_dump($statement);

                if ($statement)
                {
                    
                    // Bind variables to the prepared statement as parameters
                    mysqli_stmt_bind_param($statement, "iii", $parameter_EventID, $parameter_UserID, $parameter_Attending);


                    $parameter_EventID = $inputEventID;

                    $parameter_UserID = $_SESSION["id"];

                    $parameter_Attending = $newAttendingValue;

                    echo "Insert Statment PREPARED, EventID: " . $parameter_EventID . " UID: " . $parameter_UserID . " Attend: " . $parameter_Attending . " | ";
                    var_dump($statement);                    
                    // Attempt to execute the prepared statement
                    if (mysqli_stmt_execute($statement))
                    {
                        echo "Insert Statement Executed.";
                    }
                }
            }
        }
    }

    
}

?>