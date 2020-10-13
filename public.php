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
                <input class="form-control" type="text" placeholder="Search location" id="search">
                <h5> Search Radius </h5>
                <div class="container">
                    <div class="box">
                        <div id="value"></div>
                    </div>
                    <input type="range" min="0" max="100" value="50"
                    class="slider" id="slider">
                </div>
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
                <form>
                    <input type = "button" onclick = "getLocation();" value = "Get Your Location"/>
                </form>
            </div>
        </div>
        <div class="map" id="map_id">
    </div>

    </body>
    <script>

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
   
        //Search functionality (Seb)
        var arcgisOnline = L.esri.Geocoding.arcgisOnlineProvider(); // search provider
        L.esri.Geocoding.geosearch({
        providers: arcgisOnline,
        }).addTo(map);

        // Updates the map to show the users current location. 
        function showLocation(position) {
            let lat = position.coords.latitude;
            let long = position.coords.longitude;
            
            map.setView([lat, long], 13);
        }

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
            marker.bindPopup("You've flagged this location").openPopup();
        }
        map.on('click', onMapClick);

    </script>
    <script type="text/javascript">
        var slider=document.getElementById("slider");
        var val=document.getElementById("value");

        val.innerHTML=slider.value;
        slider.oninput=function(){
            val.innerHTML=this.value;
        }

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

