<?php
$host="mysql.cs.iastate.edu";
$port=3306;
$socket="/var/lib/mysql/mysql.sock";
$user="u30906";
$password="Ym84BypjLH";
$dbname="db30906";
$username = $_POST('username');
$pword = $_POST('password');
$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

if($con) {
	print($username);
}

mysql_select_db("db30906",$con);
$row = mysql_query("SELECT * FROM db30906");
while( $row = mysql_fetch_array($result)){
	print("TEST");
}
mysql_close($con);
//     echo $row[0] . "\n";
// }

//$con->close();
?>
