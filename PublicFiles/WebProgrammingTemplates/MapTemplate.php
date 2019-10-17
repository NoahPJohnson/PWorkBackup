<?php


require_once "EventDatabaseFunctions.php";

$locationsTable = array();

$eventTagTable = PerformSQLTAGSelect();

$allTagsTable = GetAllTags();

if (!empty($_POST))
{
    var_dump($_POST);

    if (!empty(trim(filter_input(INPUT_POST, "textInput", FILTER_SANITIZE_STRING))))
    {

        $textInputValue = trim(filter_input(INPUT_POST, "textInput", FILTER_SANITIZE_STRING));

        $parameterText = '%' . $textInputValue . '%';
        $sql = "SELECT * FROM EventsTable WHERE EventName LIKE ?";
        PerformSQLSelect($sql, $parameterText);

        $sql = "SELECT * FROM EventsTable WHERE Type LIKE ?";
        PerformSQLSelect($sql, $parameterText);

        $sql = "SELECT * FROM EventsTable WHERE EventID = (SELECT EventID FROM EventTagJoinTable WHERE TagID = (SELECT TagID FROM TagTable WHERE TagName LIKE ?))";
        PerformSQLSelect($sql, $parameterText);
    }
}
else
{
    echo "Empty.   ";

    $sql = "SELECT * FROM EventsTable";
    PerformSQLSelect($sql, "");
}

if (isset($_SESSION["id"]))
{
    $attendingTable = GetEventsAttending();
    if (isset($_GET["attending"]))
    {
        UpdateAttending($_GET["eventID"]);
        $attendingTable = GetEventsAttending();
        PerformSQLSelect($sql, $_SESSION["id"]);
    }
    if (isset($_GET["tag"]))
    {
        UpdateTag($_GET["eventid"], $_GET["tagid"]);
        $eventTagTable = PerformSQLTAGSelect();
    }
    if (isset($_GET["newtag"]))
    {
        AddATag($_GET["eventid"], $_GET["tagid"]);
        $eventTagTable = PerformSQLTAGSelect();
    }
}
?>


<div class='Page'>
<div id='printoutPanel'></div>
<div class='inputRow container-fluid'>
    <form class='row' action='<?php echo htmlspecialchars($_SERVER["REQUEST_URI"]); ?>' method='post'>
        <input type='text' name='textInput'>
        <input type='date' name='dateInput'>
        <input type='submit' name='searchButton' value='Search'>
    </form>
</div> 
<div class='mapRow container-fluid row'>
    <div class='col-md-6' id='myMap'>
    </div>
    <div class='col-md-4 mapTable' id='generalMapTable'>
        <div class='mapTableHeader row'>
            <h3 class='TableHeaderText col-sm-12'>Events</h3>
        </div>
        <div class='mapTableContent row' id='output'>
            <?php
            for ($i = 0; $i < count($locationsTable); $i += 1)
            {
            ?>
            <button class='mapTableItem col-md-12' onclick="SelectEventFromList(<?php echo $i; ?>, <?php echo count($locationsTable); ?>)">
                <div class='ItemContent row'>
                    <div class='col-sm-12'>
                        <div class='EventNameRow row'>
                            <div class='AttendButtonColumn col-sm-4'>
                                <h4>Attending: </h4>
                                <input type='checkbox' class='AttendingCheck' onclick='refreshPage("&attending=true&eventID=<?php echo $locationsTable[$i]["EventID"]; ?>")'
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
                            <h4 class='EventNameField col-sm-5'><?php echo $locationsTable[$i]["EventName"]; ?></h4>
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
                        <input type='button' class='tagButton btn' id='<?php echo $eventTagTable[$j]["TagID"]; ?>' value='<?php echo $eventTagTable[$j]["TagName"] . ": " . $eventTagTable[$j]["Tagged"]; ?>' onclick='refreshPage("&tag=true&eventid=<?php echo $eventTagTable[$j]["EventID"]; ?>&tagid=<?php echo $eventTagTable[$j]["TagID"]; ?>")'>
                        <?php
                            }
                        }
                        ?>
                        <input type='button' class='tagButton addTagButton btn' value='+' onclick='ShowAdditionalTags("generalMapTable", <?php echo $i; ?>, <?php echo $locationsTable[$i]["EventID"]; ?>)'>
                    </div>
                </div>
            </button>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<div class='additionalTagsBox hiddenContent' id='additionalTags'>
    <?php
    for ($k = 0; $k < count($allTagsTable); $k += 1)
    {
    ?>
        <input type='button' class='newTagButton btn' id='<?php echo $allTagsTable[$k]["TagID"]; ?>' value='<?php echo $allTagsTable[$k]["TagName"]; ?>'>
    <?php
    }
    ?>
</div>

<!--<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT'></script>-->
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT&callback=loadMapScenario' async defer></script>
<script type='text/javascript'>
    function refreshPage(parameters)
    {
        document.location = '/npjTest/Templates/IndexTemplate.php?page=map' + parameters;
    }
    function ShowAdditionalTags(tableID, tagContentIndex, eventID)
        {
            
            for (var i = 0; i < document.getElementById("additionalTags").getElementsByClassName("newTagButton").length; i += 1)
            {
                document.getElementById("additionalTags").getElementsByClassName("newTagButton")[i].classList.remove("hiddenContent");
                document.getElementById("additionalTags").getElementsByClassName("newTagButton")[i].onclick=null;
                for (var j = 0; j < document.getElementById(tableID).getElementsByClassName("tagContent")[tagContentIndex].getElementsByClassName("tagButton").length; j += 1)
                {
                    if (document.getElementById("additionalTags").getElementsByClassName("newTagButton")[i].id == document.getElementById(tableID).getElementsByClassName("tagContent")[tagContentIndex].getElementsByClassName("tagButton")[j].id)
                    {
                        document.getElementById("additionalTags").getElementsByClassName("newTagButton")[i].classList.add("hiddenContent");
                    }
                }
                var tagID = document.getElementById("additionalTags").getElementsByClassName("newTagButton")[i].id;
                document.getElementById("additionalTags").getElementsByClassName("newTagButton")[i].addEventListener('click', function() {refreshPage('&newtag=true&eventid='+eventID+'&tagid=' + this.id)});
            }
            document.getElementById("additionalTags").classList.remove("hiddenContent");
            document.getElementById(tableID).getElementsByClassName("tagContent")[tagContentIndex].appendChild(document.getElementById("additionalTags"));
        }
</script>
<?php require_once "MapFunctions.php"; ?>





