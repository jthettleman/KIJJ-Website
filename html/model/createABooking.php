<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) 
{
  die("Connection failed: " . $mysqli->connect_error);
}
else 
{
  //echo "Connected successfully";
}

//getting the user's email
$ownerEmail = $_SESSION['email'];

//retrieving the rest of the form
$status = "open";
$startDate  =  mysqli_real_escape_string($mysqli,$_POST['SDate']);
$endDate =  mysqli_real_escape_string($mysqli,$_POST['EDate']);

//inserting into the database
$query = "insert into booking (ownerEmail, currentStatus, startDate, endDate) values ('$ownerEmail', '$status', '$startDate', '$endDate')";
$row = $mysqli->query($query); 

include("../model/bookingCreated.php");
?>