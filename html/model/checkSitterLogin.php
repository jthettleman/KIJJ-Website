<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

$userEmail = $_GET['email'];
$pass =   $_GET['password'];

$encryptedPassword = password_hash($pass, PASSWORD_BCRYPT);

$query = "select encryptedPassword from petSitter where email = '$userEmail'";

$info = $mysqli->query($query);

$result = $info->fetch_assoc();

$check = password_verify( $pass, $result['encryptedPassword']);

$result = $mysqli->query("select email from petSitter where email = '$userEmail'");
if($result->num_rows == 0) {
	//if row not found
	echo "false";
}
else if(!$check)
{
	echo "false";
}
else{
	echo "true";
}
?>
