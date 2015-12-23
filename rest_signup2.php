 <!DOCTYPE HTML>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>



<h2>Restaurant/User account creation page</h2>

<form name = "form1" method="post" action= "">
   Restaurant Name: <input type="text" name="restname" value=""> 
  <!--  <input type ="Submit" name = "submitname" value = "submit"> -->
   
   <br><br>
  
   Username: <input type="text" name="username" value="">
    <!--  <input type ="Submit" name = "submituname" value = "submit"> -->

   <br><br>
   password: <input type="password" name="password" value="">
	 <!--  <input type ="Submit" name = "submitpass" value = "submit")> -->

   <br><br>
   confirm password: <input type="password" name="cpassword" value="">
         <!--  <input type ="Submit" name = "submitpass" value = "submit")> -->


   
   <br><br>
<!-- need to add a confirm password -->
   Website: <input type="text" name="website" value="">
  <!--     <input type ="Submit" name = "submiturl" value = "submit"> -->
<br><br>
	<input type="radio" name="restaurant" value=1 checked>Restaurant
<br>
	<input type="radio" name="restaurant" value=0>Patron
<br><br>
     <input type="submit" name = "submit1"  value="Submit">



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


//wait until input is inserted



if(isset($_POST['submit1'])){
	$restaurant = $_POST['restname']; 
	$username = $_POST['username'];
	$password = $_POST['password'];
	$con_word = $_POST['cpassword'];
	$restaurantURL = $_POST['website'];




	//confirm passwords
	if($password != $con_word){
		echo($password);
		echo("test");
		echo($con_word);
		exit();
	}


	$query = "SELECT * FROM db30906.UserInfo WHERE username = '$username'";
	$stmt = $con->prepare($query);
	$stmt->execute();
	$stmt->bind_result($isUSER, $_____);
	$stmt->fetch();

	if($isUSER != ''){
		echo(" username is already taken ");
	}	





	$ins = $con->prepare("INSERT INTO db30906.UserInfo VALUES('$username', '$password')");

	if($ins) {
	    $ins->execute();    
	    echo(" Account created ");
	}

}









/*	code for redircting webpages
	session_start();
	$_SESSION['message'] = "message";

	header("Location: http://proj-309-06.cs.iastate.edu/login.php"); 
	exit();	
	*/
	


?>
</body>
</html>
