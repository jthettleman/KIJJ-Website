<?php
session_start();

$servername = "cs-database.loyola.edu";
$username = "klmatrangola";
$teamname = "kijj";
$password = "Cleo123!";

// Create connection
$mysqli = new mysqli( $servername, $username, $password, $teamname);

// Check connection
if (!$mysqli) {
  die("Connection failed: " . mysqli_connect_error());
}
$userEmail = $_GET['email'];

$first = $mysqli->query("select firstName from petSitter where email = $userEmail");
$last = $mysqli->query("select lastName from petSitter where email = $userEmail");
$address = $mysqli->query("select address from petSitter where email = $userEmail");
$city = $mysqli->query("select city from petSitter where email = $userEmail");
$state = $mysqli->query("select state from petSitter where email = $userEmail");
$zip = $mysqli->query("select zipCode from petSitter where email = $userEmail");
$lattitude = $mysqli->query("select lattitude from petSitter where email = $userEmail");
$longitude = $mysqli->query("select longitude from petSitter where email = $userEmail");
echo $first, "<br/>";
?>

