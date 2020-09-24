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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

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
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z"/>
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                </svg>
                <input type="text" name="search" id="search">
            </div>
        </div>
        <br>
        <div class="map" id="mapid"></div>
        <table class="table table-condensed table-dark">
            <tr>
                <th scope="col">Latitude</th>
				<th scope="col">Longitude</th>
				<th scope="col">Ranking</th>
				<th scope="col">Equipment</th>
				<th scope="col">RecentTest</th>
				<th scope="col">LastTest</th>
				<th scope="col">Request</th>
				<th scope="col">RequestDate</th>
            </tr>
            <?php
                $conn = mysqli_connect("localhost", "gents", "truegents1", "water_quality");
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }
                $sql = "SELECT Latitude, Longitude, Ranking, Equipment, RecentTest, LastTest, Request, RequestDate FROM Sites";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $row["Latitude"]. "</td>
                                <td>" . $row["Longitude"] . "</td>
                                <td>". $row["Ranking"]. "</td>
                                <td>". $row["Equipment"]. "</td>
                                <td>". $row["RecentTest"]. "</td>
                                <td>". $row["LastTest"]. "</td>
                                <td>". $row["Request"]. "</td>
                                <td>". $row["RequestDate"]. "</td>
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