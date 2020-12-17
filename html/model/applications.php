<?php
session_start();

include('constants.php');

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

//We need to use the owners email to create an array of every booking they have from the booking database
//Then we need to use those booking ids and find all applications for all their bookings from the application database


$query = "select bookingId from booking where ownerEmail = '$ownerEmail'";
$result = $mysqli->query($query);

$bookingIdArray = [];

$applications2DArray = [];  
//index 0: booking ID
//index 1: Owner's email
//index 2: Sitter's email
//index 3: Status of app
//index 4: application ID
//index 5: sitter first name
//index 6: sitter last name
//index 7: sitter address
//index 8: sitter city
//index 9: sitter state
//index 10: sitter zipcode
//index 11: start date of sitting
//index 12: end date of sitting


//This loop finds all booking ID's by the pet owner
if($result != FALSE)
{
    while($row = $result->fetch_assoc())
    {
        array_push($bookingIdArray, $row['bookingId']);
    }
}

//This gets all applications for each booking
for($i = 0; $i<count($bookingIdArray); $i++)
{
    $query = "select * from application where bookingId = '$bookingIdArray[$i]'";
    $result = $mysqli->query($query);
    if($result != FALSE)
    {
        while($row = $result->fetch_assoc())
        {
            $tempArray = [];

            $bookingId = $bookingIdArray[$i];
            array_push($tempArray, $bookingId);

            $ownerEmail = $_SESSION['email']; //already have it but just for clarification
            array_push($tempArray, $ownerEmail);

            $sitterEmail = $row['sitterEmail'];
            array_push($tempArray, $sitterEmail);

            $status = $row['currentStatus'];
            array_push($tempArray, $status);

            $applicationId = $row['applicationId'];
            array_push($tempArray, $applicationId);

            array_push($applications2DArray, $tempArray); //adding all application info to this 2D array for storage
        }
    }
}

//This gets all sitter information for each application they have made and puts it in the big 2D array
for($i = 0; $i<count($applications2DArray); $i++)
{
    $sitterEmail = $applications2DArray[$i][2];
    $query = "select * from petSitter where email = '$sitterEmail'";
    $result = $mysqli->query($query);
    while($row = $result->fetch_assoc())
    {
        array_push($applications2DArray[$i], $row['firstName']);
        array_push($applications2DArray[$i], $row['lastName']);
        array_push($applications2DArray[$i], $row['address']);
        array_push($applications2DArray[$i], $row['city']);
        array_push($applications2DArray[$i], $row['state']);
        array_push($applications2DArray[$i], $row['zipCode']);
    }
}

//This gets start and end dates for each booking
for($i = 0; $i<count($applications2DArray); $i++)
{
    $bookingId = $applications2DArray[$i][0];
    $query = "select * from booking where bookingId = '$bookingId'";
    $result = $mysqli->query($query);
    $row = $result->fetch_assoc();

    array_push($applications2DArray[$i], $row['startDate']);
    array_push($applications2DArray[$i], $row['endDate']);
}

//retrieving information from the database
/*
$result = $mysqli->query("select from application where ownerEmail = '$userEmail'");

if($result != FALSE)
{
    $info = $result->fetch_assoc();
    $bookingID = $info["bookingId"];  

    $result = $mysqli->query("select from booking where bookingId = '$bookingID'");
    $info = $result->fetch_assoc();
    $sitterEmail = $info["sitterEmail"];

    $result = $mysqli->query("select from booking where bookingId = '$bookingID'");
    $info = $result->fetch_assoc();
    $startDate = $info["startDate"];

    $result = $mysqli->query("select from booking where bookingId = '$bookingID'");
    $info = $result->fetch_assoc();
    $endDate = $info["endDate"];

    $result = $mysqli->query("select from petSitter where email = '$sitterEmail'");
    $info = $result->fetch_assoc();
    $first = $info["firstName"];

    $result = $mysqli->query("select from petSitter where email = '$sitterEmail'");
    $info = $result->fetch_assoc();
    $last = $info["lastName"];
}
*/


include("../view/applications.html");
?>