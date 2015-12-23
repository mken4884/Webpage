<?php
$host="barium.cs.iastate.edu";
$port=3306;
$socket="";//"/var/lib/mysql/mysql.sock";
$user="u30906";
$password="Ym84BypjLH";
$dbname="db30906";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
        or die ('Could not connect to the database server' . mysqli_connect_error()); 

if($con) {
        print("Connected");
}   
    
//$con->close();
?>  

