<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

//connecting to the database
$mysqli = new mysqli($host, $username, $password, $database);

$email = $_SESSION['email'];
$sitterEmail = mysqli_real_escape_string($mysqli,$_POST['sitterEmail']);
$bookingId = mysqli_real_escape_string($mysqli,$_POST['booking']);

//updating the database
$query = "update application set currentStatus = 'denied' where sitterEmail = '$sitterEmail' and bookingId = '$bookingId'";
$mysqli->query($query);
?>