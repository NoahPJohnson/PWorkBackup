
<script type='text/javascript'>

var pinArray = Array();

    function expandTagField(contentIndex) {
        if (document.getElementsByClassName("tagContent")[contentIndex].classList.contains('hiddenContent'))
        {
            document.getElementsByClassName("tagContent")[contentIndex].classList.remove('hiddenContent');
            if (document.getElementsByClassName("eventContent")[contentIndex].classList.contains('col-sm-12'))
            {
                document.getElementsByClassName("eventContent")[contentIndex].classList.remove('col-sm-12');
                document.getElementsByClassName("eventContent")[contentIndex].classList.add('col-sm-4');
            }
        }
        else
        {
            document.getElementsByClassName("tagContent")[contentIndex].classList.add('hiddenContent');
            if (document.getElementsByClassName("eventContent")[contentIndex].classList.contains('col-sm-4'))
            {
                document.getElementsByClassName("eventContent")[contentIndex].classList.remove('col-sm-4');
                document.getElementsByClassName("eventContent")[contentIndex].classList.add('col-sm-12');
            }
        }
    }

    function loadMapScenario() {
        //alert("loadMap");
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
        /* No need to set credentials if already passed in URL */
        //center: new Microsoft.Maps.Location(51.50632, -0.12714),
        //mapTypeId: Microsoft.Maps.MapTypeId.aerial,
        zoom: 10 
        });

        var EventTableArray = Array();

        <?php
        //echo "Count: " . count($locationsTable);
        for ($i = 0; $i < count($locationsTable); $i += 1)
        {
        ?>
            var EventTableRow = {state: "", city: "", address: "", url: "", eventName: "", startTime: "", endTime: "", type: ""};

            EventTableRow["state"] = '<?php echo $locationsTable[$i]["State"]; ?>';//"OH";
            EventTableRow["city"] = '<?php echo $locationsTable[$i]["City"]; ?>'; //"Youngstown";
            var address = '<?php echo $locationsTable[$i]["Address"]; ?>'; //"42%20McClurg%20Road";
            var addressArray = address.split(" ");
            var urlAddress = "";
            for (var j = 0; j < addressArray.length; j += 1)
            {
                urlAddress += addressArray[j];
                if ((j+1) < addressArray.length)
                {
                    urlAddress += "%20";
                }
            }

            EventTableRow["address"] = urlAddress;

            //var url = "https://dev.virtualearth.net/REST/v1/Locations/US/OH/Youngstown/42%20McClurg%20Road?&key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT";
            var url = "https://dev.virtualearth.net/REST/v1/Locations/US/" + EventTableRow["state"] + "/" + EventTableRow["city"] + "/" + EventTableRow["address"] + "?&key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT"; 

            EventTableRow["url"] = url;

            EventTableRow["eventName"] = '<?php echo $locationsTable[$i]["EventName"]; ?>';
            EventTableRow["startTime"] = '<?php echo $locationsTable[$i]["StartTime"]; ?>';
            EventTableRow["endTime"] = '<?php echo $locationsTable[$i]["EndTime"]; ?>';
            EventTableRow["type"] = '<?php echo $locationsTable[$i]["Type"]; ?>';

            EventTableArray.push(EventTableRow);
        <?php
        }
        ?>
        
        

        var index = 0;
        RecursiveFetch(EventTableArray, index, map);
        //for (var i = 0; i < 3; i += 1)
        //{
            /*var fetchPromise = new Promise(function(resolve, reject) {
                ;
                var index = i;
                resolve(index);
            });*/


            //fetch(EventTableArray[i]["url"])
            
        //}
    }

    function RecursiveFetch(eventTable, eventIndex, map) {
        fetch(eventTable[eventIndex]["url"])
                .then(res => res.json())
                    .then((out) => {
                        //console.log('Output: ', out);
                        
                        GeocodeCallback(out, map, eventTable[eventIndex]);
                        eventIndex += 1;
                        if (eventIndex < eventTable.length) 
                        {
                            RecursiveFetch(eventTable, eventIndex, map);
                        }
                    }).catch(err => console.error(err)); 
    }

    /*
    function CallRestService(request) {
        //alert("Big");
        var script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        script.setAttribute("src", request);
        script.setAttribute("id", "locationScript");
        document.body.appendChild(script);
    }*/

    function GeocodeCallback(response, pageMap, eventList) {
        //alert("CHUNGUS");
        var output = document.getElementById('output');
        var response1 = response;

        if (response1 && response1.resourceSets && response1.resourceSets.length > 0 && response1.resourceSets[0].resources) 
        {

            var results = response1.resourceSets[0].resources;

            /*var html = [''];

            for (var i = 0; i < results.length; i++) 
            {
                html.push('<tr><td>', eventList["eventName"], '</td><td>', eventList["startTime"], '</td><td>', eventList["endTime"], '</td></tr>');
            }
            output.innerHTML += html.join('');*/

            CreatePushpin(pageMap, results[0].point.coordinates[0], results[0].point.coordinates[1], eventList);
        } 
        else 
        {
            output.innerHTML = "No results found.";
        }
    }

    function CreatePushpin(pageMap, latitude, longitude, pinEventList) {
        
        //Create an infobox at the center of the map but don't show it.
        infobox = new Microsoft.Maps.Infobox(pageMap.getCenter(), {
            visible: false
        });
        
        //Assign the infobox to a map instance.
        infobox.setMap(pageMap);
        if (pinEventList["type"] == 'Science')
        {
            var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(latitude, longitude), {color: 'green'});
        }
        else if (pinEventList["type"] == 'Technology')
        {
            var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(latitude, longitude), {color: 'purple'});
        }
        else if (pinEventList["type"] == 'Engineering')
        {
            var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(latitude, longitude), {color: 'orange'});
        }
        else if (pinEventList["type"] == 'Mathematics')
        {
            var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(latitude, longitude), {color: 'blue'});
        }
        else
        {
            var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(latitude, longitude));
        }

        //Store some metadata with the pushpin.
        pin.metadata = {
            title: pinEventList["eventName"],
            description: 'Starts: ' + pinEventList["startTime"] + ' Ends: ' + pinEventList["endTime"]
        };
        
        //Add a click event handler to the pushpin.
        Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
    
        //Add pushpin to the map.
        pageMap.entities.push(pin);

        pinArray.push(pin);
    }

    
    function pushpinClicked(e) {
        //Make sure the infobox has metadata to display.
        if (e.target.metadata) 
        {
            //Set the infobox options with the metadata of the pushpin.
            infobox.setOptions({
                location: e.target.getLocation(),
                title: e.target.metadata.title,
                description: e.target.metadata.description,
                visible: true
            });
        }
    }

    function pushpinSelected(pinSelected) {
        if (pinSelected.metadata) 
        {
            infobox.setOptions({
                location: pinSelected.getLocation(),
                title: pinSelected.metadata.title,
                description: pinSelected.metadata.description,
                visible: true
            });
        }
    }

function SelectEventFromList(index, eventCount) {
    for (var j = 0; j < eventCount; j += 1)
    {
        document.getElementsByClassName("mapTableItem")[j].classList.remove("Selected");
        document.getElementsByClassName("mapTableItem")[j].setAttribute("name","");
    }
    document.getElementsByClassName("mapTableItem")[index].classList.add("Selected");
    document.getElementsByClassName("mapTableItem")[index].setAttribute("name","Selected");
    pushpinSelected(pinArray[index]);
}
</script>





