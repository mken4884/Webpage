<?php
print("TEST");

$host="mysql.cs.iastate.edu";
$port=3306;
$socket="";
$user="u30906";
$password="Ym84BypjLH";
$dbname="db30906";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket) or die ('Could not connect to the database server' . mysqli_connect_error());

$result = mysqli_query($con,"SELECT * FROM db30906.UserInfo");
$row = mysqli_fetch_array($result);
$data = $row[0];
print($data);
print($result);
if($data){
echo $data;
}
mysqli_close($con);
?>
