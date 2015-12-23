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

$username = htmlspecialchars($_GET['username']);
$password = htmlspecialchars($_GET['password']);

//$username = 'test';
//$password = '1234';

//$con->close();

$ins = $con->prepare("INSERT INTO UserInfo VALUES('$username', '$password');");

$ins->execute();

$query = "SELECT * FROM db30906.UserInfo WHERE username = '$username' AND pw = '$password'";
$stmt = $con->prepare($query);	
$stmt->execute();
$stmt->bind_result($field1, $field2);
$stmt->fetch();
printf("%s, %s", $field1, $field2);


//if ($stmt = $con->prepare($query)) {
  //  $stmt->execute();
   // $stmt->bind_result($field1, $field2);
   // while ($stmt->fetch()) {
     //   if($field1 = $username and $field2 = $password) {
//		printf("%s, %s\n", $field1, $field2);
  //  }
   // $stmt->close();
//}



?>
