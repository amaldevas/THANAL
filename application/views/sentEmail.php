<!DOCTYPE html>
<html>
<head>
	<title>Sent Email</title>
</head>
<body>
	<div>
		<?php if(!empty($error)){ echo $error; } ?>
		<?php if(!empty($message)){ echo $message; } ?>

		<h1>Sent Email</h1>
		 <form action="sent-email" method="POST" >
			<label>Enter Email-Id :- </label><input type="email" id="email" name="email">
			<label>Enter Message :- </label><input type="text" id="message" name="message">
			<br>
			<br>
			<input type="submit" id="submit" name="submit" value="Sent">
		</form>
	</div>
</body>
</html>