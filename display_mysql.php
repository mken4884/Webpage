<html>
<body>
<?php
$host="10.25.71.66";
$port=3306;
$socket="";
$username="u30906";
$password="Ym84BypjLH";
$database="db30906";
mysql_connect($host,$username,$password);
@mysql_select_db($database) or die( "Unable to select database");
$query="SELECT * FROM * ";
$result=mysql_query($query);
$num=mysql_numrows($result);
mysql_close();
?>






<table border="0" cellspacing="2" cellpadding="2">
<tr>
<td>
<font face="Arial, Helvetica, sans-serif">Value1</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value2</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value3</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value4</font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif">Value5</font>
</td>
</tr>

<?php$i=0;
while ($i < $num) 
     {$f1=mysql_result($result,$i,"field1");
      $f2=mysql_result($result,$i,"field2");
      $f3=mysql_result($result,$i,"field3");
      $f4=mysql_result($result,$i,"field4");
      $f5=mysql_result($result,$i,"field5");

?>

<tr>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f3; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f4; ?></font>
</td>
<td>
<font face="Arial, Helvetica, sans-serif"><?php echo $f5; ?></font>
</td>
</tr>

<?php
$i++;
}
?>

</body>
</html>
