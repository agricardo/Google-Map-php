<?php
if(isset($_POST['submit'])){
    $con = new mysqli('localhost','root','','education');

    $name = $con->real_escape_string($_POST['name']);
    $address = $con->real_escape_string($_POST['address']);
    $lat = $con->real_escape_string($_POST['lat']);
    $lng = $con->real_escape_string($_POST['lng']);
    $type = $con->real_escape_string($_POST['type']);


    
    $con->query("INSERT INTO colleges (name,address,lat,lng,type) VALUES ('$name', '$address', '$lat', '$lng', '$type')");

        
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Access Google Maps API in PHP</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/googlemap.js"></script>
	<style type="text/css">
		.container {
			height: 450px;
		}
		#map {
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<center><h1>Google Maps Locations</h1></center>
		<center><form method="POST" action="index.php">
    		<input name="name" placeholder="Place name"><br>
    		<input name="address" placeholder="address"><br>
    		<input name="lat" placeholder="lat"><br>
    		<input name="lng" placeholder="lng"><br>
    		<input name="type" placeholder="type"><br>
    		<input name="submit" type="submit" value="Register"><br>
		</form></center>

		<?php 
			require 'education.php';
			$edu = new education;
			$coll = $edu->getCollegesBlankLatLng();
			$coll = json_encode($coll, true);
			echo '<div id="data">' . $coll . '</div>';

			$allData = $edu->getAllColleges();
			$allData = json_encode($allData, true);
			echo '<div id="allData">' . $allData . '</div>';			
		 ?>
		<div id="map"></div>
	</div>
</body>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAHY-vxfiqnnyXBR-PD2odY0IkKuXIrhw8&callback=loadMap">
</script>
</html>