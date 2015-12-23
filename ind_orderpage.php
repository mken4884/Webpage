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


session_start();
$restname = $_SESSION['username'];
$Patronusername = $_SESSION['puser'];
//echo("sessions turned off need to uncomment");
//$restname = "test"; 

if($restname == ""){
	echo '<script type="text/javascript"> redirect_login(); </script>';

}
$con = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());


//NEED TO ADD rest_name to db query


$query = "SELECT * FROM db30906.Item" ;

$itemnameArr[] = array();
if ($stmt = $con->prepare($query)){
	$stmt->execute();
	$stmt->bind_result($itemid,$itemname,$itemprice,$itemdesc, $rest_name, $menuname);
	while ($stmt->fetch()){
		$itemnameArr[$itemid] = $itemname;
		}
	$stmt->close();
}
 
$query = "SELECT * FROM db30906.Order WHERE username = '$restname' AND pusername = '$Patronusername'" ;

echo "<div style=\"text-align:center\">";
//echo'<table border="1" ><th >Reg.Id</th><th>Name</th><th>Category</th>';

if ($stmt = $con->prepare($query)) {
	$stmt->execute();
	$stmt->bind_result($pusername,$restname,$itemid,$rest_fullname,$dummynumber);
	echo "<table style=\"text-align:center; margin-left:auto; margin-right:auto; background-color:red\" class=\"center\">";
	echo "<td style=\"border-right: 1px solid yellow\"><b>ITEM NAME </b></td>";
	echo"<td><b>DELETE</b></td> ";
	//echo"<td>KEEP</td> ";
	
	echo "<form name = \"form1\" method=\"post\" action= \"\">";
	
	while ($stmt->fetch()) {
		if($itemid != ''){
			//              printf("%s\n", $field1);
			echo "<tr>";
			echo "<td style=\"border-right: 1px solid yellow; text-align:center\">$itemnameArr[$itemid]</td>";
			//echo "<td><a href=\"mailto:$field1\">$field1</a></td>";
			echo"<td><input style=\"text-align:center\" type=\"checkbox\" name=\"".$itemid.$dummynumber."\" value=\"delete\"></td> ";
			//echo"<td><input type=\"radio\" name=\"$field1\" value=\"keep\"></td> ";

			echo "</tr>";             
			}	
		}
	echo "</table>";
	$stmt->close();
	echo("<br><br>");

	/*if($itemid == ''){
		echo("No outstanding orders");
		echo("<br><br>");
	}
	*/
	echo("<input type=\"submit\" name = \"delete_order\" value=\"Delete\">");





	echo("<br><br>");
	echo("<br><br>");
	echo("<br><br>");
	echo("<input type=\"submit\" name = \"main_page\" value=\"Main Page\">");
	}

if(isset($_POST['main_page'])){
	header("Location: http://proj-309-06.cs.iastate.edu/orderpage2.php");
	exit();
}

$query = "SELECT * FROM db30906.Order WHERE username = '$restname' AND pusername = '$Patronusername'" ;

$delete_array[] = array();

if(isset($_POST['delete_order'])){
	$index = -1;
	
	if ($stmt = $con->prepare($query)) {
	  $stmt->execute();
	  $stmt->bind_result($pusername,$restname,$itemid,$rest_fullname,$dummynumber);
	
		while ($stmt->fetch()) {
		
			if($itemid != '' && $pusername == $Patronusername){
					
				if(isset($_POST[$itemid.$dummynumber]) && $_POST[$itemid.$dummynumber] == "delete"){
					$index++;
					$delete_array[$index] = $itemid; 
					$index++;
					$delete_array[$index] = $dummynumber;
					echo("'$itemid$dummynumber' DELETED");
					}

	
	       	 			}
				}
		$stmt->close();
		}

//echo "</div>"

	while($index >= 0){
		$delete_ins = $con->prepare("DELETE FROM db30906.Order WHERE pusername = '$Patronusername' AND 
			itemid = '".$delete_array[$index-1]."' AND username = '$restname' AND orderID = '$delete_array[$index]'");
		$delete_ins->execute();
		$index--;
		$index--;
	}		
//        header("Location: http://proj-309-06.cs.iastate.edu/ind_orderpage.php");
  //      exit();
	
	
}

?>
