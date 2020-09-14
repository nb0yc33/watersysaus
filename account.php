<?php 
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Government Account</title>
    <link rel="stylesheet" href="css/gov.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin="" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
        integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
        crossorigin=""></script>

		<?php include("header.php"); ?>
</head>

<body>

	<div class="analytics-container">
        <div class="dashboard-header">
            <div class="user">
		        <?php  if (isset($_SESSION['username'])) : ?>
			        <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
			        <p> <a href="account.php?logout='1'" style="color: red;">Logout</a> </p>
                <?php endif ?>
            </div>
            <div class="search-box">
                <a href="#"><img class="search-img" src="images/search.png" alt=""></a>
                <input type="text" name="search" id="search">
            </div>
        </div>
        <br>
        <div class="map" id="mapid"></div>
        <div class="table">
            <tr class="headings row">
				<th id="heading">Latitude</th>
				<th id="heading">Longitude</th>
				<th id="heading">Ranking</th>
				<th id="heading">Equipment</th>
				<th id="heading">RecentTest</th>
				<th id="heading">LastTest</th>
				<th id="heading">Request</th>
				<th id="heading">RequestDate</th>
			    <th id="heading">WaterType</th>
			</tr>
        </div>
	</div>
	
	<div class="waves">
    	<img class="waves-bottom" src="images/waves.png" alt="Waves graphic">
    </div>

    <script>
        let mymap = L.map('mapid').setView([-27.47, 153.02], 14);
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1Ijoicy1uYXJsbyIsImEiOiJja2Vod3F3Z3UwZXN6MnJvaHNneWhyNWRoIn0.Bix4XksIzlP276mM3_Bd0g'
        }).addTo(mymap);

        // Adding data to the table 

        let data = [];

        function Location(date, latitude, longitude, description) {
            this.data = date;
            this.latitude = latitude;
            this.longitude = longitude;
            this.description = description;
        }



        function render() {

        }
		
	</script>
	
    <script type="text/javascript">

        // ripple effect for buttons
        const buttons = document.querySelectorAll('a.menu_button');
        buttons.forEach(btn => {
            btn.addEventListener('click', function (e) {
                let x = e.clientX - e.target.offsetLeft;
                let y = e.clientY - e.target.offsetTop;

                let ripples = document.createElement('span');
                ripples.style.left = x + "px";
                ripples.style.top = y + "px";
                this.appendChild(ripples);

                setTimeout(() => {
                    ripples.remove()
                }, 1000);
            })
        })
	</script> 

</body>

</html>