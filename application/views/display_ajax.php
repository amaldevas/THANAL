<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		table, th, td {
   border: 1px solid black;
}
	</style>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#show').click(function(event){
			event.preventDefault();
			$.ajax({
				type : "GET",
				url : "<?php echo base_url();?>show_ajax",
				dataType: 'json',
				success : function(response) {
					$.each(response.result, function(index) {
						var row = '<tr>'+'<td>'+response.result[index].fullname+'</td>'+'<td>'+response.result[index].email+'</td>'+'<td>'+response.result[index].password+'</td>'+'</tr>';
							
						$('.user_details').append(row);
					});
				},
				error: function() { 
					alert("Something went wrong");
				}
			});
		});
	});
</script>
	<title>Display</title>
</head>
<body>
<button id='show'>Show</button>
<table class="user_details">
	<tr>
		<th>Fullname</th>
		<th>Email</th>
		<th>Password</th>
	</tr>
</table>
</body>
</html>