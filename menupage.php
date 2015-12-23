 <!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>



<h2>Menu Creation Page</h2>

<form name = "form1" method="post" action= "">
   Menu Name: <input type="text" name="menuname" value=""> 
  <!--  <input type ="Submit" name = "submitname" value = "submit"> -->
   
   <br><br>
  
   Item Name: <input type="text" name="itemname" value="">
    <!--  <input type ="Submit" name = "submituname" value = "submit"> -->

   <br><br>
   Item Price: <input type="text" name="itemprice" value="">
	 <!--  <input type ="Submit" name = "submitpass" value = "submit")> -->

   <br><br>
   Item Description: <textarea name="description" rows="5" cols="40"><?php echo $comment;?></textarea>
	<br><br>

     <input type="submit" name = "submit1"  value="Submit">


<?php
session_start();
//need to integrate this into the query
$rest_name = $_SESSION['username'];
       
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


//wait until input is inserted



if(isset($_POST['submit1'])){
	$menuname = $_POST['menuname']; 
	$itemname = $_POST['itemname'];
	$itemprice = $_POST['itemprice'];
	$itemdesc = $_POST['description'];
}
	$restID = 1;
	$menu_name = "breakfast";
	




	$query = "SELECT * FROM db30906.Item WHERE restaurantID = '$restID' AND menuName = '$menu_name' AND Name = 'omlette'";
	$stmt = $con->prepare($query);
	$stmt->execute();
	//$stmt->bind_result($isUSER);
	//$stmt->fetch();


/*


	$ins = $con->prepare("INSERT INTO db30906.UserInfo VALUES('$username', '$password')");

	if($ins) {
	    $ins->execute();    
	    echo(" Account created ");
	}
*/
//}









/*	code for redircting webpages
	session_start();
	$_SESSION['message'] = "message";

	header("Location: http://proj-309-06.cs.iastate.edu/login.php"); 
	exit();	
	*/
	


?>
</body>
</html>
