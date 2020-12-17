<?php

include("constants.php");

$username = Constants::USERNAME;
$host = Constants::HOST;
$database = Constants::DATABASE;
$password = Constants::PASSWORD;

$mysqli = new mysqli($host, $username, $password, $database);

$userEmail = $_GET['email'];
$bookingsArray = array();

$bookingResult = $mysqli->query("select bookingId from booking where sitterEmail = '$userEmail'");
while($row = $bookingResult->fetch_assoc()){
        $id = $row['bookingId'];

	$result = $mysqli->query("select ownerEmail from booking where sitterEmail = '$userEmail' and bookingId = '$id'");
	$info = $result->fetch_assoc();
	$ownerEmail = $info["ownerEmail"];

	$result = $mysqli->query("select currentStatus from booking where sitterEmail = '$userEmail'and bookingId = '$id'");
	$info = $result->fetch_assoc();
	$status = $info["currentStatus"];

	$result = $mysqli->query("select startDate from booking where sitterEmail = '$userEmail'and bookingId = '$id'");
	$info = $result->fetch_assoc();
	$startDate = $info["startDate"];

	$result = $mysqli->query("select endDate from booking where sitterEmail = '$userEmail'and bookingId = '$id'");
	$info = $result->fetch_assoc();
	$endDate = $info["endDate"];

	$result = $mysqli->query("select firstName from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$first = $info["firstName"];

 	$result = $mysqli->query("select rating from petOwner where email = '$ownerEmail'");
        $info = $result->fetch_assoc();
        $rating = $info["rating"];
 
	$result = $mysqli->query("select lastName from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$last = $info["lastName"];

	$result = $mysqli->query("select petName from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$petName = $info["petName"];

	$result = $mysqli->query("select petType from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$petType = $info["petType"];

	$result = $mysqli->query("select petBreed from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$petBreed = $info["petBreed"];


	$result = $mysqli->query("select address from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$address = $info["address"];

	$result = $mysqli->query("select city from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$city = $info["city"];

	$result = $mysqli->query("select state from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$state = $info["state"];

	$result = $mysqli->query("select zipCode from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$zip = $info["zipCode"];

	$result = $mysqli->query("select latitude from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$latitude = $info["latitude"];

	$result = $mysqli->query("select longitude from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$longitude = $info["longitude"];

	$result = $mysqli->query("select description from petOwner where email = '$ownerEmail'");
	$info = $result->fetch_assoc();
	$description = $info["description"];

	//$jsonInfo = "[";
	$ownerInfo = array("rating"=>$rating,"first"=>$first, "last"=>$last, "petName"=>$petName, "type"=>$petType, "breed"=>$petBreed, "address"=>$address, "city"=>$city, "state"=>$state, "zip"=>$zip, "lat"=>$latitude, "long"=>$longitude, "desc"=>$description);
	$owneInfo = json_encode($ownerInfo);
	$bookingInfo = array("id"=>$id,"ownerEmail"=>$ownerEmail, "status"=>$status, "start"=>$startDate, "end"=>$endDate);
	$bookingInfo = json_encode($bookingInfo);
	$bothInfo = array("booking"=>$bookingInfo, "owner"=>$ownerInfo);
	$jsonInfo = json_encode($bothInfo);
	//$jsonInfo .= $owneInfo;
	//$jsonInfo .= "]";
//	$bookingsArray .= $jsonInfo;
	array_push($bookingsArray, $jsonInfo);
}
$bookingsArray = json_encode($bookingsArray);
//$bookingsArray .= "]";
echo $bookingsArray;

?>
