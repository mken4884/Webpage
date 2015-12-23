<?php

ini_set('display_errors',1); 
error_reporting(E_ALL);

$host="mysql.cs.iastate.edu";
$port=3306;
$socket="";
$user="u30906";
$password="Ym84BypjLH";
$dbname="db30906";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

if($con) {
	print("Connected");
}


//$con->query('INSERT INTO UserInfo VALUES('test', 'testpw');');

// Proceed with getting some data...
//mysql_query("INSERT INTO UserInfo VALUES('test', 'testpw');", $con);

$query = 'SELECT * FROM db30906.UserInfo';
$result = mysqli_query($con, $query);

// Get each row of data on each iteration until
// there are no more rows
if (!$result) {
    echo "DB Error, could not query the database\n";
    echo 'MySQL Error: ' . mysql_error();
    exit;
}

while ($row = mysql_fetch_assoc($result)) {
    echo $row['foo'];
}

mysql_free_result($result);

// Or, you could have done the same thing using fetchRow()
// while ($row =& $res->fetchRow()) {
//     // Assuming DB's default fetchmode is DB_FETCHMODE_ORDERED
//     echo $row[0] . "\n";
// }

//$con->close();
?>
