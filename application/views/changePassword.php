<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
</head>
<body>
	<div>
		<h1>Change Password</h1>
		<form method="POST">
		<div style="background-color: pink;">
			<p class="show-message"></p>
		</div>
		<div>
			<input type="text" id="fullname" name="fullname" >
			<input type="password" id="password" name="password" >
			<input type="submit" id="submit" name="submit" value="Change Password">
		</div>
		</form>
	</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#submit').click(function(event){
			event.preventDefault();
			fullname=$('#fullname').val();
			password=$('#password').val();

			$.ajax({
				type : "POST",
				url : "<?php echo base_url();s?>user/change-password",
				data : {fullname:fullname,password:password},
				dataType: 'json',
				success : function(response) {
					if(response.result==="fail"){
						$('.show-message').html("Sorry, failed to change your password");
					}else{
						$('.show-message').html("Successfully changes your password");
					}
				},
				error: function() { 
					alert("Something went wrong");
				}
			});
		});
	});
</script>