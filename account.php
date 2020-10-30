<?php 

  // Start user account session and respond accordingly to user actions
  session_start(); 

  if (!isset($_SESSION['username'])) {
  $_SESSION['msg'] = "You must log in first";
  	header('location: login-portal.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login-portal.php");
  }
?>
<html>
    <head>  
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<title> Account </title>
        <link rel="stylesheet" href="css/sidebar.css">

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

        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"></script>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"/> <!--Geosearch-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <?php include('connection.php'); ?>
    </head>
    <body>  
    <!-- Establish account page layout -->
    <div class="grid-container-2">
        <div class="sidebar-2">
            <div class="button-box">
                <a href="index.php">
                    <img src="images/logo.png" id="logo" alt="Water Systems Australia Logo">
                </a>
                <div class="messages">
                <!-- Include errors and the ability for user to logout -->
                <?php include('errors.php'); ?>
                    <?php  if (isset($_SESSION['username'])) : ?>
			            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>&nbsp;
			            <p><a href="account.php?logout='1'" style="color: red;">Logout</a></p>
                    <?php endif ?>
                </div>
                <!-- Require connection php file for echoing session message -->
                <?php require_once 'connection.php'; ?>

                <?php
                if (isset($_SESSION['message'])){
                    echo $_SESSION['message'];
                }
                ?>
                <!-- Input section for government officials to resolve requests. This is done dynamically. -->
                <div class="address-quality">
                <form action="connection.php" id="gov-form" method="POST">
                    <input type="hidden" name="id" value="<?php echo $row["CheckID"]; ?>">
                    <div class="form-group">
                        <input type="number" class="form-control" name="check-id"
                               placeholder="Enter ID" value="<?php echo $checkid; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="test-status"
                            placeholder="Enter test status" value="<?php echo $teststatus; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="water-ranking"
                            placeholder="Enter water ranking" value="<?php echo $testranking; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="equipment"
                            placeholder="Enter equipment" value="<?php echo $equipment; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="test-date"
                            placeholder="Enter test date" value="<?php echo $testdate; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit-gov">Submit water data</button>
                </form>      
                </div>                                  
            </div>
        </div>
        <div class="main-2">
            <div class="map-2" id="mapid"></div>
            <!-- Establishing sql connection and performing data retrieval for representation as table -->
            <?php
                $conn = new mysqli('localhost', 'gents', 'truegents1', 'water_quality') or die(mysqli_error($conn));
                $sql = $conn->query("SELECT CheckID, Latitude, Longitude, TestStatus, Ranking, Equipment, TestDate, RequestDate FROM Sites") or die($conn->error);
            ?>
            <div class="water-table-gov">
                <table class="table table-condensed table-dark" id ="data-table">
                    <thead>
                        <tr>
                            <!-- Headings for request data table -->
                            <th scope="col" onclick="sortTable(0)">Actions</th>
                            <th scope="col" onclick="sortTable(1)">CheckID</th>
                            <th scope="col" onclick="sortTable(2)">Latitude</th>
                            <th scope="col" onclick="sortTable(3)">Longitude</th>
                            <th scope="col" onclick="sortTable(4)">TestStatus</th>
                            <th scope="col" onclick="sortTable(5)">Ranking</th>
                            <th scope="col" onclick="sortTable(6)">Equipment</th>
                            <th scope="col" onclick="sortTable(7)">TestDate</th>
                            <th scope="col" onclick="sortTable(8)">RequestDate</th>
                        </tr>
                    </thead>
                    <?php 
                        // Each row from the Sites table is returned in the form of a table
                        while ($row = $sql->fetch_assoc()): ?>
                            <tr id=<?php echo $row['CheckID']; ?>>
                                <!-- Edit button enables government official to address water quality request -->
                                <td><a href="account.php?edit=<?php echo $row['CheckID']; ?>" class="btn btn-info">Edit</a></td>
                                <td><?php echo $row['CheckID']; ?></td>
                                <td><?php echo $row['Latitude']; ?></td>
                                <td><?php echo $row['Longitude']; ?></td>
                                <td><?php echo $row['TestStatus']; ?></td>
                                <td><?php echo $row['Ranking']; ?></td>
                                <td><?php echo $row['Equipment']; ?></td>
                                <td><?php echo $row['TestDate']; ?></td>
                                <td><?php echo $row['RequestDate']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                </table>
                <!-- Print array -->
                <?php
                function pre_r($array) {
                    echo '<pre>';
                    print_r($array);
                    echo '</pre>';
                }
                ?>
            </div>
        </div>
    </div>
    </body>
    <script>

        var redIcon = L.icon({ // red is for test sites not yet tested
            iconUrl: "images/Red_Marker_New.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });

        var orangeIcon = L.icon({ // orange is for pending tests
            iconUrl: "images/Orange_Marker_New.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });

        var greenIcon = L.icon({ // green is for completed tests
            iconUrl: "images/Green_Marker_New.png",
            iconSize: [27, 50],
            iconAnchor: [12, 48],
            popupAnchor: [0, -40],
            });

        // Establish Leaflet map
        let map = L.map('mapid').setView([-27.47, 153.02], 10);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoicy1uYXJsbyIsImEiOiJja2Vod3F3Z3UwZXN6MnJvaHNneWhyNWRoIn0.Bix4XksIzlP276mM3_Bd0g'
        }).addTo(map);

        // The map search functionality (SEB)
        var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider(); // search provider
        L.esri.Geocoding.geosearch({
            providers: [
            arcgisOnline,
            ]
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

        // Getting the table lenght
        function getTableLength(table) {
            var rows = table.rows,
            row_length = rows.length
            return row_length;
        }

        // Adding markers to the map
        function addMarkers() {
            let tableLength = getTableLength(document.getElementById('data-table')); 
            let tableContents = tableToObj(document.getElementById('data-table'));

            for (let i = 0; i < tableLength - 1; i++) {
                var lat = tableContents[i].Latitude; // the longitude
                var long = tableContents[i].Longitude; // the latitude
                var status = tableContents[i].TestStatus; // the test status  
                var checkId = tableContents[i].CheckID;
                var requestDate = tableContents[i].RequestDate;

                if (status == 'Not Tested') {
                    var marker = L.marker([lat, long], {icon: redIcon}).on('click', highlightTableRow).addTo(map);
                    marker.id = checkId;
                    marker.bindPopup("Location ID: " + checkId + "<br>Latitude: " + lat + "<br>Longitude: " + long
                                    + "<br>Request Date: " + requestDate);
                    marker.on('popupclose', unHighlightRow);
                } else if (status == 'In Progress') {
                    var marker = L.marker([lat, long], {icon: orangeIcon}).on('click', highlightTableRow).addTo(map);
                    marker.id = checkId;
                    marker.bindPopup("Location ID: " + checkId + "<br>Latitude: " + lat + "<br>Longitude: " + long
                                    + "<br>Request Date: " + requestDate);
                    marker.on('popupclose', unHighlightRow);
                } else if (status == "Tested") {
                    var marker = L.marker([lat, long], {icon: greenIcon}).on('click', highlightTableRow).addTo(map);
                    marker.id = checkId;
                    marker.bindPopup("Location ID: " + checkId + "<br>Latitude: " + lat + "<br>Longitude: " + long
                                    + "<br>Request Date: " + requestDate);
                    marker.on('popupclose', unHighlightRow);
                }
            }   
        }

        //loads the markers
        addMarkers();
        
        // Highlight and scrolls to row on table where marker corresponds to
        function highlightTableRow(e) {
            tableRow = document.getElementById(e.target.id);
            tableRow.style.backgroundColor = '#3e28d7';
            tableRow.scrollIntoView();
        } 
        
        //Unhighlights the table row
        function unHighlightRow(e) {
            tableRow = document.getElementById(e.target.id);
            tableRow.style.backgroundColor = '#343a40';
        }
        
        // Sort tables alphabetical/ numerical
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("data-table");
            switching = true;
            dir = "asc"; 
            while (switching) {
                        switching = false;
                        rows = table.rows;
                        // Excludes table headers
                        for (i = 1; i < (rows.length - 1); i++) {
                        shouldSwitch = false;
                        //Compares row elements 
                        x = rows[i].getElementsByTagName("TD")[n];
                        y = rows[i + 1].getElementsByTagName("TD")[n];
                        //Check if rows should switch
                        if (Number(x.innerHTML) > Number(y.innerHTML)) {
                            // Mark swtich and break the loop if true:
                            shouldSwitch = true;
                            break;
                        } else if (dir == "asc") {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch= true;
                            break;
                            }
                        } else if (dir == "desc") {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                            }
                        }
                    }
                if (shouldSwitch) {
                        // Make switch and mark switch
                        rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                        switching = true;
                        switchcount ++;      
                    } else {
                        // No switch then set asc to desc an run loop again
                        if (switchcount == 0 && dir == "asc") {
                            dir = "desc";
                            switching = true;
                    }
                }
            }
        }
    </script>

</html>