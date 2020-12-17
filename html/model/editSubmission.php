<?php
session_start();

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;
$apitoken = Constants::APITOKEN;

$mysqli = new mysqli($host, $username, $password, $database);

$first = mysqli_real_escape_string($mysqli,$_POST['first']);
$last = mysqli_real_escape_string($mysqli,$_POST['last']);
$address = mysqli_real_escape_string($mysqli,$_POST['address']);
$city = mysqli_real_escape_string($mysqli,$_POST['city']);
$state = mysqli_real_escape_string($mysqli,$_POST['state']);
$zipcode = mysqli_real_escape_string($mysqli,$_POST['zipcode']);

$petname = mysqli_real_escape_string($mysqli,$_POST['petName']);
$pettype = mysqli_real_escape_string($mysqli,$_POST['petType']);
$petbreed = mysqli_real_escape_string($mysqli,$_POST['petBreed']);
$description = mysqli_real_escape_string($mysqli,$_POST['description']);

$email = $_SESSION['email'];

$query="select address from petOwner where email='$email'";
$row = $mysqli->query($query);
$info = $row->fetch_assoc();
$oldAddress = $info["address"];

echo $address;
echo $oldAddress;

if(strcmp($oldAddress, $address) != 0)
{
    echo "in if";

    $url = "https://us1.locationiq.com/v1/search.php?key=".$apitoken."&q=".$address." ".$city." ".$state." ".$zipcode."&format=json";

    echo $url;

    $contents = file_get_contents($url);

    $locInfo = json_decode($contents, true);

    $lat = $locInfo['0']['lat'];
    $long = $locInfo['0']['lon'];

    echo $lat;
    echo $long;

    $query="update petOwner set latitude='$lat', longitude='$long' where email='$email'";
    $row = $mysqli->query($query);
}

$query="update petOwner set firstName='$first', lastName='$last', address='$address', city='$city', state='$state', zipCode='$zipcode', petName='$petname', petType='$pettype', petBreed='$petbreed', description='$description' where email='$email'";
$row = $mysqli->query($query);


header("Location: ../model/homepage.php");
?>
