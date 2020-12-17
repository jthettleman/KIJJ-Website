<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

$userEmail = $_SESSION['email'];

//$email = "jj@yahoo.com"; //this is just to make sure I know we have the email... THIS IS NOT GOOD TO KEEP THOUGH

$result = $mysqli->query("select firstName from petOwner where email = '$userEmail'");
$info = $result->fetch_assoc();
$first = $info["firstName"];


$last = $mysqli->query("select lastName from petOwner where email = '$userEmail'");
$petName = $mysqli->query("select petName from petOwner where email = '$userEmail'");
$petType = $mysqli->query("select petType from petOwner where email = '$userEmail'");
$petBreed = $mysqli->query("select petBreed from petOwner where email = '$userEmail'");
$address = $mysqli->query("select address from petOwner where email = '$userEmail'");
$city = $mysqli->query("select city from petOwner where email = '$userEmail'");
$state = $mysqli->query("select state from petOwner where email = '$userEmail'");
$zip = $mysqli->query("select zipCode from petOwner where email = '$userEmail'");
$latitude = $mysqli->query("select latitude from petOwner where email = '$userEmail'");
$longitude = $mysqli->query("select longitude from petOwner where email = '$userEmail'");
$description = $mysqli->query("select description from petOwner where email = '$userEmail'");

$_SESSION['first'] = $first;

//header("Location: ../view/index.html");
include("../view/index.html");
?>
