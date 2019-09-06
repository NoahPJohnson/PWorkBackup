<!--<script type='text/javascript'>
    var map;
    var infobox;
    function loadMapScenario() {
        map = new Microsoft.Maps.Map(document.getElementById('myMap'), {});
    }
</script>-->
<div id='printoutPanel'></div>
<div class="mapRow container-fluid row">
    <div id='myMap'></div>
</div>
<div id="output"></div>
<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT'></script>

<script type='text/javascript'>


    /*function geocode() {
        var query = document.getElementById('input').value;

        var geocodeRequest = "http://dev.virtualearth.net/REST/v1/Locations?query=" + encodeURIComponent(query) + "&jsonp=GeocodeCallback&key=" + BingMapsKey;

        CallRestService(geocodeRequest, GeocodeCallback);
    }*/


    function loadMapScenario() {
        //alert("loadMap");
        var map = new Microsoft.Maps.Map(document.getElementById('myMap'), {
        /* No need to set credentials if already passed in URL */
        //center: new Microsoft.Maps.Location(51.50632, -0.12714),
        //mapTypeId: Microsoft.Maps.MapTypeId.aerial,
        zoom: 10 
        });

        

        //var xmlhttp = new XMLHttpRequest();
        //var url = "https://dev.virtualearth.net/REST/v1/Locations/US/WA/Redmond/1%20Microsoft%20Way?&key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT"; //"sampleMap.json";//"myTutorials.txt";

        var state = "OH";
        var city = "Youngstown";
        var address = "42%20McClurg%20Road";
        //var url = "https://dev.virtualearth.net/REST/v1/Locations/US/OH/Youngstown/42%20McClurg%20Road?&key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT";
        var url = "https://dev.virtualearth.net/REST/v1/Locations/US/" + state + "/" + city + "/" + address + "?&key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT"; 

        //CallRestService(url, GeocodeCallback);
        //var jsonResponse;
        //alert("hey.");

        fetch(url)
        .then(res => res.json())
        .then((out) => {
            //console.log('Output: ', out);
            GeocodeCallback(out, map);
        }).catch(err => console.error(err));

           

                        
    }


    function CallRestService(request) {
        //alert("Big");
        var script = document.createElement("script");
        script.setAttribute("type", "text/javascript");
        script.setAttribute("src", request);
        script.setAttribute("id", "locationScript");
        document.body.appendChild(script);
    }

    function GeocodeCallback(response, pageMap) {
        //alert("CHUNGUS");
        var output = document.getElementById('output');
        var response1 = response;//JSON.parse(response);
            //alert("RESPONSE: " + response);
            //alert("response1 resourceSets: " + response1.resourceSets[0].resources[0].address.formattedAddress);
            //alert("response1 coordinates: " + response1.resourceSets[0].resources[0].geocodePoints[0].coordinates);
        if (response1 && response1.resourceSets && response1.resourceSets.length > 0 && response1.resourceSets[0].resources) 
        {

            var results = response1.resourceSets[0].resources;

            var html = ['<table><tr><td>Name</td><td>Latitude</td><td>Longitude</td></tr>'];

            for (var i = 0; i < results.length; i++) 
            {
                html.push('<tr><td>', results[i].name, '</td><td>', results[i].point.coordinates[0], '</td><td>', results[i].point.coordinates[1], '</td></tr>');
            }

            html.push('</table>');

            output.innerHTML = html.join('');

            CreatePushpin(pageMap, results[0].point.coordinates[0], results[0].point.coordinates[1]);
        } 
        else 
        {
            output.innerHTML = "No results found.";
        }
    }

    function CreatePushpin(pageMap, latitude, longitude) {
        
        //Create an infobox at the center of the map but don't show it.
        infobox = new Microsoft.Maps.Infobox(pageMap.getCenter(), {
            visible: false
        });
        
        //Assign the infobox to a map instance.
        infobox.setMap(pageMap);

        var pin = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(latitude, longitude));
        
        //Store some metadata with the pushpin.
        pin.metadata = {
            title: 'Pin Prodigal',
            description: 'Discription for pin Prodigal'
        };
        
        //Add a click event handler to the pushpin.
        Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
    
        //Add pushpin to the map.
        pageMap.entities.push(pin);
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




        //Old Random Locations Code
        /*
        //Create random locations in the map bounds.
        var randomLocations = Microsoft.Maps.TestDataGenerator.getLocations(5, map.getBounds());
                
        for (var i = 0; i < randomLocations.length; i++) 
        {
            var pin = new Microsoft.Maps.Pushpin(randomLocations[i]);
        
            //Store some metadata with the pushpin.
            pin.metadata = {
                title: 'Pin ' + i,
                description: 'Discription for pin ' + i
            };
        
            //Add a click event handler to the pushpin.
            Microsoft.Maps.Events.addHandler(pin, 'click', pushpinClicked);
        
            //Add pushpin to the map.
            map.entities.push(pin);
        }*/
</script>


<script type='text/javascript' src='https://www.bing.com/api/maps/mapcontrol?key=AlnP8Gprw2ihtVO-xJlsiQtvA7arzBhVZG3rlXriLN8vkmpZjDPT8yTClRogT9IT&callback=loadMapScenario' async defer></script>


