<?php
$mysqli = new mysqli("localhost", "amplivatest", "amplivatest", "ampliva");

//Tables = Users, Reports
//Users = userID, name, barangay, contactNum, password
//Reports = reportID, userID, barangay, date and time, contactNum
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}else{
    //echo("Connection Established");
}
?>