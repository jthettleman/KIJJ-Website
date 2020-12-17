<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

//connecting to the database
$mysqli = new mysqli($host, $username, $password, $database);

$userEmail = $_SESSION['email'];

//$userEmail = "jj@yahoo.com"; //this is just to make sure I know we have the email... THIS IS NOT GOOD TO KEEP THOUGH

//displaying the user's information onto their homepage
$result = $mysqli->query("select firstName from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$first = $info["firstName"];

$result = $mysqli->query("select lastName from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$last = $info["lastName"];

$result = $mysqli->query("select petName from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$petName = $info["petName"];

$result = $mysqli->query("select petType from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$petType = $info["petType"];

$result = $mysqli->query("select petBreed from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$petBreed = $info["petBreed"];

$result = $mysqli->query("select address from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$address = $info["address"];

$result = $mysqli->query("select city from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$city = $info["city"];

$result = $mysqli->query("select state from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$state = $info["state"];

$result = $mysqli->query("select zipCode from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$zip = $info["zipCode"];

$result = $mysqli->query("select latitude from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$latitude = $info["latitude"];

$result = $mysqli->query("select longitude from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$longitude = $info["longitude"];

$result = $mysqli->query("select description from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$description = $info["description"];

$result = $mysqli->query("select membershipStatus from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$memberStatus = $info["membershipStatus"];

$_SESSION['first'] = $first;

$dateInfo = $mysqli->query("select startDate, endDate, currentStatus from booking where ownerEmail = '$userEmail'");

include("../view/index.html");

?>
