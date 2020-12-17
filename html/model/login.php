<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

//connecting to the database
$mysqli = new mysqli($host, $username, $password, $database);

$email =   mysqli_real_escape_string($mysqli,$_POST['email']);
$pass =   mysqli_real_escape_string($mysqli,$_POST['password']);

//encrypting the password to match what is saved in the database
$encryptedPassword = password_hash($pass, PASSWORD_BCRYPT);

$query = "select encryptedPassword from petOwner where email = '$email'";

$info = $mysqli->query($query);

$result = $info->fetch_assoc();

$check = password_verify( $pass, $result['encryptedPassword']);

//checking the email and password to see if it matches
if($check == 0)
{
  header("Location: ../view/invalidInfo.html");  //wrong information was entered
}
else
{ 
  $_SESSION['email'] = $email;
  header("Location: ../model/homepage.php");  //the correct info was entered
}

?>