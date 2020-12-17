<?php
session_start();
//not checking for repeat username.... what happens on error?
include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;
$apitoken = Constants::APITOKEN;

$mysqli = new mysqli($host, $username, $password, $database);

$first = $_GET['first'];
$last = $_GET['last'];
$address = $_GET['address'];
$city = $_GET['city'];
$state = $_GET['state'];
$zipcode = $_GET['zip'];
$email = $_GET['email'];
$pass= $_GET['pass'];
$points = 0;

$url = "https://us1.locationiq.com/v1/search.php?key=".$apitoken."&q=".$address." ".$city." ".$state." ".$zipcode."&format=json";
$contents = file_get_contents($url);
$locInfo = json_decode($contents, true);

$lat = $locInfo['0']['lat'];
$long = $locInfo['0']['lon'];

$encryptedPassword = password_hash($pass, PASSWORD_BCRYPT);

$query = "insert into petSitter (email, encryptedPassword, firstName, lastName, address, city, state, zipCode, latitude, longitude, points) values ('$email', '$encryptedPassword', '$first', '$last', '$address', '$city', '$state', '$zipcode', '$lat', '$long', '$points')";


$row = $mysqli->query($query);

if(!$row){
	echo "ERROR";
}

$jsonInfo = "[";
$locInfo=array("lat"=>$lat, "long"=>$long);
$jsonInfo .= json_encode($locInfo);
$jsonInfo .= "]";
echo $jsonInfo;
?>
