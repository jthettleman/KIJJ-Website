<?php
//session_start();
//not checking for repeat username.... what happens on error?
include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;
$apitoken = Constants::APITOKEN;

$mysqli = new mysqli($host, $username, $password, $database);

$bookingId = $_GET['bookingId'];
$sitterEmail = $_GET['sitterEmail'];
$status = "open";

$query = "insert into application (sitterEmail, currentStatus, bookingId) values ('$sitterEmail', '$status', '$bookingId')";


$row = $mysqli->query($query);

if(!$row){
	echo "ERROR";
}

?>
