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

$itemnameArr = array();


$patronname  = $data["username"];
$restname    = $data["restname"];
$menuname    = $data["menuname"];
$itemnameArr = $data["itemnameArr"];
$size        = $data["size"];




if($patronname == "" || $restname == "" || $menuname == "" || $itemnameArr == "" || $size == ""){
	echo("Bad Data");
	exit();
	}


//$restname = "randomrestaurant";
$query = "SELECT * FROM db30906.Restaurant WHERE restaurantName = '$restname'";


$stmt = $con->prepare($query);
$stmt->execute();
$stmt->bind_result($field1,$field2);
$stmt->fetch();

$username = $field1;

$stmt->close();

$itemidArr = array();
$index = 0;



//echo($username);
//echo($menuname);
//echo($itemnameArr);
//$size = 1;
//echo($itemnameArr[0]);
while($index<$size){

	$query = "SELECT * FROM db30906.Item WHERE username = '$username' AND menuName = '$menuname' AND Name = '$itemnameArr[$index]'";
	$stmt = $con->prepare($query);  
	$stmt->execute();
	$stmt->bind_result($field1,$field2,$field3,$field4,$field5,$field6,$dummyvalue);
	$stmt->fetch();
	$itemidArr[$index] = $field1;
	$index++;
	$stmt->close();
}





$con->close();

$con = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());
$ordersent = "0";
$index = 0;
while($index < $size){
	$query = "INSERT INTO db30906.Order  (pusername,username,itemID,restaurantName) VALUES('$patronname','$username','$itemidArr[$index]','$restname')";

	$stmt = $con->prepare($query);	
	$stmt->execute();
	if($stmt->fetch()){
		$ordersent = "1";
	}	
	
	$stmt->close();
	$index++;

}
//echo($ordersent);
exit();

?>
