<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

$email = $_SESSION['email'];
$startDate = mysqli_real_escape_string($mysqli,$_POST['date']);
$query = "delete from booking where ownerEmail = '$email' and startDate = '$startDate'";
$mysqli->query($query);

?>