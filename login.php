<html>
<head>
<title>restaurant login</title>
<?php

	$username = $_POST['username'];
	print ($username);
	$password = $_POST['password'];
	print ($password);

	//call


?>
</head>
<body>

<FORM NAME ="form1" METHOD ="POST" ACTION = "">

<INPUT TYPE = "TEXT" VALUE ="username" NAME ="username">
<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Login">


<FORM NAME ="form2" METHOD ="POST" ACTION = "">

<INPUT TYPE = "TEXT" VALUE ="password" NAME = "password">
<INPUT TYPE = "Submit" Name = "Submit1" VALUE = "Password">



</FORM>

</body>
</html>
