<?php

require_once "UserDatabaseFunctions.php";

require_once "EventDatabaseFunctions.php";

$userInfoArray = SQLGetUser();

$userTagTable = SQLGetUserTags();

$primaryTagArray = GetPrimaryInterestTag($userTagTable);

$locationsTable = array();

$eventTagTable = PerformSQLTAGSelect();

$sql = "SELECT EventsTable.* FROM EventUserJoinTable INNER JOIN EventsTable ON EventUserJoinTable.EventID = EventsTable.EventID WHERE EventUserJoinTable.UserID = ? AND EventUserJoinTable.Attending = 1";
PerformSQLSelect($sql, $_SESSION["id"]);

$eventsOwnedTable = GetEventsCreated();

if (isset($_SESSION["id"]))
{
    $attendingTable = GetEventsAttending();
    if (isset($_GET["attending"]))
    {
        UpdateAttending($_GET["eventID"]);
        $attendingTable = GetEventsAttending();
        PerformSQLSelect($sql, $_SESSION["id"]);
    }
}
?>

<div class='Page'>
    <div class='container-fluid'>
        <div class='row'>
            <div class='col-md-6 NameLocationColumn'>
                <div class='row'>
                    <h1 class='NameField col-sm-12'><?php echo $userInfoArray["Name"] . " " . $userInfoArray["LastName"]; ?></h1>
                </div>
                <div class='row'>
                    <p class='AddressField col-sm-12'><?php echo $userInfoArray["City"] . ", " . $userInfoArray["State"]; ?></p>
                </div>
            </div>
            <div class='col-md-6 RoleColumn'>
                <?php 
                if ($userInfoArray["Student"] == true)
                {
                ?>
                    <h4>Student</h4>
                <?php 
                }

                if ($userInfoArray["Educator"] == true)
                {
                ?>
                    <h4>Educator</h4>
                <?php 
                }

                if ($userInfoArray["CommunityLeader"] == true)
                {
                ?>
                    <h4>Community Leader</h4>
                <?php 
                }

                if ($userInfoArray["STEMAsset"] == true)
                {
                ?>
                    <h4>STEM Asset</h4>
                <?php 
                }
                ?>

            </div>
        </div>
        <div class='row'>
            <div class='InterestsAndTableArea col-md-10'> 
                <div class='row'>
                    <div class='col-md-4 InterestsColumn'>
                        <div class='row'>
                            <h3 class='InterestsTitle col-sm-12'>Interests</h3>
                        </div>
                        <div class='row'>
                            <div class='PrimaryInterestField col-sm-12'>
                                <input type='button' class='TagButton btn' value='<?php echo $primaryTagArray["TagName"]; ?>'>
                            </div>
                        </div>
                        <div class='row'>
                            <div class='InterestsField col-sm-12'>
                            <?php
                                for ($i = 0; $i < count($userTagTable); $i += 1)
                                {
                                    if ($userTagTable[$i]["PrimaryTag"] == 0)
                                    {
                            ?>
                                        <input type='button' class='TagButton btn' value='<?php echo $userTagTable[$i]["TagName"]; ?>'>
                            <?php
                                    }
                                }
                            ?>
                            </div>
                        </div>
                    </div>
                    <div class='col-md-8 mapTable'>
                        <div class='mapTableHeader row'>
                            <h3 class='TableHeaderText col-sm-12'>Events</h3>
                        </div>
                        <div class='mapTableContent row' id='output'>
                            <?php
                            for ($i = 0; $i < count($locationsTable); $i += 1)
                            {
                            ?>
                            <button class='mapTableItem col-md-12'>
                                <div class='ItemContent row'>
                                    <div class='col-sm-12'>
                                        <div class='EventNameRow row'>
                                            <div class='AttendButtonColumn col-sm-3'>
                                                <h4>Attending: </h4>
                                                <input type='checkbox' class='AttendingCheck' onclick='refreshPage("&attending=true&eventID=<?php echo $eventsOwnedTable[$i]["EventID"]; ?>")'
                                                <?php
                                                if (isset($attendingTable))
                                                {
                                                    for ($j = 0; $j < count($attendingTable); $j+=1)
                                                    {
                                                        if ($attendingTable[$j]["EventID"] == $locationsTable[$i]["EventID"] && $attendingTable[$j]["Attending"] == 1) 
                                                        { 
                                                            echo "checked";
                                                            break; 
                                                        }
                                                    } 
                                                }
                                                ?>
                                                >
                                            </div>
                                            <h4 class='EventNameField col-sm-6'><?php echo $locationsTable[$i]["EventName"]; ?></h4>
                                            <div class='TagButtonColumn col-sm-3'>
                                                <input type='button' class='TagsExpandButton btn' value='Tags' onclick="expandTagField(<?php echo $i; ?>)">
                                            </div>
                                        </div>
                                    </div>
                                    <div class='eventContent col-sm-12'>
                                        
                                        <div class='StartTimeField row'><h4><?php echo "Starts: " . ConvertDateTime($locationsTable[$i]["StartTime"]); ?></h4></div>
                                        <div class='EndTimeField row'><h4><?php echo "Ends: " . ConvertDateTime($locationsTable[$i]["EndTime"]); ?></h4></div>
                                        <div class='DescriptionField row'><h4><?php echo $locationsTable[$i]["Address"] . " " . $locationsTable[$i]["City"] . ", " . $locationsTable[$i]["State"]; ?></h4></div>
                                    </div>
                                    <div class='tagContent hiddenContent col-sm-8'>
                                        <?php 
                                        for ($j = 0; $j < count($eventTagTable); $j += 1)
                                        {
                                            if ($eventTagTable[$j]["EventID"] == $locationsTable[$i]["EventID"])
                                            {
                                        ?>
                                        <input type='button' class='tagButton btn' value='<?php echo $eventTagTable[$j]["TagName"] . ": " . $eventTagTable[$j]["EventTaggedAmount"]; ?>'>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <input type='button' class='tagButton addTagButton btn' value='+'>
                                    </div>
                                </div>
                            </button>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div class='row'>
            <div class='col-md-10 CreatedEventsColumn'>
                <div class='createdTableHeader row'>
                    <h3 class='createdTableHeaderText col-sm-12'>Events Created</h3>
                </div>
                <div class='createdTableContent row' id='output'>
                    <?php
                    for ($i = 0; $i < count($eventsOwnedTable); $i += 1)
                    {
                    ?>
                    <div class='createdTableItem col-md-12'>
                        <div class='ItemContent row'>
                            <div class='col-sm-12'>
                                <div class='EventNameRow row'>
                                    <div class='AttendButtonColumn col-sm-3'>
                                        <h4>Attending: </h4>
                                        <input type='checkbox' class='AttendingCheck' onclick='refreshPage("&attending=true&eventID=<?php echo $eventsOwnedTable[$i]["EventID"]; ?>")' <?php if ($eventsOwnedTable[$i]["Attending"] == 1) { echo "checked"; } ?>>
                                    </div>
                                    <h4 class='EventNameField col-sm-6'><?php echo $eventsOwnedTable[$i]["EventName"]; ?></h4>
                                </div>
                            </div>
                            <div class='eventContent col-sm-6'>
                                
                                <div class='StartTimeField row'><h4><?php echo "Starts: " . ConvertDateTime($eventsOwnedTable[$i]["StartTime"]); ?></h4></div>
                                <div class='EndTimeField row'><h4><?php echo "Ends: " . ConvertDateTime($eventsOwnedTable[$i]["EndTime"]); ?></h4></div>
                                <div class='DescriptionField row'><h4><?php echo $eventsOwnedTable[$i]["Address"] . " " . $eventsOwnedTable[$i]["City"] . ", " . $eventsOwnedTable[$i]["State"]; ?></h4></div>
                            </div>
                            <div class='tagContent col-sm-6'>
                                <?php 
                                for ($j = 0; $j < count($eventTagTable); $j += 1)
                                {
                                    if ($eventTagTable[$j]["EventID"] == $eventsOwnedTable[$i]["EventID"])
                                    {
                                ?>
                                <input type='button' class='tagButton btn' value='<?php echo $eventTagTable[$j]["TagName"] . ": " . $eventTagTable[$j]["EventTaggedAmount"]; ?>'>
                                <?php
                                    }
                                }
                                ?>
                                <input type='button' class='tagButton addTagButton btn' value='+'>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div> 
    </div>
    <script type='text/javascript'>
        function refreshPage(parameters)
        {
            document.location = '/npjTest/Templates/IndexTemplate.php?page=account' + parameters;
        }
    </script>
    <?php require_once "MapFunctions.php"; ?>