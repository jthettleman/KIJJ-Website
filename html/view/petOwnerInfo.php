<?php
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
//$userEmail = "jj@yahoo.com";

$first = $mysqli->query("select firstName from petOwner where email = $userEmail");
$last = $mysqli->query("select lastName from petOwner where email = $userEmail");
$petName = $mysqli->query("select petName from petOwner where email = $userEmail");
$petType = $mysqli->query("select petType from petOwner where email = $userEmail");
$petBreed = $mysqli->query("select petBreed from petOwner where email = $userEmail");
$address = $mysqli->query("select address from petOwner where email = $userEmail");
$city = $mysqli->query("select city from petOwner where email = $userEmail");
$state = $mysqli->query("select state from petOwner where email = $userEmail");
$zip = $mysqli->query("select zipCode from petOwner where email = $userEmail");
$lattitude = $mysqli->query("select lattitude from petOwner where email = $userEmail");
$longitude = $mysqli->query("select longitude from petOwner where email = $userEmail");
echo $first, "<br/>";
?>

