<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;
$apitoken = Constants::APITOKEN;

$mysqli = new mysqli($host, $username, $password, $database);

//retrieving the input from the user
$email =   mysqli_real_escape_string($mysqli,$_POST['email']);
$first =   mysqli_real_escape_string($mysqli,$_POST['first']);
$last =   mysqli_real_escape_string($mysqli,$_POST['last']);
$address =   mysqli_real_escape_string($mysqli,$_POST['address']);
$city = mysqli_real_escape_string($mysqli,$_POST['city']);
$state = mysqli_real_escape_string($mysqli,$_POST['state']);
$zipcode =   mysqli_real_escape_string($mysqli,$_POST['zipcode']);
$pass =   mysqli_real_escape_string($mysqli,$_POST['password']);

$petname = "Edit your profile to add this in :)";
$pettype = "Edit your profile to add this in :)";
$petbreed = "Edit your profile to add this in :)";
$description = "Edit your profile to add this in :)";

//using the address to get the longitude and latitude
$url = "https://us1.locationiq.com/v1/search.php?key=".$apitoken."&q=".$address." ".$city." ".$state." ".$zipcode."&format=json";
$contents = file_get_contents($url);

$locInfo = json_decode($contents, true);

$lat = $locInfo['0']['lat'];
$long = $locInfo['0']['lon'];

//encrypting the user's password
$encryptedPassword = password_hash($pass, PASSWORD_BCRYPT);

//sending the information gathered into the database
$query = "insert into petOwner (email, encryptedPassword, firstName, lastName, petName, petType, petBreed, address, city, state, zipCode, latitude, longitude, description) values ('$email', '$encryptedPassword', '$first', '$last', '$petname', '$pettype', '$petbreed', '$address', '$city', '$state', '$zipcode', '$lat', '$long', '$description')";

$row = $mysqli->query($query);

header("Location: ../view/accountCreated.html")

?>