<script type="text/javascript">
<!--

/* generic jsp output box for future use */
function redirect_login() {
	alert("You must be logged in to view this page")
	window.location = "http://proj-309-06.cs.iastate.edu/rest_login.php";
}
//-->
</script>
<?php
ini_set('display_errors',1);
error_reporting(E_ALL);

$host="10.25.71.66";
$port=3306;
$socket="";
$user="u30906";
$password="Ym84BypjLH";
$dbname="db30906";

echo("WILL NOT ADD DUPLICATE ITEMS EVEN THOUGH WE NEED TO !!!");
session_start();
$restname = $_SESSION['username'];
//echo("sessions turned off need to uncomment");
//$restname = "test"; 

if($restname == ""){
	echo '<script type="text/javascript"> redirect_login(); </script>';

}
$con = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());

/*$query = "SELECT restaurantName FROM db30906.Restaurant WHERE username = '$restname'";
if($stmt = con->prepare($query)) {
	$stmt->execute();
	$stmt->bind_result($currentrestname);
}*/

//$con->close();

//NEED TO ADD rest_name to db query
$query = "SELECT * FROM db30906.Order WHERE username = '$restname'" ;


//echo'<table border="1" ><th >Reg.Id</th><th>Name</th><th>Category</th>';
echo "<h2><b><center> Current Outstanding Orders</center></b></h2>";

if ($stmt = $con->prepare($query)) {
  $stmt->execute();
  $stmt->bind_result($pusername,$restname,$itemid,$rest_fullname,$dummyvalue);
echo "<div style=\"text-align:center\">";
echo "<table style=\"border:1px solid yellow; background-color:red; margin-left:auto; margin-right:auto;\" class=\"center\">";
echo "<td style=\"background-color: yellow\"><b>ORDER ID</b></td>";
echo"<td style=\"background-color: yellow\"><b>DELETE</b></td> ";
//echo"<td>KEEP</td> ";
$index = 0;
$puserArr[] = array();
echo "<form name = \"form1\" method=\"post\" action= \"\" style=\"text-align:center\">";
while ($stmt->fetch()) {

	
	if($pusername != ''){
		//              printf("%s\n", $field1);
		if(!in_array($pusername,$puserArr)){
			$puserArr[$index] = $pusername;
			$index++; 		
			echo "<tr>";
			echo "<td>$pusername</td>";
			//echo "<td><a href=\"mailto:$field1\">$field1</a></td>";
			echo"<td><input type=\"submit\" name=\"$pusername\" value=\"view order\"></td> ";
			//echo"<td><input type=\"radio\" name=\"$field1\" value=\"keep\"></td> ";

			echo "</tr>";             
				}
        }
}
$index--;
while($index >= 0){
	if(isset($_POST[$puserArr[$index]])){
		$_SESSION['puser'] = $puserArr[$index];
		header("Location: http://proj-309-06.cs.iastate.edu/ind_orderpage.php");
		exit();
		}
	
	$index--;
}

echo "</table>";
$stmt->close();
echo("<br><br>");

if($pusername == ''){
        echo("No outstanding orders");
	echo("<br><br>");
}

//echo("<input type=\"submit\" name = \"delete_order\" value=\"Submit\">");





//echo("<br><br>");
//echo("<br><br>");
//echo("<br><br>");
echo("<input type=\"submit\" name = \"menu_page\" value=\"Menu Creation Page\">");
echo("<input type=\"submit\" name = \"menu_edit\" value=\"Menu Edit Page\">");
echo("<input type=\"submit\" name = \"log_out\" value=\"Log Out\">");
}

if(isset($_POST['menu_page'])){
	header("Location: http://proj-309-06.cs.iastate.edu/menupage.php");
	exit();
}

if(isset($_POST['log_out'])){
	$_SESSION['username'] = "";
	header("Location: http://proj-309-06.cs.iastate.edu/rest_login.php");
	exit();
}


if(isset($_POST['menu_edit'])){
	header("Location: http://proj-309-06.cs.iastate.edu/menueditpage.php");
	exit();
}


/*if(isset($_POST['delete_order'])){
	$index = -1;

	
	if ($stmt = $con->prepare($query)) {
	  $stmt->execute();
	  $stmt->bind_result($pusername,$restname,$itemid,$rest_fullname);
	
		while ($stmt->fetch()) {
			if($pusername != ''){
		
				if($_POST[$pusername] == "delete"){
					$index++;
					$delete_array[$index] = $pusername; 
					
					echo("'$pusername' DELETED");
					}

	
	       	 			}
				}
		$stmt->close();
		}
	
	while($index >= 0){
		$delete_ins = $con->prepare("DELETE FROM db30906.Order WHERE pusername = '$delete_array[$index]' AND username = '$restname'");
		$delete_ins->execute();
		$index--;
	}		
		
}
*/
echo "</div>";
?>
