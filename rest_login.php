<html>
<head>
<title>restaurant login</title>
<?php
	//call

session_start();

$con=mysqli_connect("10.25.71.66","u30906","Ym84BypjLH","db30906");


if (mysqli_connect_errno($con)){
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

if(isset($_POST['Submit1'])){
	$username = $_POST['username'];
	$password = $_POST['password'];


$result = mysqli_query($con,"SELECT * FROM db30906.UserInfo WHERE
username='$username' and pw='$password'");


$row = mysqli_fetch_array($result);
$data = $row[0];

if($data){
	$_SESSION['username'] = $username;
	echo "login successful";
	header("Location: http://proj-309-06.cs.iastate.edu/orderpage2.php"); 
	exit(); 


}else{
	echo "login failed";
}
mysqli_close($con);
}

?>
</head>
<body>

<FORM NAME ="form1" METHOD ="POST" ACTION = "">

<INPUT TYPE = "TEXT" VALUE ="username" NAME ="username">
<!--<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Login">-->


<FORM NAME ="form2" METHOD ="POST" ACTION = "">

<INPUT TYPE = "password" VALUE ="password" NAME = "password">


<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Submit">



</FORM>

</body>
</html>
