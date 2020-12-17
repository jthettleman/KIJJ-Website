<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);


// Check connection
if (!$mysqli) {
	die("Connection failed: " . mysqli_connect_error());
}
else{
	echo "good";
}
$userEmail = $_GET['email'];
echo $userEmail;
$result = $mysqli->query("select firstName from petOwner where email = $userEmail");
echo "first name: ";
$info = $result->fetch_assoc();
echo "first name: ";
$first= $info["firstName"];
echo "first name: ";
echo $first;
$last = $mysqli->query("select lastName from petOwner where email = $userEmail");
$petName = $mysqli->query("select petName from petOwner where email = $userEmail");
$petType = $mysqli->query("select petType from petOwner where email = $userEmail");
$petBreed = $mysqli->query("select petBreed from petOwner where email = $userEmail");
$address = $mysqli->query("select address from petOwner where email = $userEmail");
$city = $mysqli->query("select city from petOwner where email = $userEmail");
$state = $mysqli->query("select state from petOwner where email = $userEmail");
$zip = $mysqli->query("select zipCode from petOwner where email = $userEmail");
echo $zip;
$lattitude = $mysqli->query("select lattitude from petOwner where email = $userEmail");
$longitude = $mysqli->query("select longitude from petOwner where email = $userEmail");
echo $first, "<br/>";
?>

