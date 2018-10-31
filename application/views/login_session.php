<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
	echo $message;
?>
<form method="POST" action="http://localhost/project-1/index.php/Login_Session">
<label>Full Name</label>
<input type="text" id="fullname" name="fullname" >
<label>Password</label>
<input type="password" id="password" name="password" >
<input type="submit" id="submit" name="submit" value="Login" >
</form>
</body>
</html>