<?php
ini_set('display_errors',1); 
error_reporting(E_ALL);

$host="10.25.71.66";
$port=3306;
$socket="";
$user="u30906";
$password="Ym84BypjLH";
$dbname="db30906";

$con = new mysqli($host, $user, $password, $dbname, $port)
	or die ('Could not connect to the database server' . mysqli_connect_error());


$json = file_get_contents('php://input');
$data = json_decode($json, true);


$restname = $data["restname"];





$query = "SELECT * FROM db30906.Restaurant WHERE restaurantName = '$restname'";

$stmt = $con->prepare($query);	
$stmt->execute();
$stmt->bind_result($field1,$field2);
$stmt->fetch();


$username = $field1;

$query = "SELECT * FROM db30906.Menu WHERE username = '$username'";

$stmt = $con->prepare($query);	
$stmt->execute();
$stmt->bind_result($field1,$field2);
$index = 0;
$menus = array();
while($stmt->fetch()){
	$menus[$index] =  $field2;
	$index++;
	}
$json = json_encode($menus);
echo $json;
?>
