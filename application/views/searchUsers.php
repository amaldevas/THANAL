<!DOCTYPE html>
<html>
<head>
	<title>All Users</title>
</head>
<body>
	<div>
		<?php if(!empty($error)){ echo $error; } ?>

		<h1>Show All Users</h1>
		<div style="background-color: pink;">
			<a href="<?php echo base_url()?>show-all-users">Click Here To Get All Details</a>
		</div>
		<div style="background-color: yellow;">			
			<?php if(!empty($users)){ 
				foreach ($users as $key => $value) { ?>
				<div style="color: blue;"> <?php echo $value->fullname;;echo "\n"; ?></div> 
			<?php  } echo $links; } ?>
		</div>
	</div>
</body>
</html>