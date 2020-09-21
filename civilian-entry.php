<?php include('connection.php')
/*
TODO: chck if you can run flag on clicks only on water surfaces.
*/
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Treatment Australia</title>
    <link rel="stylesheet" href="css/civilian-page.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
            integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
            crossorigin=""></script>
</head>

<nav class="nav-bar">
    <div class="logo">
    </div>
    <div class="Menu">
        <nav>Login</nav>
        <nav>Add</nav>
    </div>
</nav>

<body>

<div class="log-in-form">
</div>

<div class="Vision">

</div>
<div class="control">
    <div class="controls">
        <button class="control-button"><img class="plus" src="plus.png" alt=""></button>
        <button class="control-button"><img class="search" src="search.png" alt=""></button>
        <button class="control-button"><img class="alert" src="alert.png" alt=""></button>
    </div>
    <div class="map" id="mapid"></div>

    <p> Flag Location </p>
    <form action="/add-civilian-entry.php" method="get">
        <div class="log-in-id">
            <p>Latitude</p>
            <input type="text" name="lat" id="lat">
        </div>

        <div class="log-in-password">
            <p>Longtitude</p>
            <input type="text" name="lon" id="lon">
        </div><br>

        <p>Please tell us what's wrong (optional)</p>
        <textarea class="log-in-password" name="comment" id="comment" rows="3" cols="50"></textarea><br>

        <button type="submit" class="btn btn-info" name="login">Submit</button>
    </form><br><br>

</div>

<section>
    <div class="wave wave1"></div>
    <div class="wave wave2" ></div>
    <div class="wave wave3"></div>
    <div class="wave wave4"></div>

</section>




</body>


<script>
    function onMapClick(e) {
        var lat  = e.latlng.lat.toFixed(5);
        var lon  = e.latlng.lng.toFixed(5);
        var gps = "";
        if (lat>0) gps+='N'; else gps+='S';
        if (10>Math.abs(lat))  gps += "0";
        gps += Math.abs(lat).toFixed(5)+" ";
        if (lon>0) gps+='E'; else gps+='W';
        if (10>Math.abs(lon))  gps += "0";
        if (100>Math.abs(lon)) gps += "0";
        gps += Math.abs(lon).toFixed(5);
        var textArea = document.createElement("textarea");
        textArea.style.position = 'fixed';
        textArea.style.top = 0;
        textArea.style.left = 0;
        textArea.style.width = '2em';
        textArea.style.height = '2em';
        textArea.style.padding = 0;
        textArea.style.border = 'none';
        textArea.style.outline = 'none';
        textArea.style.boxShadow = 'none';
        textArea.style.background = 'transparent';
        textArea.value = gps;
        document.body.appendChild(textArea);
        textArea.select();
        try {
            var successful = document.execCommand('copy');
            var msg = successful ? 'Successfully' : 'Unsuccessfully';
            console.log(msg + ' retrieved ' + gps + ' geographical  information. ');
        } catch (err) {
            console.log('Error retrieving geographical information.');
        }
        document.getElementById("lat").value = lat;
        document.getElementById("lon").value = lon;
        document.body.removeChild(textArea);
    }

    let mymap = L.map('mapid').setView([-27.47, 153.02], 14);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1Ijoicy1uYXJsbyIsImEiOiJja2Vod3F3Z3UwZXN6MnJvaHNneWhyNWRoIn0.Bix4XksIzlP276mM3_Bd0g'
    }).addTo(mymap);

    mymap.on('click', onMapClick);


</script>
</html>


