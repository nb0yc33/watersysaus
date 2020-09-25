<?php include('connection.php') ?>

<?php
$LON =  $_GET['lon'];
$LAT =  $_GET['lat'];
$COMMENT =  $_GET['comment'];

// Create connection
$conn = mysqli_connect("localhost", "gents", "truegents1", "water_quality");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Latitude, Longitude FROM Sites";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "CheckID: " . $row["CheckID"]. " - Latitude: " . $row["Latitude"]. " " . $row["Longitude"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

?>



