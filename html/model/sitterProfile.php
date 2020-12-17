<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

//$userEmail = $_SESSION['email'];
$userEmail = $_GET['email'];

//$userEmail = "joeshmoe@gmail.com"; //this is just to make sure I know we have the email... THIS IS NOT GOOD TO KEEP THOUGH

$result = $mysqli->query("select firstName from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$first = $info["firstName"];

$result = $mysqli->query("select lastName from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$last = $info["lastName"];

$result = $mysqli->query("select address from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$address = $info["address"];

$result = $mysqli->query("select city from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$city = $info["city"];

$result = $mysqli->query("select state from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$state = $info["state"];

$result = $mysqli->query("select zipCode from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$zip = $info["zipCode"];

$result = $mysqli->query("select lattitude from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$latitude = $info["latitude"];

$result = $mysqli->query("select longitude from petSitter where email = '$userEmail'");
$info = $result->fetch_assoc();
$longitude = $info["longitude"];

$jsonInfo = "[";
$sitterInfo = array("first"=>$first, "last"=>$last, "address"=>$address, "city"=>$city, "state"=>$state, "zip"=>$zip);
$jsonInfo .= json_encode($sitterInfo);
$jsonInfo .= "]";
echo $jsonInfo;

//header("Location: ../view/index.html");
//include("../view/index.html");
?>
