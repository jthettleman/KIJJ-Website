<?php
session_start();

include("constants.php");

//PHP script for Pet Owner approving an application

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

//connecting to database
$mysqli = new mysqli($host, $username, $password, $database);

$email = $_SESSION['email'];
$sitterEmail = mysqli_real_escape_string($mysqli,$_POST['sitterEmail']);
$bookingId = mysqli_real_escape_string($mysqli,$_POST['booking']);

//updating the database to make the application closed
$query = "update booking set currentStatus = 'closed', sitterEmail= '$sitterEmail' where sitterEmail = '$sitterEmail' and ownerEmail = '$email'";
$mysqli->query($query);

$query = "update application set currentStatus = 'closed' where sitterEmail = '$sitterEmail' and bookingId = '$bookingId'";
$mysqli->query($query);
?>