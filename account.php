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
    <div class="grid-container">
        <div class="sidebar">
            <div class="button-box">
                <a href="index.php">
                    <img src="images/logo.png" id="logo" alt="Water Systems Australia Logo">
                </a>
                <div class="messages">
                <?php include('errors.php'); ?>
                    <?php  if (isset($_SESSION['username'])) : ?>
			            <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>&nbsp;
			            <p><a href="account.php?logout='1'" style="color: red;">Logout</a></p>
                    <?php endif ?>
                </div>        
                <input class="form-control" type="text" placeholder="Search location" id="search-gov">                                  
            </div>
        </div>
        <div class="main">
            <div class="map-2" id="mapid"></div>
            <div class="water-table">
                <table class="table table-condensed table-dark" id = "data-table">
                    <tr>
                        <th scope="col">Actions</th>
                        <th scope="col">CheckID</th>
                        <th scope="col">Latitude</th>
                        <th scope="col">Longitude</th>
                        <th scope="col">TestStatus</th>
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
                        $sql = "SELECT CheckID, Latitude, Longitude, TestStatus, Ranking, Equipment, RecentTest, LastTest, Request, RequestDate FROM Sites";
                        $result = $conn->query($sql);
                    
                        if ($result->num_rows > 0) {
                        // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<tr class='table-row'>  
                                        <td id= 'button-container'><button id='action-button'>Actions</button></td>
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
        </div>
        <div>
        </div>
    </div>
    </body>
    <script src="leafletcode.js"></script>
</html>