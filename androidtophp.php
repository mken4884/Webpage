

<?php
$con=mysqli_connect("10.25.71.66","u30906","Ym84BypjLH","db30906");
if (mysqli_connect_errno($con))
{
   echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$username = $_POST['username'];
$password = $_POST['password'];
$result = mysqli_query($con,"SELECT * FROM db30906.UserInfo WHERE
username='$username' and pw='$password'");
$row = mysqli_fetch_array($result);
$data = $row[0];
if($data){
echo $data;
}
mysqli_close($con);
?>
