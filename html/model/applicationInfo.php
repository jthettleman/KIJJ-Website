<?php
session_start();

/** For the Petsitter Application
 *  connecting to the database
 */

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
$email = $_GET['email'];

$id = $mysqli->query("select applicationId from application where sitterEmail = $email");
$status = $mysqli->query("select currentStatus from application where sitterEmail = $email");
echo $id, "<br/>";
?>

