<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method="POST" action="http://localhost/project-1/index.php/Registration">
	<?php
	echo "$message"; 
	?>
	<label>Full Name</label>
<input type="text" id="fullname" name="fullname" >
<label>Email</label>
<input type="email" id="email" name="email" >
<label>Password</label>
<input type="password" id="password" name="password" >
<input type="submit" id="submit" name="submit" >
</form>
</body>
</html>