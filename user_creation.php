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




$query = "SELECT * FROM db30906.UserInfo WHERE username = '$username'";

$stmt = $con->prepare($query);	
$stmt->execute();
$stmt->bind_result($field1, $field2);
$stmt->fetch();

$create_flag = 0; //0 = account taken: 1 = account not taken


if($field1 == ""){
	
	$create_flag = 1;
	
}else{

	echo("User name taken");
	$create_flag = 0;
}

if($create_flag == 1){

	$ins = $con->prepare("INSERT INTO db30906.UserInfo VALUES('$username', '$pw')");
	if($ins) {
        	$ins->execute();
		echo(" Account created ");
       	}

}


?>
