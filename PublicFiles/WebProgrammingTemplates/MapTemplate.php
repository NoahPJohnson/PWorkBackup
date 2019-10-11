<?php


require_once "EventDatabaseFunctions.php";

$locationsTable = array();

$eventTagTable = PerformSQLTAGSelect();

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
    <div class='col-md-4 mapTable'>
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
                            <h4 class='EventNameField col-sm-9'><?php echo $locationsTable[$i]["EventName"]; ?></h4>
                            <div class='TagButtonColumn col-sm-3'>
                                <input type='button' class='TagsExpandButton btn' value='Tags' onclick="expandTagField(<?php echo $i; ?>)">
                            </div>
                        </div>
                    </div>
                    <div class='eventContent col-sm-12'>
                        
                        <div class='StartTimeField row'><h4><?php echo "Starts: " . ConvertDateTime($locationsTable[$i]["StartTime"]); ?></h4></div>
                        <div class='EndTimeField row'><h4><?php echo "Ends: " . ConvertDateTime($locationsTable[$i]["EndTime"]); ?></h4></div>
                        <div class='EndTimeField row'><p>Sample Text. This will eventually be the description value from the database.</p></div>
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

<!--<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT'></script>-->
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT&callback=loadMapScenario' async defer></script>
<?php require_once "MapFunctions.php"; ?>





