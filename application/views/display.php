<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h3 align="center">USER</h3>
	<?php
		foreach ($result as $row)
		{
        	echo $row->fullname;
        	echo "string";
        	echo $row->email;
        	echo "<br>";
		} 
	 ?>

</body>
</html>