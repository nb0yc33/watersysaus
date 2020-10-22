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
            <div class="button-box">
                <a href="index.php">
                    <img src="images/logo.png" id="logo" alt="Water Systems Australia Logo">
                </a>
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
                    <button type="submit" class="btn btn-primary" onclick="getLocation();"><a>Get your location</a></button>
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
                        <button type="submit" class="btn btn-primary" name="submit-flag"> Submit flag </button>
                    </form>
                    <a class="btn btn-primary" href="#" role="button" id="report"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-exclamation-circle-fill" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                    </svg> Report issue </a>
                    <form action="connection.php" id="report-form" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="report-description" name="report-description" placeholder="Enter description">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit-issue"> Submit issue </button>
                    </form>
                </div>
                <div class="states-dropdown">
                    <button class="dropbtn">Select Your State/Territory</button>
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
        </div>
        <div class="map" id="map_id">
    </div>
    <!-- Hidden Table (Used to query data from)-->
    <div class="water-table"> 
                <table class="table table-condensed table-dark" id = "data-table-public">
                    <tr>
                        <th scope="col" onclick="sortTable(0)">Actions</th>
                        <th scope="col" onclick="sortTable(1)">CheckID</th>
                        <th scope="col" onclick="sortTable(2)">Latitude</th>
                        <th scope="col" onclick="sortTable(3)">Longitude</th>
                        <th scope="col" onclick="sortTable(4)">TestStatus</th>
				        <th scope="col" onclick="sortTable(5)">Ranking</th>
				        <th scope="col" onclick="sortTable(6)">Equipment</th>
				        <th scope="col" onclick="sortTable(7)">RecentTest</th>
				        <th scope="col" onclick="sortTable(8)">LastTest</th>
				        <th scope="col" onclick="sortTable(9)">Request</th>
			        	<th scope="col" onclick="sortTable(10)">RequestDate</th>
                    </tr>
                        
                    <?php
                        $conn = mysqli_connect("localhost", "gents", "truegents1", "water_quality");
                        // Check connection
                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }
                        $sql = "SELECT CheckID, Latitude, Longitude, TestStatus, Ranking, Equipment, RecentTest, LastTest, Request, RequestDate FROM Sites";
                        $result = $conn->query($sql);
                    
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                                $report_id = $row["CheckID"];
                                echo "<tr class='table-row'>  
                                        <td id= 'button-container'><button id='action-button' onclick='addressQuality($report_id)'>Actions</button></td>
                                        <td id= " . $row["CheckID"]. ">" . $row["CheckID"]. "</td>
                                        <td id= " . $row["CheckID"]. ">" . $row["Latitude"]. "</td>
                                        <td id= " . $row["CheckID"]. ">" . $row["Longitude"] . "</td>
                                        <td id= " . $row["CheckID"]. ">" . $row["TestStatus"] . "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["Ranking"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["Equipment"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["RecentTest"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["LastTest"]. "</td>
                                        <td id= " . $row["CheckID"]. ">". $row["Request"]. "</td>
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
        function changeMapToVic() {
            let lat = -36.456;
            let long = 144.2395;
            let zoom = 7;
            map.setView([lat, long], zoom);
        }

        function changeMapToQld() {
            let lat = -27.56;
            let long = 149.86;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        function changeMapToNsw() {
            let lat = -33.44;
            let long = 147.97;
            let zoom = 7;
            map.setView([lat, long], zoom);
        }

        function changeMapToNt() {
            let lat = -19.43;
            let long = 134.54;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        function changeMapToWa() {
            let lat = -25.89;
            let long = 121.311;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        function changeMapToSa() {
            let lat = -31.68143;
            let long = 136.79077;
            let zoom = 6;
            map.setView([lat, long], zoom);
        }

        function changeMapToAct() {
            let lat = -35.51;
            let long = 149.08;
            let zoom = 10;
            map.setView([lat, long], zoom);
        }

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

        function getTableLength(table) {
            var rows = table.rows,
            row_length = rows.length
            return row_length;
        }

        function addMarkers() {
            let tableLength = getTableLength(document.getElementById('data-table-public')); 
            let tableContents = tableToObj(document.getElementById('data-table-public'));

            for (let i = 0; i < tableLength - 1; i++) {
                var lat = tableContents[i].Latitude; // the longitude
                var long = tableContents[i].Longitude; // the latitude
                var status = tableContents[i].TestStatus; // the test status
                var ranking = tableContents[i].Ranking;  
                var checkID = tableContents[i].CheckId;
                if (status == 2 && ranking == 0) {
                    var badMarker = new L.marker([lat, long], {icon: redIcon}).addTo(map);
                    badMarker.bindPopup("This site is unsafe");
                } else if (status == 2 && ranking == 1) {
                    var avgMarker = new L.marker([lat, long], {icon: orangeIcon}).addTo(map);
                    avgMarker.bindPopup("This site should be treated with caution");
                } else if (status == 2 && ranking == 2) {
                    var goodMarker = new L.marker([lat, long], {icon: greenIcon}).addTo(map);
                    goodMarker.bindPopup("This site is safe!");
                    goodMarker.id = checkId;

                }
            }   
        }
        //loads the markers
        addMarkers();



        // Handles errors with geolocation
        function errorHandler(err) {
            if(err.code == 1) {
               alert("Error: Access is denied!");
            } else if( err.code == 2) {
               alert("Error: Position is unavailable!");
            }
         }

        // The main function which gets the geolocation data
        function getLocation() {
            if(navigator.geolocation) {
                // timeout at 60000 milliseconds (60 seconds)
                var options = {timeout:60000};
                navigator.geolocation.getCurrentPosition(showLocation, errorHandler, options);
            } else {
                alert("Sorry, browser does not support geolocation!");
            }
        }

        function onMapClick(e) {
            var marker = new L.marker(e.latlng).addTo(map);
            marker.bindPopup("You've flagged this location<br>" + "Latitude: " + e.latlng.lat +
                            "<br>Longitude: " + e.latlng.lng).openPopup();
        }
        map.on('click', onMapClick);

    </script>
    <script>
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

