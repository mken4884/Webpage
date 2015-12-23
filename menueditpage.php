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

 

if($restname == ""){
	echo '<script type="text/javascript"> redirect_login(); </script>';

}
$con = new mysqli($host, $user, $password, $dbname, $port)
        or die ('Could not connect to the database server' . mysqli_connect_error());


//NEED TO ADD rest_name to db query
$query = "SELECT * FROM db30906.Menu WHERE username = '$restname'" ;
 

echo ("<center><b> Edit Existing Menus </b></center>");
echo ("<br></br>");
echo '<form method="post" action="">';
$menus[] = array();
$index = 0;
if ($stmt = $con->prepare($query)) {
	$stmt->execute();
	$stmt->bind_result($field1,$field2);
//	echo("<center>");
	echo("<div style=\"text-align:center\">");
	echo("<select name=\"select_menu\" >");
		while($stmt->fetch()){
			//$menus[$index] = $field2;
			echo("<option value=$field2> $field2  </option>");
		}
}
echo("</select>");
//echo<"</center>");
echo("<br></br>");
echo("<input type= \"submit\" name = \"submit1\" value=\"Choose Menu\">");
echo("<input type=\"submit\" name = \"main_page\" value=\"Main Page\">");

	

	if(isset($_POST['main_page'])){
		header("Location: http://proj-309-06.cs.iastate.edu/orderpage2.php");
		exit();
	}



if(isset($_POST['submit1'])){
	echo("</form>");
	$menuname = $_POST['select_menu'];
	$_SESSION['menuname'] = $menuname;
	echo ("<br></br>");
	echo ("<b>'$menuname'</b>");
	//echo "<div style=\"text-align:center\">";
	echo "<table style=\"margin-left:auto; margin-right:auto; background-color:red\" class=\"center\">";
//	echo "<form name = \"form2\" method=\"post\" action= \"\">";

	$query = "SELECT * FROM db30906.Item WHERE username = '$restname' AND menuName = '$menuname'" ;
 

	echo '<form method="post" action="">';
	$items[] = array();
	$index = 0;


	if ($stmt = $con->prepare($query)) {

		$stmt->execute();
		$stmt->bind_result($itemid,$itemname,$price, $description, $user, $menu );

//		echo("<div style=\"text-align:center; vertical-align:middle\">");
		while ($stmt->fetch()) {
			if($itemname != ''){
				//              printf("%s\n", $field1);
				echo "<tr>";			
				//echo "<div style=\"text-align:center\">");
				
				echo "<td>$itemname</td>";
				//echo "</div>";
				//echo "<td><a href=\"mailto:$field1\">$field1</a></td>";
				echo"<td><input type=\"checkbox\" name=\"$itemname\" value=\"delete\"></td> ";
				//echo"<td><input type=\"radio\" name=\"$field1\" value=\"keep\"></td> ";
             

				//echo("</div>");
				echo("</tr>");
					}	
			}

		echo("</div>");
		
		echo "</table>";
	//	echo "</div>";
		$stmt->close();
		echo("<br><br>");
	}
	if($itemname == ''){
		echo("No outstanding orders");
		echo("<br><br>");
	}

	echo("<input type=\"submit\" name = \"delete_item\" value=\"Delete Items\">");

	



//	echo("<br><br>");
//	echo("<br><br>");
}	
	if(isset($_POST['delete_item'])){
		$index = -1;
		$menuname = $_SESSION['menuname'];
		$query = "SELECT * FROM db30906.Item WHERE username = '$restname' AND menuName = '$menuname'" ;
 
	
		if ($stmt = $con->prepare($query)) {
		  $stmt->execute();
		  $stmt->bind_result($itemid,$itemname,$price, $description, $user, $menu );
			
			while ($stmt->fetch()) {
				if($itemname != ''){
						
					if(isset($_POST[$itemname]) && $_POST[$itemname] == "delete"){
						$index++;
						$delete_array[$index] = $itemname; 
						
						echo("'$itemname' DELETED");
						echo($menuname);
						}

		
						}
					}
			$stmt->close();
			}
		
		while($index >= 0){
			$delete_ins = $con->prepare("DELETE FROM db30906.Item WHERE Name = '$delete_array[$index]' AND username = '$restname' AND menuName = '$menuname'");
			$delete_ins->execute();
			$index--;
		}		
			
	}
	echo("</div>");
	echo("</form>");
	?>
