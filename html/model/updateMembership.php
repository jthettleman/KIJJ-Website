<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

$userEmail = $_SESSION['email'];

//set the member status date to a year later
$date = strtotime("+12 Months");
$memberStatus = date("Y/m/d", $date);

$query = "UPDATE petOwner set membershipStatus='$memberStatus' WHERE email='$userEmail'";
$row = $mysqli->query($query); 

include("../model/membershipRenewed.php");
?>