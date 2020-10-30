<html>
    <head>  
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Public View </title>
        <link rel="stylesheet" href="css/sidebar.css">

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
         crossorigin=""/>
         <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
         crossorigin=""></script>

        <!--Leaflet CDN-->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
         crossorigin=""/>
         <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
         crossorigin=""></script>

        <!-- Load Esri Leaflet from CDN -->
        <script src="https://unpkg.com/esri-leaflet@2.5.1/dist/esri-leaflet.js"
        integrity="sha512-q7X96AASUF0hol5Ih7AeZpRF6smJS55lcvy+GLWzJfZN+31/BQ8cgNx2FGF+IQSA4z2jHwB20vml+drmooqzzQ=="
        crossorigin=""></script>

        <!-- Geocoding Control -->
        <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.css"
        integrity="sha512-IM3Hs+feyi40yZhDH6kV8vQMg4Fh20s9OzInIIAc4nx7aMYMfo+IenRUekoYsHZqGkREUgx0VvlEsgm7nCDW9g=="
        crossorigin="">
        <script src="https://unpkg.com/esri-leaflet-geocoder@2.3.3/dist/esri-leaflet-geocoder.js"
        integrity="sha512-HrFUyCEtIpxZloTgEKKMq4RFYhxjJkCiF5sDxuAokklOeZ68U2NPfh4MFtyIVWlsKtVbK5GD2/JzFyAfvT5ejA=="
        crossorigin=""></script>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <?php include('connection.php'); ?>
    </head>
    <body>  
    <div class="grid-container">
        <div class="sidebar">
            <a href="index.php">
                <img src="images/logo.svg" id="logo" alt="Water Systems Australia Logo">
            </a>
            <div class="button-box">
                <div class="messages">
                    <?php include('errors.php'); ?>
                        <?php if (isset($_SESSION['flag-success'])) : ?>
                            <div class="success">
                                <?php 
                                      echo $_SESSION['flag-success']; 
                                      unset($_SESSION["flag-success"]); 
                                ?>
                            </div>
                        <?php endif ?>
                        <?php if (isset($_SESSION['issue-success'])) : ?>
                            <div class="success">
                                <?php 
                                      echo $_SESSION['issue-success'];
                                      unset($_SESSION["issue-success"]); 
                                ?>
                            </div>
                        <?php endif ?>
                </div>
                <form class="get-location">
                    <button class="btn btn-primary" id="location-button">Get your location</button>
                </form>
                <div class="submit-info">
                    <a class="btn btn-primary" href="#" role="button" id="flag"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-plus" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                    <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                    <path fill-rule="evenodd" d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                    </svg> Flag site </a>
                    <form action="connection.php" id="flag-form" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="latitude" name="latitude" placeholder="Enter latitude">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="longitude" name="longitude" placeholder="Enter longitude">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="flag-description" name="flag-description" placeholder="Enter description">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit-flag" id="submission-submit"> Submit flag </button>
                    </form>
                    <a class="btn btn-primary" href="#" role="button" id="report"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg> Report issue </a>
                    <form action="connection.php" id="report-form" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="report-description" name="report-description" placeholder="Enter description">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit-issue" id="submission-report">> Submit issue </button>
                    </form>
                </div>
                <div class="states-dropdown">
                    <button class="dropbtn">Select your state/territory</button>
                    <div class = "states">
                        <button id="QLD" onclick="changeMapToQld();">Queensland</button>
                        <button id="NSW" onclick="changeMapToNsw();">New South Wales</button>
                        <button id="WA" onclick="changeMapToWa();">Western Australia</button>
                        <button id="ACT" onclick="changeMapToAct();">Australian Capital Territory</button>
                        <button id="NT" onclick="changeMapToNt();">Northern Territory</button>
                        <button id="TAS" onclick="changeMapToTas();">Tasmania</button>
                        <button id="VIC" onclick="changeMapToVic();">Victoria</button>
                        <button id="SA" onclick="changeMapToSa();">South Australia</button>
                    </div>
                </div>
            </div>
            <div class="site-info">
            <img src="images/close-button.png" id="close-form" alt="">
                <div class="info">
                    <h3 class="site-form-headings" id="id-heading">Location ID</h3>
                    <p class="site-form-values" id="site-id"></p>
                    <h3 class="site-form-headings" id="latitude-heading">Latitude</h3>
                    <p class="site-form-values" id="latitude-value"></p>
                    <h3 class="site-form-headings" id="longitude-heading">Longitude</h3>
                    <p class="site-form-values" id="longitude-value"></p>
                    <h3 class="site-form-headings" id="status-heading">Status</h3>
                    <div class="status-div">
                        <p class="site-form-values" id="status-value"></p>
                        <!-- <div>Icons made by <a href="http://www.freepik.com/" title="Freepik">Freepik</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a></div> -->
                        <img src="images/info.png" class="info-img" alt="">
                        <div class=info-message>
                            <p id="message"></p>
                        </div>
                        <script>
                            let infoMessage = document.querySelector(".info-message");
                            infoMessage.style.display = "none";
                        </script>
                    </div>
                    <h3 class="site-form-headings" id="request-date-heading">Request Date</h3>
                    <p class="site-form-values" id="request-date-value"></p>
                    <h3 class="site-form-headings" id="test-date-heading">Test Date</h3>
                    <p class="site-form-values" id="test-date-value"></p>
                    <h3 class="site-form-headings" id="equipment-heading">Tested With:</h3>
                    <p class="site-form-values" id="equipment-value"></p>
                </div>
            </div>
            <script>
                siteInfo = document.querySelector(".site-info")
                siteInfo.style.display = "none";
            </script>
        </div>
        <div class="map" id="map_id">
    </div>
    <!-- Hidden Table (Used to query data from)-->
    <div class="water-table-public">
                <table class="table table-condensed table-dark" id ="data-table-public">
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">CheckID</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">TestStatus</th>
                        <th scope="col">Ranking</th>
                        <th scope="col">Equipment</th>
                        <th scope="col">TestDate</th>
                        <th scope="col">RequestDate</th>
                    </tr>
                        
                    <?php
                        $conn = mysqli_connect("localhost", "gents", "truegents1", "water_quality");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT CheckID, Latitude, Longitude, TestStatus, Ranking, Equipment, TestDate, RequestDate FROM Sites";
                        $result = $conn->query($sql);
                    
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $report_id = $row["CheckID"];
                                echo "<tr class='table-row'>  
                                        <td><button id='edit' href='account.php?resolve=$report_id'>Resolve</button></td>
                                        <td id= " . $row["CheckID"]. ">" . $row["CheckID"]. "</td>
                                        <td id= " . $row["CheckID"]. ">" . $row["Latitude"]. "</td>
                                        <td id= " . $row["CheckID"]. ">" . $row["Longitude"] . "</td>
                                        <td id= " . $row["CheckID"]. ">" . $row["TestStatus"] . "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["Ranking"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["Equipment"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["TestDate"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["RequestDate"]. "</td>
                                    </tr>";
                            }
                            echo "</table>";
                        } else { 
                            echo "0 results"; 
                        }
                        $conn->close();
                    ?>
                </table>
            </div>

    </body>
    <script>

        var redIcon = L.icon({ // red is for unsafe sites
            iconUrl: "images/Red_Marker_New.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });

        var orangeIcon = L.icon({ // orange is for safe for some activities
            iconUrl: "images/Orange_Marker_New.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });

        var greenIcon = L.icon({ // green is safe for all activities
            iconUrl: "images/Green_Marker_New.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });

        // Written by Seb
        // The default map is set to be a view of all of Australia
        let map = L.map('map_id').setView([-25.495375, 133.718096], 5);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoicy1uYXJsbyIsImEiOiJja2Vod3F3Z3UwZXN6MnJvaHNneWhyNWRoIn0.Bix4XksIzlP276mM3_Bd0g'
        }).addTo(map);

        // Updates the map to show the users current location. 
        function showLocation(position) {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;
            map.setView([lat, long], 13);
        }

        //Location changing for states 
        // Changes map to Victoria
        function changeMapToVic() {
            let lat = -36.456;
            let long = 144.2395;
            let zoom = 7;
            map.setView([lat, long], zoom);
        }

        // Changes map to Queensland
        function changeMapToQld() {
            let lat = -27.56;
            let long = 149.86;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        // Changes map to New South Wales
        function changeMapToNsw() {
            let lat = -33.44;
            let long = 147.97;
            let zoom = 7;
            map.setView([lat, long], zoom);
        }

        // Changes mapt to Northern Territory
        function changeMapToNt() {
            let lat = -19.43;
            let long = 134.54;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        // Changes map to Western Australia
        function changeMapToWa() {
            let lat = -25.89;
            let long = 121.311;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        // Changes map to South Australia
        function changeMapToSa() {
            let lat = -31.68143;
            let long = 136.79077;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        // Changes map to ACT       
        function changeMapToAct() {
            let lat = -35.51;
            let long = 149.08;
            let zoom = 10;
            map.setView([lat, long], zoom);
        }

        // Changes map to Tasmania
        function changeMapToTas() {
            let lat = -42.44;
            let long = 146.61;
            let zoom = 7;
            map.setView([lat, long], zoom);
        }
   
        //Search functionality (Seb)
        var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider(); // search provider
        L.esri.Geocoding.geosearch({
        providers: arcgisOnline,
        }).addTo(map);

        // Convert Table to JSON object
        var tableToObj = function(table) {
            var rows = table.rows,
            row_length = rows.length,
            i = 0,
            j = 0,
            keys = [],
            obj, list = [];
            for (; i < row_length; i++) {
                if (i == 0) {
                for (; j < rows[i].children.length; j++) {
                    keys.push(rows[i].children[j].innerHTML);
                }
            } else {
                obj = {};
                for (j = 0; j < rows[i].children.length; j++) {
                    obj[keys[j]] = rows[i].children[j].innerHTML;
                    }
                    list.push(obj);
                }
            }
            return list;
        };

        // Gets the length of the table 
        function getTableLength(table) {
            var rows = table.rows,
            row_length = rows.length
            return row_length;
        }
        
        let markerMap = new Map() // a map data structure which maps ids to the data
        // Function to add markers to the map 
        function addMarkers() { 
            let tableLength = getTableLength(document.getElementById('data-table-public')); 
            let tableContents = tableToObj(document.getElementById('data-table-public'));
        
            for (let i = 0; i < tableLength - 1; i++) {
                let idContents = [] // the array the id maps to 
                var checkID = tableContents[i].CheckID; // the primary key of the test data
                var lat = tableContents[i].Latitude; // the longitude
                var long = tableContents[i].Longitude; // the latitude
                var status = tableContents[i].TestStatus; // the test status
                var ranking = tableContents[i].Ranking; // the ranking of the water data
                var equipment = tableContents[i].Equipment; // the equipment used for the test 
                var testDate = tableContents[i].TestDate; // the day the request was made on the site
                var requestDate = tableContents[i].RequestDate; // the day the site was tested 
                // need to add test data and request data
                idContents.push(lat, long, ranking, equipment, testDate, requestDate);
                markerMap[String(checkID)] = idContents;

                if (status == 'Tested' && ranking == 'Bad') { // what to do if the location has bad water
                    var badMarker = new L.marker([lat, long], {icon: redIcon}).on('click', sideBarFunction).addTo(map);
                    badMarker.id = 'marker' + checkID;
                } else if (status == 'Tested' && ranking == 'Okay') {  // what to do if the location has okay water
                    var avgMarker = new L.marker([lat, long], {icon: orangeIcon}).on('click', sideBarFunction).addTo(map);
                    avgMarker.id = 'marker' + checkID;
                } else if (status == 'Tested' && ranking == 'Good' || ranking == 'Great') {  // what to do if the location has good/great water
                    var goodMarker = new L.marker([lat, long], {icon: greenIcon}).on('click', sideBarFunction).addTo(map);
                    goodMarker.id = 'marker' + checkID;
                }
            }   
        }
        //loads the markers
        addMarkers();

        // A dictionary which retrieves the colour the status message should be
        let colourDict =  {
            "Great": "Green",
            "Good": "Green", 
            "Okay": "Orange",
            "Bad": "Red",
        };

        // A dictionary which maps the message based on the water status 
        let safetyMessage = {
            "Great": "This test site has been determined to be safe to perform all water sports activites. Examples include: Fishing, Wakeboarding, Swimming etc.",
            "Good": "This test site has been determined to be safe to perform all water sports activites. Examples include: Fishing, Wakeboarding, Swimming etc.", 
            "Okay": "This site has indicated levels which are safe for genral watrer activities. Any consumption is highly not recommended.",
            "Bad": "This site has indicated dangerous results and should be avoided. Further investigations will be completed.",
        }

        // Function which opens the information about the site clicked (Seb)
        function sideBarFunction(e) {
            // Opening and closing of the two forms on the sidebar
            buttonBox = document.querySelector('.button-box');
            buttonBox.style.display = 'none';
            siteInfo = document.querySelector('.site-info');
            siteInfo.style.display = 'flex';
            siteInfo.style.top = '20%';
            
            markerID = e.target.id.split('marker')[1]; // get the key for the map
            siteLatVal = markerMap[markerID][0];
            siteLongVal = markerMap[markerID][1];
            siteStatusVal = markerMap[markerID][2];
            siteEquipmentVal = markerMap[markerID][3];
            siteTestDateVal = markerMap[markerID][4];
            siteRequestDateVal =  markerMap[markerID][5];

            // Set values on form 
            //ID
            siteID = document.getElementById("site-id");
            siteID.innerHTML = markerID;
            // Latitude 
            siteLatitude = document.getElementById("latitude-value");
            siteLatitude.innerHTML = siteLatVal;
            // Longitude
            siteLongitude = document.getElementById("longitude-value");
            siteLongitude.innerHTML = siteLongVal;
            // Site status 
            siteStatus = document.getElementById("status-value");
            siteStatus.innerHTML = siteStatusVal; 
            siteStatus.style.color = colourDict[siteStatusVal];
            siteStatus.style.fontWeight = "bold";
            // Request date
            siteRequestDate = document.getElementById("request-date-value");
            siteRequestDate.innerHTML = siteRequestDateVal;
            // Test date
            siteTestDate = document.getElementById("test-date-value");
            siteTestDate.innerHTML = siteTestDateVal;
            // Equipment
            siteEquipment = document.getElementById("equipment-value");
            siteEquipment.innerHTML = siteEquipmentVal;

            // Getting the onformation message on hover 
            infoImg = document.querySelector('.info-img');
            let infoMessage = document.querySelector('.info-message');
            infoImg.addEventListener('mouseover', () => { // for mouse on 
                infoMessage.style.display = 'flex';
            });
            infoImg.addEventListener('mouseout', () => {
                infoMessage.style.display = 'none';
            })


            siteMessage = document.getElementById('message');
            siteMessage.innerHTML = safetyMessage[siteStatusVal];
        }


        closeForm = document.getElementById('close-form');
        closeForm.addEventListener('click', closeSiteInfoForm);
        
        // Close the form when the user clicks the cross (Seb)
        function closeSiteInfoForm() {
            // Open the button menu
            buttonBox = document.querySelector('.button-box');
            buttonBox.style.display = 'flex';

            // Close the site info
            siteInfo = document.querySelector('.site-info');
            siteInfo.style.display = 'none';    
        }


        // Handles errors with geolocation
        function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            } else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         }
        
        // Gets the location of the user when the button is clicked
        locationGetter = document.getElementById("location-button");
        locationGetter.addEventListener('click', getLocation()); 

        // The main function which gets the geolocation data
        function getLocation() {
            if(navigator.geolocation) {
                // timeout at 6000 milliseconds (60 seconds)
                var options = {timeout:60000};
                navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
            } else {
                alert("Sorry, browser does not support geolocation!");
            }
        }
        
        var selectIcon = L.icon({ // red is for unsafe sites
            iconUrl: "images/select-marker.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });
    
             // Function for removing the marker if there is no click
            //     var features = [];
            //     map.eachLayer( function(layer) {
            //     if(layer instanceof L.Marker) {
            //     if(map.getBounds().contains(layer.getLatLng())) {
            //         features.push(layer);
            //     }
            //     // reload page at old coords? 
            // }
            // for (let i = 0; i < features.length; i++) {
            //     if (features[i].id == 'select-marker') {
            //         map.removeLayer(features[i]);
            //         jQuery('#flag-form').toggle('close');
            //     }
            // }});
         

            
        // Handle public marker requests. Adds marker on click location 
        // and proceeds to save or discard the marker
        function onMapClick(e) {
            var marker = new L.marker(e.latlng, {icon: selectIcon}).addTo(map);
            marker.id = "select-marker";
            marker.bindPopup("You've flagged this location<br><br>" + "Latitude: " + e.latlng.lat +
                            "<br>Longitude: " + e.latlng.lng + "<br><br> Are you sure you want to flag this location?" + 
                            "<br><div class='popup-btns'><button class='popup-yes'>Yes</button><button class='popup-no'>No</button></div>").openPopup();

            // remove the close button of the popup
            closeButton = document.querySelector('.leaflet-popup-close-button');
            closeButton.style.display = 'none';


              // // open the flag window
            jQuery('#flag-form').toggle('show');
            // Close form if no is selected on the popup
            flagNo = document.querySelector(".popup-no");
            flagNo.addEventListener('click', () => {
                map.removeLayer(marker);
                map.once('click', onMapClick);
                marker.closePopup();
                marker.unbindPopup();
                jQuery('#flag-form').toggle('show');
            });
            
    
            // Add geographical info to table on the left if clicked yes
            flagYes = document.querySelector(".popup-yes");
            flagYes.addEventListener('click', () => {
                latitude = document.getElementById('latitude');
                latitude.value = e.latlng.lat;
                longitude = document.getElementById('longitude');
                longitude.value = e.latlng.lng;
                marker.closePopup();
                marker.unbindPopup();
            });

        
        }
        map.once('click', onMapClick); // only allows one map click 
        


        


    </script>
    <script>
        // A script to open the forms when the flag site or report buttons are pressed
        jQuery(document).ready(function(){
            jQuery('#flag').on('click', function(event) {        
                jQuery('#flag-form').toggle('show');
            });
        });
        jQuery(document).ready(function(){
            jQuery('#report').on('click', function(event) {        
                jQuery('#report-form').toggle('show');
            });
        });
    </script>

</html>

