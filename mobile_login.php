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

//$json = '{"username":1, "pw":2}';
//$data = json_decode($json, true);

$json = file_get_contents('php://input');
$data = json_decode($json, true);
//$data = htmlspecialchars($_GET['data']);

$username = $data["username"];
$pw = $data["pw"];




$query = "SELECT * FROM db30906.UserInfo WHERE username = '$username' AND pw = '$pw'";

$stmt = $con->prepare($query);	
$stmt->execute();
$stmt->bind_result($field1, $field2);
$stmt->fetch();

if(($username == $field1) && ($pw == $field2) ){
	echo($username);
}else{
	echo("login failed");
}

//echo($field1);
//echo($field2);

//printf("%s\n", $field1);


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
