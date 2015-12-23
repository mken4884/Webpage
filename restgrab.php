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




$query = "SELECT * FROM db30906.Restaurant";

$stmt = $con->prepare($query);	
$stmt->execute();
$stmt->bind_result($field1,$field2);
$rests = array();
while($stmt->fetch()){
	$rests[$index] =  $field1;
	$index++;
	$rests[$index] = $field2;
	$index++;
	}
$json = json_encode($rests);
echo $json;
?>
