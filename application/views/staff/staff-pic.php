<!DOCTYPE html>
<html>
<head>
	<title>User Profile</title>
</head>
<body>
	<div>
		<?php if(!empty($error)){ 
		  echo $error; } 
		?>
		<?php if(!empty($message)){ 
		 echo $message; } 
		?>

		<h1>Upload Photo</h1>
		 <form role="form" action="http://localhost:8081/Thanal/index.php/staff/upload-pic" method="POST" enctype="multipart/form-data" >
			<label>Select Your Photo :- </label><input type="file" id="user-image" name="user-image">
			<input type="hidden" name="user-name">
			<br>
			<br>
			<input type="submit" id="submit" name="submit" value="Upload">
		</form>
	</div>
</body>
</html>